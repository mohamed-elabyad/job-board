<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Job Board</title>
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="from-10% via-30% to-90% mx-auto mt-4 md:mt-10 max-w-2xl bg-gradient-to-r from-indigo-100 via-sky-100 to-emerald-100 text-slate-700 p-2 md:p-0">
        <nav class="mb-4 md:mb-8 flex justify-between text-lg font-medium relative">
            <!-- Home Link (Always Visible) -->
            <ul class="flex space-x-2">
                <li>
                    <a href="{{ route('jobs.index') }}">Home</a>
                </li>
            </ul>

            <!-- Desktop Navigation (Hidden on Mobile) -->
            <ul class="hidden md:flex space-x-4">
                @auth
                    <li>
                        <a href="{{route('my-applications.index')}}">
                            {{auth()->user()->name}}: Applications
                        </a>
                    </li>
                    <li>
                        <a href="{{route('my-jobs.index')}}">My Jobs</a>
                    </li>
                    <li>
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button>Logout</button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{route('register.create')}}">Register</a>
                    </li>
                    <li>
                        <a href="{{route('login')}}">Login</a>
                    </li>
                @endauth
            </ul>

            <!-- Mobile Hamburger Menu Button -->
            <button id="mobile-menu-button" class="md:hidden flex items-center text-slate-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Mobile Menu Popup -->
            <div id="mobile-menu" class="hidden md:hidden absolute top-12 right-0 bg-indigo-600 text-white rounded-lg shadow-xl z-50 min-w-[200px]">
                <ul class="flex flex-col py-2">
                    @auth
                        <li class="border-b border-indigo-500">
                            <a href="{{route('my-applications.index')}}" class="block px-4 py-3 hover:bg-indigo-700 transition-colors">
                                {{auth()->user()->name}}: Applications
                            </a>
                        </li>
                        <li class="border-b border-indigo-500">
                            <a href="{{route('my-jobs.index')}}" class="block px-4 py-3 hover:bg-indigo-700 transition-colors">
                                My Jobs
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{route('logout')}}">
                                @csrf
                                <button class="w-full text-left px-4 py-3 hover:bg-indigo-700 transition-colors">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="border-b border-indigo-500">
                            <a href="{{route('register.create')}}" class="block px-4 py-3 hover:bg-indigo-700 transition-colors">
                                Register
                            </a>
                        </li>
                        <li>
                            <a href="{{route('login')}}" class="block px-4 py-3 hover:bg-indigo-700 transition-colors">
                                Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>

        @if (session('success'))
            <div role="alert"
                class="my-8 rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div role="alert"
                class="my-8 rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-red-700 opacity-75">
                <p class="font-bold">Error!</p>
                <p>{{session('error')}}</p>
            </div>
        @endif


        {{$slot}}
    </body>
</html>
