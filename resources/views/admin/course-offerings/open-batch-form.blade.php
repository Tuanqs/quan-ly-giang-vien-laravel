<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mở Lớp học phần hàng loạt') }}
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            @if ($errors->any())
                <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    <div class="font-medium">{{ __('Rất tiếc! Có lỗi xảy ra.') }}</div>
                    <ul class="mt-1 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                    {{ session('success') }}
                    @if (session('warning'))
                        <br>{{ session('warning') }}
                    @endif
                </div>
            @endif
             @if (session('error'))
                <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    {{ session('error') }}
                </div>
            @endif


            <form method="POST" action="{{ route('admin.course-offerings.open-batch.store') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="semester_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Kì học <span class="text-red-500">*</span></label>
                        <select id="semester_id" name="semester_id" required
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                            <option value="">-- Chọn Kì học --</option>
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}" {{ old('semester_id') == $semester->id ? 'selected' : '' }}>
                                    {{ $semester->name }} ({{ $semester->academicYear->name }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="subject_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Học phần <span class="text-red-500">*</span></label>
                        <select id="subject_id" name="subject_id" required
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                            <option value="">-- Chọn Học phần --</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }} ({{ $subject->subject_code }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="number_of_classes" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Số lượng lớp cần mở <span class="text-red-500">*</span></label>
                        <input id="number_of_classes" type="number" name="number_of_classes" value="{{ old('number_of_classes', 1) }}" min="1" max="50" required
                               class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                    </div>

                    <div>
                        <label for="max_students_per_class" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Sĩ số tối đa/lớp <span class="text-red-500">*</span></label>
                        <input id="max_students_per_class" type="number" name="max_students_per_class" value="{{ old('max_students_per_class', 50) }}" min="1" max="200" required
                               class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                    </div>

                    <div class="md:col-span-2">
                        <label for="class_code_prefix" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Tiền tố Mã lớp (Tùy chọn, nếu trống sẽ lấy Mã HP)</label>
                        <input id="class_code_prefix" type="text" name="class_code_prefix" value="{{ old('class_code_prefix') }}"
                               class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                               placeholder="Ví dụ: IT101 hoặc để trống">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Hệ thống sẽ tự động thêm hậu tố dạng '.N01', '.N02',...</p>
                    </div>

                    <div class="md:col-span-2">
                        <label for="common_schedule_info" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Thông tin Lịch học chung (Tùy chọn)</label>
                        <textarea id="common_schedule_info" name="common_schedule_info" rows="3"
                                  class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                  placeholder="Ví dụ: Thứ 2, Tiết 1-3, Phòng A101; Thứ 5, Tiết 7-9, Phòng B202">{{ old('common_schedule_info') }}</textarea>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Nếu nhập, thông tin này sẽ áp dụng cho tất cả các lớp được mở. Có thể sửa chi tiết cho từng lớp sau.</p>
                    </div>

                    <div class="md:col-span-2">
                        <label for="common_lecturer_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Phân công Giảng viên chung (Tùy chọn)</label>
                        <select id="common_lecturer_id" name="common_lecturer_id"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                            <option value="">-- Không phân công ngay --</option>
                            @foreach ($lecturers as $lecturer)
                                <option value="{{ $lecturer->id }}" {{ old('common_lecturer_id') == $lecturer->id ? 'selected' : '' }}>
                                    {{ $lecturer->full_name }} ({{ $lecturer->lecturer_code }})
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Nếu chọn, giảng viên này sẽ được phân công cho tất cả các lớp được mở.</p>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('dashboard') }}" {{-- Hoặc route('subjects.index') --}}
                       class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md">
                        {{ __('Hủy') }}
                    </a>
                    <button type="submit"
                            class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        {{ __('Mở Lớp') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>