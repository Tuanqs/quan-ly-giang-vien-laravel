<x-app-layout> {{-- Hoặc <x-admin-layout> nếu bạn đã tạo và muốn dùng nó làm layout chính --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- Tiêu đề này có thể thay đổi tùy theo mục đích của trang Dashboard --}}
            {{ __('Bảng điều khiển') }}
        </h2>
    </x-slot>

    <div class="py-12"> {{-- Padding chung cho trang --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex min-h-[calc(100vh-10rem)]"> {{-- Đảm bảo chiều cao và flex layout --}}

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
                Mở Lớp hàng loạt
            </a>
            <a href="{{ route('scheduled-classes.index') }}"
               class="admin-sidebar-link {{ request()->routeIs('scheduled-classes.*') ? 'admin-sidebar-link-active' : '' }}">
                QL Lớp học phần
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

                    {{-- Main Content --}}
                    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Thông báo chào mừng và Kì học hiện tại --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-6 lg:p-8 border-b border-gray-200 dark:border-gray-700">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        Chào mừng trở lại, {{ Auth::user()->name }}!
                    </h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        Tổng quan nhanh về hệ thống quản lý.
                        @if(isset($currentSemester) && $currentSemester)
                            Kì học hiện tại: <strong class="text-indigo-600 dark:text-indigo-400">{{ $currentSemester->name }} ({{ $currentSemester->academicYear->name }})</strong>
                        @else
                            Hiện chưa có kì học nào được đặt là "hiện tại".
                        @endif
                    </p>
                </div>
            </div>

            {{-- Các Thẻ Tóm tắt --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Thẻ Tổng số Giảng viên --}}
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-500 dark:text-blue-300">
                            {{-- Heroicon: users --}}
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">Tổng Giảng viên</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalLecturers ?? '0' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Thẻ Tổng số Khoa --}}
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-900 text-indigo-500 dark:text-indigo-300">
                            {{-- Heroicon: building-office-2 --}}
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M8.25 6h7.5m-7.5 3h7.5m-7.5 3h7.5m-7.5 3h7.5M3 12h18M3 12c0-6.627 5.373-12 12-12s12 5.373 12 12v9H3v-9z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">Tổng số Khoa</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalDepartments ?? '0' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Thẻ Tổng số Học phần --}}
                 <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 text-green-500 dark:text-green-300">
                            {{-- Heroicon: academic-cap --}}
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">Tổng Học phần</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalSubjects ?? '0' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Thẻ Số lớp trong Kì hiện tại --}}
                 <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-500 dark:text-yellow-300">
                            {{-- Heroicon: table-cells --}}
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 018.25 20.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25A2.25 2.25 0 0113.5 8.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">Lớp trong Kì này</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalScheduledClassesInCurrentSemester ?? '0' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Khu vực cho Biểu đồ (sẽ làm sau nếu muốn) --}}
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8">
                    <h2 class="text-xl font-medium text-gray-900 dark:text-white mb-4">Thống kê nhanh (Ví dụ)</h2>
                    <div class="bg-gray-200 dark:bg-gray-700 h-64 rounded-md flex items-center justify-center">
                        <p class="text-gray-500 dark:text-gray-400">Khu vực hiển thị biểu đồ</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>