<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Danh sách Giảng viên') }}
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            {{-- FORM TÌM KIẾM VÀ LỌC --}}
            <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-md">
                <form method="GET" action="{{ route('lecturers.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label for="search_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tên hoặc Mã GV</label>
                            <input type="text" name="search_term" id="search_term" value="{{ request('search_term') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100">
                        </div>
                        <div>
                            <label for="search_department" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Khoa/Bộ môn</label>
                            <select name="search_department" id="search_department"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100">
                                <option value="">-- Tất cả Khoa --</option>
                                @foreach ($departmentsForSearch as $department) {{-- Biến này sẽ được truyền từ controller --}}
                                    <option value="{{ $department->id }}" {{ request('search_department') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="search_level" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Trình độ học vấn</label>
                            <select name="search_level" id="search_level"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100">
                                <option value="">-- Tất cả Trình độ --</option>
                                <option value="Cử nhân" {{ request('search_level') == 'Cử nhân' ? 'selected' : '' }}>Cử nhân</option>
                                <option value="Thạc sĩ" {{ request('search_level') == 'Thạc sĩ' ? 'selected' : '' }}>Thạc sĩ</option>
                                <option value="Tiến sĩ" {{ request('search_level') == 'Tiến sĩ' ? 'selected' : '' }}>Tiến sĩ</option>
                                <option value="Phó Giáo sư" {{ request('search_level') == 'Phó Giáo sư' ? 'selected' : '' }}>Phó Giáo sư</option>
                                <option value="Giáo sư" {{ request('search_level') == 'Giáo sư' ? 'selected' : '' }}>Giáo sư</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs uppercase rounded-md">
                                Tìm kiếm
                            </button>
                            <a href="{{ route('lecturers.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold text-xs uppercase rounded-md">
                                Xóa lọc
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            {{-- KẾT THÚC FORM TÌM KIẾM VÀ LỌC --}}


            <div class="mb-4">
                <a href="{{ route('lecturers.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    {{ __('Thêm Giảng viên mới') }}
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('STT') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Mã GV') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Họ tên') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Khoa/Bộ môn') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Trình độ') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Hành động') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($lecturers as $index => $lecturer)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $lecturers->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $lecturer->lecturer_code }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $lecturer->full_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $lecturer->department->name ?? 'N/A' }} {{-- Hiển thị tên khoa --}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $lecturer->academic_level }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('lecturers.show', $lecturer->id) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-200 mr-2">{{ __('Xem') }}</a>
                                    {{-- Nút sửa có thể đặt ở trang chi tiết hoặc ở đây tùy ý --}}
                                    {{-- <a href="{{ route('lecturers.edit', $lecturer->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-200 mr-2">{{ __('Sửa') }}</a> --}}
                                    <form action="{{ route('lecturers.destroy', $lecturer->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa giảng viên này không?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-200">{{ __('Xóa') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-300">
                                    {{ __('Không có giảng viên nào.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $lecturers->appends(request()->query())->links() }} {{-- THÊM appends(request()->query()) --}}
            </div>

        </div>
    </div>
</x-admin-layout>