<x-guest-layout>
    <x-authentication-card>
      

        <x-slot name="logo">
            <img src="{{ asset('img/LIBRERIA.svg') }}" alt="" width="600px">
        </x-slot>

        <h2 class=" text-5xl  font-bold text-blue-950 mb-16 mt-5 ">Iniciar Sesión</h2>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('validation') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Correo Electrónico') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-10 ">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif

                <x-button class="ms-4 bg-[#2684b6] hover:bg-[#1c92d2]">
                    {{ __('Iniciar Sesión') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>


        @if (session('error'))
        <script>
            swal.fire({
                title: "Error",
                text: '{{ session('error') }}',
                icon: "error",
                background: '#fff',
                backdrop: false,
                customClass: {
                    container: 'swal-container',
                    popup: 'swal-popup',
                },
                willOpen: () => {
                    document.body.style.zIndex = '9999';
                },
                willClose: () => {
                    document.body.style.overflow = 'auto';
                }
            });
            document.querySelector('.swal-container').style.zIndex = '999999999999999';
            document.querySelector('.swal-popup').style.position = 'fixed';

            document.querySelector('.swal-container').style.top = '-10vh';
            document.querySelector('.swal-container').style.backdropFilter = 'blur(2px)';
        </script>
    @endif
</x-guest-layout>
