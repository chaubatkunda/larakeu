<x-guest-layout title="Register - Larakeu">
    <x-auth-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" type="text" name="name" :value="old('name')" autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" type="email" name="email" :value="old('email')" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" type="password" name="password" autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" type="password" name="password_confirmation" />
            </div>

            <div class="d-flex align-items-center justify-content-between mt-4">
                <div>
                    <x-button class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
                <div>
                    <a class="underline text-sm text-gray-600" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>


            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
