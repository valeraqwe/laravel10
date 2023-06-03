<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Дякуємо за реєстрацію! Перш ніж почати, чи могли б ви підтвердити свою електронну адресу, натиснувши посилання, яке було щойно надіслане вам? Якщо ви не отримали листа, вам з радістю буде надіслано інший.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Нове посилання для підтвердження було надіслано на електронну адресу, яку ви вказали під час реєстрації.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
