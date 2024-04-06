<x-sesiones>
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                    <x-text-input id="email" class="login-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <!-- Password -->
                    <x-text-input id="password" class="login-input"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')"/>

                        <x-primary-button class="button-input">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </form>
                </x-sesiones>
