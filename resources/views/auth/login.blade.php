<x-layout>

  <h1 class="my-16 text-center text-4xl font-medium text-slate-600">
    Sign in to your account
  </h1>

  <x-card class="py-8 px-16">
    <form action="{{ route('login.store') }}" method="POST">
      @csrf

      <div class="mb-8">
        <x-label for="email" required="true">E-mail</x-label>
        <x-text-input name="email" placeholder="Email" type='email' />
      </div>

      <div class="mb-8">
        <x-label for="password" required="true">
          Password
        </x-label>
        <x-text-input name="password" type="password" placeholder='Password'/>
      </div>

        <div class="mb-8 ">
          <div class="flex items-center space-x-2">
            <input type="checkbox" name="remember" id="remember"
              class="rounded-sm border border-slate-400" />
            <x-label for="remember" class="mb-0">Remember me</x-label>
          </div>
        </div>


      <x-button class="w-full bg-green-50">Login</x-button>
    </form>
  </x-card>
</x-layout>
