
<x-guest-layout>


    <form method="POST" action="{{ route('register') }}">
        @csrf

         <!-- Name -->
         <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="p-2 mt-8 rounded-xl border w-full" type="text" name="name" :value="old('name')"  autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

<!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="p-2 mt-8 rounded-xl border w-full" type="email" name="email" :value="old('email')"  autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

<!-- Phone number -->

        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="p-2 mt-8 rounded-xl border w-full" type="tel" pattern="[0-9]{10}" name="phone" :value="old('phone')"  autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>


<!-- Address -->

        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="p-2 mt-8 rounded-xl border w-full" type="text" name="address" :value="old('address')"  autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

<!-- Code -->

        <div class="mt-4">
            <x-input-label for="code" :value="__('Six digit code')" />
            <x-text-input id="code" class="p-2 mt-8 rounded-xl border w-full" type="text" pattern="[0-9]{6}" name="code" :value="old('code')"  autocomplete="address" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="p-2 mt-8 rounded-xl border w-full"
                            type="password"
                            name="password"
                             autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="p-2 mt-8 rounded-xl border w-full"
                            type="password"
                            name="password_confirmation"  autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
