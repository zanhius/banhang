<section>
    <header>

        @if (session('status') === 'profile-updated')
            <p style="color: green"
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
            >{{ __('Thay đổi thông tin thành công.') }}</p>
        @endif

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Thông tin cá nhân') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Cập nhật thông tin hồ sơ và địa chỉ email của tài khoản của bạn.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('customer.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Tên')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                          :value="old('name', $customer->name)" required autofocus autocomplete="name"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                          :value="old('email', $customer->email)" required autocomplete="username"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>

            @if ($customer instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $customer->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Địa chỉ email của bạn chưa được xác minh') }}

                        <button form="send-verification"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Nhấp vào đây để gửi lại email xác minh.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="phone_number" :value="__('Số điện thoại')"/>
            <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full"
                          :value="old('phone_number', $customer->phone_number)" required autofocus autocomplete="phone_number"/>
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')"/>
        </div>

        <div>
            <x-input-label for="address" :value="__('Địa chỉ')"/>
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                          :value="old('address', $customer->address)" required autofocus autocomplete="address"/>
            <x-input-error class="mt-2" :messages="$errors->get('address')"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Lưu') }}</x-primary-button>
        </div>
    </form>
</section>
