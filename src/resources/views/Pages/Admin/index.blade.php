@extends('main')

@section('title', 'Admin Dashboard | LocalAsk')

@section('content')
    <div class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen pb-12">

        <!-- Header Section -->
        <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 text-white py-16 shadow-xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center gap-4 mb-3">
                            <div class="bg-white/20 backdrop-blur-sm p-3 rounded-xl">
                                <i class="fa-solid fa-user-shield text-2xl"></i>
                            </div>
                            <h1 class="text-4xl font-bold">Admin Dashboard</h1>
                        </div>
                        <p class="text-indigo-100 text-lg">Gérez votre communauté et modérez le contenu facilement</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="bg-white/10 backdrop-blur-md px-6 py-3 rounded-xl border border-white/20">
                            <p class="text-sm text-indigo-200">Connecté en tant que</p>
                            <p class="font-semibold text-lg">Administrateur</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10">

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <!-- Total Users Card -->
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-blue-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 h-14 w-14 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                            <i class="fa-solid fa-users text-2xl"></i>
                        </div>
                        <span class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">Total</span>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Utilisateurs</h3>
                    <p class="text-4xl font-extrabold text-gray-900">{{ $stats['total_users'] }}</p>
                    <div class="mt-4 flex items-center text-sm text-green-600">
                        <i class="fa-solid fa-arrow-up mr-1"></i>
                        <span class="font-semibold">Membres actifs</span>
                    </div>
                </div>

                <!-- Total Questions Card -->
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-purple-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="bg-gradient-to-br from-purple-500 to-purple-600 h-14 w-14 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-purple-200">
                            <i class="fa-solid fa-circle-question text-2xl"></i>
                        </div>
                        <span class="bg-purple-50 text-purple-700 text-xs font-bold px-3 py-1 rounded-full">Total</span>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Questions</h3>
                    <p class="text-4xl font-extrabold text-gray-900">{{ $stats['total_questions'] }}</p>
                    <div class="mt-4 flex items-center text-sm text-purple-600">
                        <i class="fa-solid fa-chart-line mr-1"></i>
                        <span class="font-semibold">Discussions ouvertes</span>
                    </div>
                </div>

                <!-- Total Responses Card -->
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-green-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="bg-gradient-to-br from-green-500 to-green-600 h-14 w-14 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-green-200">
                            <i class="fa-regular fa-comments text-2xl"></i>
                        </div>
                        <span class="bg-green-50 text-green-700 text-xs font-bold px-3 py-1 rounded-full">Total</span>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Réponses</h3>
                    <p class="text-4xl font-extrabold text-gray-900">{{ $stats['total_responses'] }}</p>
                    <div class="mt-4 flex items-center text-sm text-green-600">
                        <i class="fa-solid fa-message mr-1"></i>
                        <span class="font-semibold">Interactions totales</span>
                    </div>
                </div>
            </div>

            <!-- Data Tables Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- Recent Users Table -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-blue-50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="bg-blue-500 h-10 w-10 rounded-lg flex items-center justify-center text-white">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <h3 class="font-bold text-gray-900 text-lg">Utilisateurs Récents</h3>
                            </div>
                            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">
                                {{ count($users) }} membres
                            </span>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-50 text-gray-700 font-semibold border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4">Nom</th>
                                    <th class="px-6 py-4">Rôle</th>
                                    <th class="px-6 py-4">Inscription</th>
                                    <th class="px-6 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-xs">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <span class="font-semibold text-gray-900">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1.5 rounded-lg text-xs font-bold inline-flex items-center gap-1.5 {{ $user->role === 'admin' ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 border border-indigo-200' : 'bg-gray-100 text-gray-700 border border-gray-200' }}">
                                                @if ($user->role === 'admin')
                                                    <i class="fa-solid fa-shield-halved"></i>
                                                @else
                                                    <i class="fa-solid fa-user"></i>
                                                @endif
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">
                                            <div class="flex items-center gap-2">
                                                <i class="fa-regular fa-calendar text-gray-400"></i>
                                                {{ $user->created_at->format('M d, Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            @if ($user->id !== auth()->id())
                                                <form action="{{ route('admin.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir bannir cet utilisateur ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-red-600 hover:text-white hover:bg-red-600 font-semibold text-xs px-4 py-2 rounded-lg border border-red-200 hover:border-red-600 transition-all duration-200 inline-flex items-center gap-2">
                                                        <i class="fa-solid fa-ban"></i>
                                                        Bannir
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-400 text-xs italic">Vous</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Questions Table -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-purple-50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="bg-purple-500 h-10 w-10 rounded-lg flex items-center justify-center text-white">
                                    <i class="fa-solid fa-circle-question"></i>
                                </div>
                                <h3 class="font-bold text-gray-900 text-lg">Questions Récentes</h3>
                            </div>
                            <span class="bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full">
                                {{ count($questions) }} questions
                            </span>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-50 text-gray-700 font-semibold border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4">Titre</th>
                                    <th class="px-6 py-4">Auteur</th>
                                    <th class="px-6 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($questions as $question)
                                    <tr class="hover:bg-purple-50/50 transition-colors duration-200">
                                        <td class="px-6 py-4 max-w-[200px]">
                                            <a href="{{ route('questions.show', $question->id) }}"
                                                class="font-semibold text-gray-900 hover:text-purple-600 hover:underline line-clamp-2 flex items-start gap-2 group">
                                                <i class="fa-solid fa-arrow-up-right-from-square text-xs text-gray-400 group-hover:text-purple-500 mt-1"></i>
                                                <span>{{ $question->title }}</span>
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="h-7 w-7 rounded-full bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-white font-bold text-xs">
                                                    {{ strtoupper(substr($question->user->name, 0, 1)) }}
                                                </div>
                                                <span class="text-gray-700">{{ $question->user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('questions.destroy', $question->id) }}" method="POST"
                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-600 hover:text-white hover:bg-red-600 font-semibold text-xs px-4 py-2 rounded-lg border border-red-200 hover:border-red-600 transition-all duration-200 inline-flex items-center gap-2">
                                                    <i class="fa-solid fa-trash"></i>
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection