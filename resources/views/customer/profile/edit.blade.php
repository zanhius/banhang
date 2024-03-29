<x-customer-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Thông tin người dùng') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Hiển thị thông báo thành công -->
        @if(session('success'))
            <div class="brarez brarez-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Hiển thị thông báo lỗi -->
        @if(session('error'))
            <div class="brarez brarez-error">
                {{ session('error') }}
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('customer.profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('customer.profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('customer.profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-customer-app-layout>
