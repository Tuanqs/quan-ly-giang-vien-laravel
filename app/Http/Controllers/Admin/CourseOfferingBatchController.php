<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Lecturer;
use App\Models\ScheduledClass; // <<--- THÊM DÒNG NÀY
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse; // <<--- THÊM DÒNG NÀY
use Illuminate\Support\Facades\DB;     // <<--- THÊM DÒNG NÀY
use Illuminate\Support\Facades\Log;    // <<--- THÊM DÒNG NÀY

class CourseOfferingBatchController extends Controller
{
    public function create(): View
    {
        $semesters = Semester::orderBy('start_date', 'desc')->get();
        $subjects = Subject::orderBy('name')->get();
        $lecturers = Lecturer::orderBy('full_name')->get();

        return view('admin.course-offerings.open-batch-form', compact('semesters', 'subjects', 'lecturers'));
    }

    /**
     * Store a batch of newly created course offerings in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'semester_id' => 'required|exists:semesters,id',
            'subject_id' => 'required|exists:subjects,id',
            'number_of_classes' => 'required|integer|min:1|max:50', // Giới hạn max tùy ý
            'max_students_per_class' => 'required|integer|min:1|max:200', // Giới hạn max tùy ý
            'class_code_prefix' => 'nullable|string|max:50',
            'common_schedule_info' => 'nullable|string',
            'common_lecturer_id' => 'nullable|exists:lecturers,id',
        ]);

        $semester = Semester::findOrFail($validatedData['semester_id']);
        $subject = Subject::findOrFail($validatedData['subject_id']);
        $numberOfClassesToOpen = $validatedData['number_of_classes'];
        $maxStudents = $validatedData['max_students_per_class'];
        $prefix = $request->input('class_code_prefix', $subject->subject_code); // Dùng subject_code nếu prefix trống
        $commonSchedule = $request->input('common_schedule_info');
        $commonLecturerId = $request->input('common_lecturer_id');

        $createdClassesCount = 0;
        $generatedClassCodes = []; // Để lưu trữ các mã lớp đã tạo trong lần submit này
        $errors = [];

        DB::beginTransaction();
        try {
            // Lấy số thứ tự lớp lớn nhất hiện có cho học phần và kỳ này để bắt đầu từ đó
            $currentMaxSuffixNumber = $this->getCurrentMaxSuffixNumber($semester->id, $subject->id, $prefix);

            for ($i = 0; $i < $numberOfClassesToOpen; $i++) {
                $nextSuffixNumber = $currentMaxSuffixNumber + 1 + $i;
                $classCode = $prefix . '.N' . str_pad($nextSuffixNumber, 2, '0', STR_PAD_LEFT);

                // Kiểm tra lại một lần nữa để đảm bảo tính duy nhất trong trường hợp có nhiều request đồng thời (hiếm)
                // Hoặc nếu logic getNextClassSuffixNumber chưa hoàn hảo
                $existingClass = ScheduledClass::where('semester_id', $semester->id)
                                               ->where('subject_id', $subject->id)
                                               ->where('class_code', $classCode)
                                               ->first();
                if ($existingClass) {
                    // Nếu mã lớp đã tồn tại, thử tăng suffix lên một chút nữa (ví dụ)
                    // Hoặc ghi nhận lỗi và bỏ qua. Để đơn giản, chúng ta có thể báo lỗi và yêu cầu người dùng thử lại
                    // với tiền tố khác hoặc kiểm tra lại.
                    // Ở đây, chúng ta sẽ cố gắng tìm một suffix khác.
                    Log::warning("Mã lớp {$classCode} dự kiến tạo đã tồn tại, đang thử tìm suffix khác.");
                    $safetyCounter = 0; // Tránh vòng lặp vô hạn
                    do {
                        $nextSuffixNumber++;
                        $classCode = $prefix . '.N' . str_pad($nextSuffixNumber, 2, '0', STR_PAD_LEFT);
                        $existingClass = ScheduledClass::where('semester_id', $semester->id)
                                                       ->where('subject_id', $subject->id)
                                                       ->where('class_code', $classCode)
                                                       ->first();
                        $safetyCounter++;
                    } while ($existingClass && $safetyCounter < ($numberOfClassesToOpen + 5)); // Thử thêm vài lần

                    if ($existingClass) {
                        $errors[] = "Không thể tạo mã lớp duy nhất cho lớp thứ " . ($i + 1) . " sau nhiều lần thử (mã cuối thử: {$classCode}).";
                        continue; // Bỏ qua việc tạo lớp này
                    }
                }


                ScheduledClass::create([
                    'semester_id' => $semester->id,
                    'subject_id' => $subject->id,
                    'class_code' => $classCode,
                    'max_students' => $maxStudents,
                    'schedule_info' => $commonSchedule,
                    'lecturer_id' => $commonLecturerId,
                    // 'current_students' sẽ mặc định là 0 (nếu bạn đã đặt default trong migration)
                ]);
                $generatedClassCodes[] = $classCode;
                $createdClassesCount++;
            }

            if (!empty($errors)) {
                DB::rollBack(); // Nếu có lỗi không thể tạo mã lớp, rollback
                return redirect()->back()
                                 ->withInput()
                                 ->with('error', "Đã có lỗi xảy ra khi tạo mã lớp: " . implode('; ', $errors) . ". Số lớp đã tạo: 0.");
            }

            DB::commit();

            $successMessage = "Đã mở thành công {$createdClassesCount} lớp cho học phần '{$subject->name}'.";
            if (!empty($generatedClassCodes)) {
                $successMessage .= " Các mã lớp được tạo: " . implode(', ', $generatedClassCodes);
            }

            return redirect()->route('admin.course-offerings.open-batch.create') // Quay lại form mở lớp để có thể mở tiếp
                             ->with('success', $successMessage);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            throw $e; // Ném lại để Laravel xử lý redirect với lỗi validation
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Lỗi khi mở nhiều lớp học phần: " . $e->getMessage() . " Dòng: " . $e->getLine());
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Đã có lỗi nghiêm trọng xảy ra trong quá trình mở lớp: ' . $e->getMessage());
        }
    }

    /**
     * Helper function to get the next class suffix number for a subject in a semester.
     * This tries to find the highest existing suffix like .NXX and returns the next number.
     */
    private function getCurrentMaxSuffixNumber($semesterId, $subjectId, $prefix): int
    {
        $latestClass = ScheduledClass::where('semester_id', $semesterId)
                                     ->where('subject_id', $subjectId)
                                     ->where('class_code', 'LIKE', $prefix . '.N%') // Chỉ xét các mã lớp có cùng prefix và dạng .NXX
                                     ->orderBy('class_code', 'desc')
                                     ->first();
        if ($latestClass) {
            // Tách số từ đuôi mã lớp, ví dụ: "IT101.N05" -> "05"
            if (preg_match('/\.N(\d+)$/', $latestClass->class_code, $matches)) {
                return intval($matches[1]);
            }
        }
        return 0; // Nếu chưa có lớp nào có dạng .NXX, bắt đầu từ 0 (để lớp đầu tiên là .N01)
    }
}