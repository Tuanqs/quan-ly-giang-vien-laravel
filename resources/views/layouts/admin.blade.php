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
                <aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col justify-between min-h-[calc(100vh-4rem)]"> {{-- 4rem là chiều cao header --}}
                    <div>
                        <div class="p-4 sm:p-6">
                            <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Menu Chính</h3>
                            <nav class="mt-4 space-y-1">
                                <a href="{{ route('dashboard') }}"
                                   class="flex items-center py-2.5 px-4 rounded transition duration-200 text-gray-700 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600 {{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white dark:bg-blue-600' : '' }}">
                                    Bảng điều khiển
                                </a>
                                <a href="{{ route('departments.index') }}"
                                   class="flex items-center py-2.5 px-4 rounded transition duration-200 text-gray-700 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600 {{ request()->routeIs('departments.*') ? 'bg-blue-500 text-white dark:bg-blue-600' : '' }}">
                                    Quản lý Khoa
                                </a>
                                {{-- Trong <nav> của sidebar --}}
                                <a href="{{ route('lecturers.index') }}" {{-- THAY ĐỔI HREF --}}
                                   class="flex items-center py-2.5 px-4 rounded transition duration-200 text-gray-700 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600 {{ request()->routeIs('lecturers.*') ? 'bg-blue-500 text-white dark:bg-blue-600' : '' }}">
                                                  {{-- <i class="fas fa-chalkboard-teacher mr-3"></i> --}}
                                    Quản lý Giảng viên
                                </a>
                                {{-- Trong <nav> của sidebar --}}
                                <a href="{{ route('degree-types.index') }}"
                                    class="flex items-center py-2.5 px-4 rounded transition duration-200 text-gray-700 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600 {{ request()->routeIs('degree-types.*') ? 'bg-blue-500 text-white dark:bg-blue-600' : '' }}">
                                    {{-- <i class="fas fa-graduation-cap mr-3"></i> --}}
                                    QL Danh mục Bằng cấp
                                </a>
                                <a href="{{ route('academic-years.index') }}"
                                    class="flex items-center py-2.5 px-4 rounded transition duration-200 text-gray-700 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600 {{ request()->routeIs('academic-years.*') ? 'bg-blue-500 text-white dark:bg-blue-600' : '' }}">
                                    {{-- <i class="fas fa-calendar-alt mr-3"></i> --}} {{-- Tùy chọn icon --}}
                                    Quản lý Năm học
                                </a>
                                <a href="{{ route('semesters.index') }}"
                                    class="flex items-center py-2.5 px-4 rounded transition duration-200 text-gray-700 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600 {{ request()->routeIs('semesters.*') ? 'bg-blue-500 text-white dark:bg-blue-600' : '' }}">
                                    {{-- <i class="fas fa-calendar-check mr-3"></i> --}} {{-- Tùy chọn icon --}}
                                    Quản lý Kì học
                                </a>
                                <a href="{{ route('subjects.index') }}"
                                    class="flex items-center py-2.5 px-4 rounded transition duration-200 text-gray-700 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600 {{ request()->routeIs('subjects.*') ? 'bg-blue-500 text-white dark:bg-blue-600' : '' }}">
                                    {{-- <i class="fas fa-book mr-3"></i> --}} {{-- Tùy chọn icon --}}
                                    Quản lý Học phần
                                </a>
                                <a href="{{ route('admin.course-offerings.open-batch.create') }}"
                                    class="flex items-center py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('admin.course-offerings.open-batch.create') ? 'bg-blue-500 text-white dark:bg-blue-600' : 'text-gray-700 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600' }}">
                                     {{-- <i class="fas fa-layer-group mr-3"></i> --}}
                                    Mở Lớp hàng loạt
                                </a>
                                <a href="{{ route('scheduled-classes.index') }}"
   class="flex items-center py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('scheduled-classes.*') ? 'bg-blue-500 text-white dark:bg-blue-600' : 'text-gray-700 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600' }}">
    {{-- <i class="fas fa-calendar-week mr-3"></i> --}} {{-- Tùy chọn icon --}}
    QL Lớp học phần
</a>
                                {{-- Thêm các mục menu khác nếu cần --}}
                            </nav>
                        </div>
                    </div>
                    {{-- Nút Đăng xuất ở cuối sidebar --}}
                    <div class="p-4 sm:p-6 mt-auto border-t border-gray-200 dark:border-gray-700">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); this.closest('form').submit();"
                               class="flex items-center w-full text-left py-2.5 px-4 rounded transition duration-200 text-gray-700 dark:text-gray-300 hover:bg-red-500 hover:text-white dark:hover:bg-red-600">
                                Thoát (Đăng xuất)
                            </a>
                        </form>
                    </div>
                </aside>

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