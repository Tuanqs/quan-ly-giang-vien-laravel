<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Department;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\ScheduledClass;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function subjectClassStatistics(Request $request): View
    {
        $academicYears = AcademicYear::orderBy('start_date', 'desc')->get();
        $departments = Department::orderBy('name')->get();

        $selectedAcademicYearId = $request->input('academic_year_id');
        $selectedDepartmentId = $request->input('department_id');

        $statistics = [];
        $semestersInYear = collect(); // Khởi tạo collection rỗng

        if ($selectedAcademicYearId) {
            $academicYear = AcademicYear::find($selectedAcademicYearId);
            if ($academicYear) {
                // Lấy các kì học thuộc năm học đã chọn
                $semestersInYear = Semester::where('academic_year_id', $academicYear->id)
                                           ->orderBy('start_date')
                                           ->get();

                // Query để lấy số lớp cho mỗi học phần trong từng kì của năm học đó
                $subjectQuery = Subject::with('department')
                                       ->select('subjects.id', 'subjects.name', 'subjects.subject_code', 'subjects.department_id');

                if ($selectedDepartmentId) {
                    $subjectQuery->where('subjects.department_id', $selectedDepartmentId);
                }

                $subjectsInScope = $subjectQuery->orderBy('subjects.name')->get();

                foreach ($subjectsInScope as $subject) {
                    $statsBySemester = [];
                    foreach ($semestersInYear as $semester) {
                        $count = ScheduledClass::where('subject_id', $subject->id)
                                               ->where('semester_id', $semester->id)
                                               ->count();
                        $statsBySemester[$semester->id] = $count;
                    }
                    $statistics[] = [
                        'subject_id' => $subject->id,
                        'subject_code' => $subject->subject_code,
                        'subject_name' => $subject->name,
                        'department_name' => $subject->department->name ?? 'N/A',
                        'stats_by_semester' => $statsBySemester,
                        'total_in_year' => array_sum($statsBySemester),
                    ];
                }
            }
        }

        return view('admin.reports.subject-class-statistics', compact(
            'academicYears',
            'departments',
            'selectedAcademicYearId',
            'selectedDepartmentId',
            'statistics',
            'semestersInYear' // Truyền danh sách các kì của năm học đã chọn sang view để làm header bảng
        ));
    }
}