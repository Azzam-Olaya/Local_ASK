<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <a href="{{ route('questions.index') }}" class="flex items-center gap-2 text-indigo-600 font-bold text-2xl">
                <i class="fa-solid fa-location-dot"></i>
                <span>LocalAsk</span>
            </a>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('questions.index') }}" class="text-gray-600 hover:text-indigo-600 transition">Browse
                    Questions</a>
                <a href="{{ route('stats') }}" class="text-gray-600 hover:text-indigo-600 transition">Stats</a>

                <div class="h-6 w-px bg-gray-200"></div>

                @guest
                    <a href="{{ route('login') }}" class="text-gray-600 font-medium cursor-pointer">Log In</a>
                    <a href="{{ route('register') }}"
                        class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition shadow-md cursor-pointer">
                        Sign Up
                    </a>
                @endguest

                @auth
                    <div class="flex items-center gap-6">
                        <a href="{{ route('favorites.index') }}"
                            class="flex items-center gap-1 text-gray-600 font-medium hover:text-red-500 transition">
                            <i class="fa-solid fa-heart text-red-400"></i>
                            Favorites
                        </a>

                        @if (Auth::user()->role === 'admin')
                            <a href="{{route('admin.index')}}"
                                class="flex items-center gap-1 text-red-600 font-bold hover:text-red-700">
                                <i class="fa-solid fa-user-shield"></i>
                                Admin Panel
                            </a>
                        @else
                            <a href="/profile"
                                class="flex items-center gap-1 text-indigo-600 font-medium hover:text-indigo-700">
                                <i class="fa-solid fa-circle-user"></i>
                                My Profile
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-gray-500 hover:text-gray-800 transition text-sm flex items-center gap-1">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
