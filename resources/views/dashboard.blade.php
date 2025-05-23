<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Trang Quản lý Giảng viên') }} {{-- Hoặc "Bảng điều khiển Admin" tùy bạn --}}
        </h2>
    </x-slot>

    <div class="py-12"> {{-- Giữ padding chung cho trang --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex min-h-[calc(100vh-10rem)]"> {{-- Đảm bảo chiều cao và flex layout --}}

                    {{-- Sidebar Menu --}}
                    <div class="w-64 p-4 sm:p-6 bg-gray-100 dark:bg-gray-700 border-r border-gray-200 dark:border-gray-600 flex flex-col justify-between">
                        <div>
                            <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Menu Chính</h3>
                            <nav class="mt-4 space-y-1">
                                <a href="{{ route('dashboard') }}"
                                   class="flex items-center py-2.5 px-4 rounded transition duration-200 text-gray-700 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600 {{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white dark:bg-blue-600' : '' }}">
                                    {{-- <i class="fas fa-tachometer-alt mr-3"></i>  Bạn có thể thêm icon nếu muốn --}}
                                    Bảng điều khiển
                                </a>

                                <a href="{{ route('departments.index') }}"
                                   class="flex items-center py-2.5 px-4 rounded transition duration-200 text-gray-700 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600 {{ request()->routeIs('departments.*') ? 'bg-blue-500 text-white dark:bg-blue-600' : '' }}">
                                    {{-- <i class="fas fa-university mr-3"></i> --}}
                                    Quản lý Khoa
                                </a>

                               
                                {{-- Trong <nav> của sidebar --}}
                                <a href="{{ route('lecturers.index') }}" {{-- THAY ĐỔI HREF --}}
                                  class="flex items-center py-2.5 px-4 rounded transition duration-200 text-gray-700 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600 {{ request()->routeIs('lecturers.*') ? 'bg-blue-500 text-white dark:bg-blue-600' : '' }}">
                                  {{-- <i class="fas fa-chalkboard-teacher mr-3"></i> --}}
                                  Quản lý Giảng viên
                                </a>

                                {{-- Bạn có thể thêm các mục menu khác ở đây nếu cần --}}
                                {{-- Ví dụ:
                                <a href="#"
                                   class="flex items-center py-2.5 px-4 rounded transition duration-200 text-gray-700 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-600">
                                    Quản lý Người dùng
                                </a>
                                --}}
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

                            </nav>
                        </div>

                        {{-- Nút Đăng xuất ở cuối sidebar --}}
                        <div class="mt-auto pt-4 border-t border-gray-300 dark:border-gray-600">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();"
                                   class="flex items-center w-full text-left py-2.5 px-4 rounded transition duration-200 text-gray-700 dark:text-gray-300 hover:bg-red-500 hover:text-white dark:hover:bg-red-600">
                                    {{-- <i class="fas fa-sign-out-alt mr-3"></i> --}}
                                    Thoát (Đăng xuất)
                                </a>
                            </form>
                        </div>
                    </div>

                    {{-- Main Content --}}
                    <div class="flex-1 p-6">
                        {{-- Nội dung này là phần bạn thấy trong ảnh gốc (danh sách "BÁO CÁO GIÁO VIÊN" v.v.) --}}
                        {{-- Hiện tại, nó sẽ hiển thị một thông điệp chào mừng. --}}
                        {{-- Khi bạn nhấp vào "Quản lý Khoa", bạn sẽ được chuyển đến trang /admin/departments --}}
                        {{-- Trang Dashboard này có thể hiển thị thông tin tổng quan hoặc thống kê. --}}

                        <div class="text-gray-900 dark:text-gray-100">
                            @if(request()->routeIs('dashboard'))
                                <h4 class="text-2xl font-semibold mb-4">Chào mừng tới Trang Quản trị!</h4>
                                <p class="text-gray-700 dark:text-gray-300">
                                    Đây là bảng điều khiển chính của bạn. Hãy chọn một mục từ menu bên trái để bắt đầu quản lý.
                                </p>
                                <p class="mt-2 text-gray-700 dark:text-gray-300">
                                    Hiện tại, bạn có thể quản lý các Khoa/Bộ môn. Chức năng quản lý Giảng viên sẽ sớm được cập nhật.
                                </p>
                            @else
                                {{-- Đây là nơi có thể đặt @yield('content') nếu bạn muốn dashboard này làm layout chính --}}
                                {{-- Tuy nhiên, với cách làm hiện tại, mỗi trang như departments.index sẽ có view riêng --}}
                                {{-- và sử dụng x-app-layout. --}}
                                {{-- Phần này có thể để trống hoặc hiển thị một thông báo chung khi không ở route 'dashboard' --}}
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>