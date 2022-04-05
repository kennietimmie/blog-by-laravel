<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" class="py-5">
            @csrf

            <!-- Name -->
            <div>
                <x-form.label for="name" :value="__('Name')" />

                <x-form.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" :error="$errors->get('name')" required autofocus />
            </div>

            <!-- Username -->
            <div>
                <x-form.label for="username" :value="__('Username')" />

                <x-form.input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"  :error="$errors->get('username')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-form.label for="email" :value="__('Email')" />

                <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  :error="$errors->get('eamil')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-form.label for="password" :value="__('Password')" />

                <x-form.input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                 :error="$errors->get('password')"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-form.label for="password_confirmation" :value="__('Confirm Password')" />

                <x-form.input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation"  :error="$errors->get('password_confirmation')" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-form.button class="ml-4">
                    {{ __('Register') }}
                </x-form.button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
