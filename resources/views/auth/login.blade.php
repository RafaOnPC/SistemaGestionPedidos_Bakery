<x-sesiones>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" autocomplete="off">
        @csrf

        <!-- Email Address -->
            <x-text-input id="email" class="login-input input-user-icon" type="email" name="email" :value="old('email')" required autofocus autocomplete="off" />
            
        <!-- Password -->
            <x-text-input id="password" class="login-input input-pass-icon"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>

                <x-primary-button class="button-input">
                    {{ __('Log in') }}
                </x-primary-button>


            </form>
        </x-sesiones>
