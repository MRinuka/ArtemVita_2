<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>
<body class="font-sans text-black antialiased">
    <form wire:submit="register">
        <!-- Name -->
        <div class="mt-4 relative">
            <x-text-input wire:model="name" id="name" class="block mt-4 w-full bg-white text-black border border-gray-300" type="text" name="name" required autofocus autocomplete="name" placeholder="{{ __('Name') }}" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4 relative">
            <x-text-input wire:model="email" id="email" class="block mt-4 w-full bg-white text-black border border-gray-300 rounded-md" type="email" name="email" required autocomplete="username" placeholder="{{ __('Email') }}" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-text-input wire:model="password" id="password" class="block mt-4 w-full bg-white text-black border border-gray-300 rounded-md" type="password" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 relative">
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-4 w-full bg-white text-black border border-gray-300 rounded-md" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-black hover:text-gray-300" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 bg-blue-500 hover:bg-blue-600">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</body>
