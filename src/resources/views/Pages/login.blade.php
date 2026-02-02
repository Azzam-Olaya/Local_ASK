@extends('main')

@section('title', 'Login | LocalASK')

@section('content')
    <div class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

            <div class="bg-indigo-600 p-8 text-center text-white">
                <h1 class="text-3xl font-bold tracking-tight">Welcome Back</h1>
                <p class="text-indigo-100 mt-2">Log in to your LocalAsk account</p>
            </div>

            <form method="POST" action="{{ route('submit_login') }}" class="p-8 space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <i class="fa-regular fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('email') border-red-500 @enderror"
                            placeholder="name@example.com">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between mb-1">
                        <label for="password" class="text-sm font-semibold text-gray-700">Password</label>
                        <a href="#" class="text-xs text-indigo-600 hover:underline">Forgot password?</a>
                    </div>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="password" name="password" id="password" required
                            class="w-full pl-10 pr-12 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePassword('password')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-indigo-600">
                            <i class="fa-solid fa-eye" id="eye-password"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-indigo-700 transition transform active:scale-[0.98] shadow-lg shadow-indigo-100">
                    Sign In
                </button>

                <div class="text-center pt-4 border-t border-gray-100 mt-6">
                    <p class="text-gray-500 text-sm">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline">Create an
                            account</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = document.getElementById('eye-' + id);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
@endsection
