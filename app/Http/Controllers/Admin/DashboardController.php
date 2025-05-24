<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\Department;
use App\Models\Subject;
use App\Models\ScheduledClass; // Giả sử bạn đã có model này
use App\Models\Semester;       // Để lấy kì hiện tại
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalLecturers = Lecturer::count();
        $totalDepartments = Department::count();
        $totalSubjects = Subject::count();

        // Lấy kì học hiện tại (nếu có)
        $currentSemester = Semester::where('is_current', true)->first();
        $totalScheduledClassesInCurrentSemester = 0;
        if ($currentSemester) {
            $totalScheduledClassesInCurrentSemester = ScheduledClass::where('semester_id', $currentSemester->id)->count();
        }

        return view('dashboard', compact(
            'totalLecturers',
            'totalDepartments',
            'totalSubjects',
            'currentSemester',
            'totalScheduledClassesInCurrentSemester'
        ));
    }
}