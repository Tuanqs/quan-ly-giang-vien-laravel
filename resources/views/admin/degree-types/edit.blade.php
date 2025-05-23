<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chỉnh sửa Danh mục Bằng cấp') }}
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            {{-- Hiển thị lỗi validation (nếu có) --}}
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

            <form method="POST" action="{{ route('degree-types.update', $degreeType->id) }}">
                @csrf
                @method('PUT') {{-- Quan trọng: Sử dụng phương thức PUT cho update --}}

                <div>
                    <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Tên Danh mục') }} <span class="text-red-500">*</span></label>
                    <input id="name" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                           type="text" name="name" value="{{ old('name', $degreeType->name) }}" required autofocus />
                </div>

                <div class="mt-4">
                    <label for="abbreviation" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Viết tắt') }}</label>
                    <input id="abbreviation" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                           type="text" name="abbreviation" value="{{ old('abbreviation', $degreeType->abbreviation) }}" />
                </div>

                <div class="mt-4">
                    <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Mô tả') }}</label>
                    <textarea id="description" name="description" rows="3"
                              class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">{{ old('description', $degreeType->description) }}</textarea>
                </div>

                <div class="flex items-center justify-end mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('degree-types.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('Hủy') }}
                    </a>
                    <button type="submit"
                            class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        {{ __('Cập nhật Danh mục') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>