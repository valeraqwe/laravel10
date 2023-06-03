<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Забули свій пароль? Просто повідомте свою електронну адресу, і вам прийде на електронну пошту посилання для відновлення пароля, за яким ви зможете створити новий.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Електронна пошта')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Відновити пароль') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
