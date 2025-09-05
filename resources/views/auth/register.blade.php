<x-layout>

    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">
    Register
    </h1>

    <x-card class="mb-8 py-8 px-16">
        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <div class="mb-8">
                <x-label for="name" required="true">Name</x-label>
            <x-text-input name="name" placeholder="name" type='name' id="name" />
            </div>

            <div class="mb-8">
                <x-label for="email" required="true">E-mail</x-label>
            <x-text-input name="email" placeholder="Email" type='email' id="email" />
            </div>

            <div class="mb-8">
                <x-label for="password" required="true">
                Password
                </x-label>
                <x-text-input name="password" type="password" placeholder='Password'/>
            </div>

            <div class="mb-8">
                <x-label for="password_confirmation" required="true">
                Password
                </x-label>
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" placeholder='Password Confirmation...'/>
            </div>

            <x-button class="w-full bg-green-50">Create Account</x-button>
        </form>
    </x-card>
</x-layout>
