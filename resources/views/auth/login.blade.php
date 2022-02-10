<x-guest-layout title="Login - Larakeu">
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" type="email" name="email" :value="old('email')" autofocus />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" type="password" name="password" />
            </div>

            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <x-button class="ml-4">
                        Login <span data-feather="log-in"></span>
                    </x-button>
                </div>
                <div>
                    <a class="underline text-sm text-gray-600" href="{{ route('register') }}">
                        {{ __("Don't have an account ?") }}
                    </a>
                </div>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
