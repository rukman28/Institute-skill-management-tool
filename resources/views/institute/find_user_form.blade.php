{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('find.user') }}">
        @csrf

        <div>Find Student</div>

        @if(session()->has('warning'))
        <p class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
            {{session('warning')}}

        </p>
        @endif

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="code" :value="__('Code')" />
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')"  autofocus autocomplete="code" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <a href="{{route('institutes.dashboard')}}" class="btn_dark"><-Back</a>
            <x-primary-button class=" mt-4">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<x-layout>

    <div class="h-screen bg-gray-200 py-20 p-4 md:p-20 lg:p-32">
        <div class="max-w-sm bg-white rounded-lg overflow-hidden shadow-lg mx-auto">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Find Student!</h2>
                <form method="POST" action="{{ route('find.user') }}">
                    @csrf
                    <div class="mb-4">
                        <input class="p-2 mt-2 rounded-xl border w-full" id="email" name="email" type="email" placeholder="Email">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    </div>

                    <div class="mb-6">
                        <input class="p-2 mt-2 rounded-xl border w-full" id="code" name="code" type="text" placeholder="Code">
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />

                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Find
              </button>

                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>
