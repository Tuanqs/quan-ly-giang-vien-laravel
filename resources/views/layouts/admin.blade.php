<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $header_title ?? config('app.name', 'Laravel') }}</title> {{-- Cho phép đặt title riêng cho từng trang --}}

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        {{-- (Tùy chọn) Font Awesome nếu bạn dùng icons --}}
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" /> --}}


        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            {{-- Thanh điều hướng ngang trên cùng (lấy từ app.blade.php) --}}
            @include('layouts.navigation')

            <main class="flex pt-16"> {{-- pt-16 để tránh bị header che --}}
                {{-- Sidebar Menu --}}
                <div class="w-64 p-4 sm:p-6 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col justify-between min-h-[calc(100vh-4rem)] admin-sidebar"> {{-- THÊM CLASS admin-sidebar --}}
    <div>
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4 px-2">Menu Chính</h3>
        <nav class="mt-4 space-y-1">
            <a href="{{ route('dashboard') }}"
               class="admin-sidebar-link {{ request()->routeIs('dashboard') ? 'admin-sidebar-link-active' : '' }}">
                {{-- <i class="fas fa-tachometer-alt mr-3"></i> --}}
                Trang chủ
            </a>

            <a href="{{ route('departments.index') }}"
               class="admin-sidebar-link {{ request()->routeIs('departments.*') ? 'admin-sidebar-link-active' : '' }}">
                {{-- <i class="fas fa-university mr-3"></i> --}}
                Quản lý Khoa
            </a>

            {{-- Các link menu khác cũng thêm class admin-sidebar-link và admin-sidebar-link-active nếu cần --}}
            <a href="{{ route('lecturers.index') }}"
               class="admin-sidebar-link {{ request()->routeIs('lecturers.*') ? 'admin-sidebar-link-active' : '' }}">
                Quản lý Giảng viên
            </a>
            <a href="{{ route('degree-types.index') }}"
               class="admin-sidebar-link {{ request()->routeIs('degree-types.*') ? 'admin-sidebar-link-active' : '' }}">
                QL Danh mục Bằng cấp
            </a>
            <a href="{{ route('academic-years.index') }}"
               class="admin-sidebar-link {{ request()->routeIs('academic-years.*') ? 'admin-sidebar-link-active' : '' }}">
                Quản lý Năm học
            </a>
            <a href="{{ route('semesters.index') }}"
               class="admin-sidebar-link {{ request()->routeIs('semesters.*') ? 'admin-sidebar-link-active' : '' }}">
                Quản lý Kì học
            </a>
            <a href="{{ route('subjects.index') }}"
               class="admin-sidebar-link {{ request()->routeIs('subjects.*') ? 'admin-sidebar-link-active' : '' }}">
                Quản lý Học phần
            </a>
            <a href="{{ route('admin.course-offerings.open-batch.create') }}"
               class="admin-sidebar-link {{ request()->routeIs('admin.course-offerings.open-batch.create') ? 'admin-sidebar-link-active' : '' }}">
                Mở Lớp học phần
            </a>
            <a href="{{ route('scheduled-classes.index') }}"
               class="admin-sidebar-link {{ request()->routeIs('scheduled-classes.*') ? 'admin-sidebar-link-active' : '' }}">
                QL Lớp học phần
            </a>
            <a href="{{ route('admin.assignments.index') }}"
                class="admin-sidebar-link {{ request()->routeIs('admin.assignments.index') ? 'admin-sidebar-link-active' : '' }}">
                    {{-- <i class="fas fa-user-tie mr-3"></i> --}}
                    Phân công Giảng dạy
            </a>
            <a href="{{ route('admin.reports.subject-class-statistics') }}"
                class="admin-sidebar-link {{ request()->routeIs('admin.reports.subject-class-statistics') ? 'admin-sidebar-link-active' : '' }}">
                    {{-- <i class="fas fa-chart-bar mr-3"></i> --}} {{-- Tùy chọn icon --}}
                    Thống kê Lớp/Học phần
            </a>

            <h4 class="mt-4 mb-2 px-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Cấu hình Tính lương</h4>

            <a href="{{ route('lecturer-pay-rates.index') }}"
            class="admin-sidebar-link {{ request()->routeIs('lecturer-pay-rates.*') ? 'admin-sidebar-link-active' : '' }}">
                {{-- <i class="fas fa-money-bill-wave mr-3"></i> --}} {{-- Tùy chọn icon --}}
                Hệ số lương GV
            </a>

            <a href="{{ route('class-size-coefficients.index') }}"
                class="admin-sidebar-link {{ request()->routeIs('class-size-coefficients.*') ? 'admin-sidebar-link-active' : '' }}">
                    {{-- <i class="fas fa-users mr-3"></i> --}} {{-- Tùy chọn icon --}}
                    Hệ số Sĩ số Lớp
            </a>
            <a href="{{ route('admin.payroll.generate-form') }}"
                class="admin-sidebar-link {{ request()->routeIs('admin.payroll.*') ? 'admin-sidebar-link-active' : '' }}">
                {{-- <i class="fas fa-calculator mr-3"></i> --}}
                Tính tiền dạy GV
            </a>
            <a href="{{ route('admin.payroll.history') }}" class="admin-sidebar-link {{ request()->routeIs('admin.payroll.history*') ? 'admin-sidebar-link-active' : '' }}">
                {{-- <i class="fas fa-history mr-3"></i> --}}
                Lịch sử Bảng lương
            </a>
            <a href="{{ route('admin.reports.payroll') }}"
            class="admin-sidebar-link {{ request()->routeIs('admin.reports.payroll') ? 'admin-sidebar-link-active' : '' }}">
                {{-- <i class="fas fa-file-invoice-dollar mr-3"></i> --}}
                Báo cáo Tiền dạy
            </a>
        </nav>
    </div>

    {{-- Nút Đăng xuất ở cuối sidebar --}}
    <div class="mt-auto pt-4 border-t border-gray-300 dark:border-gray-600">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); this.closest('form').submit();"
               class="admin-sidebar-link admin-sidebar-logout-link">
                {{-- <i class="fas fa-sign-out-alt mr-3"></i> --}}
                Thoát (Đăng xuất)
            </a>
        </form>
    </div>
</div>

                {{-- Main Content Area for specific pages --}}
                <div class="flex-1 p-6 sm:p-8">
                    {{-- Page Heading (nếu có, có thể truyền từ view con) --}}
                    @if (isset($header))
                        <header class="bg-white dark:bg-gray-800 shadow mb-6">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endif

                    {{ $slot }} {{-- Đây là nơi nội dung của các trang con sẽ được chèn vào --}}
                </div>
            </main>
        </div>
    </body>
</html>