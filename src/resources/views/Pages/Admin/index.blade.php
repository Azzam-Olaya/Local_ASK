@extends('main')

@section('title', 'Admin Dashboard | GeoAsk')

@section('content')
    <div class="bg-gray-50 min-h-screen pb-12">

        <div class="bg-indigo-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-extrabold flex items-center gap-3">
                    <i class="fa-solid fa-user-shield"></i> Admin Dashboard
                </h1>
                <p class="text-indigo-200 mt-2">Overview of community activity and moderation tools.</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-indigo-50 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total Users</p>
                        <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $stats['total_users'] }}</p>
                    </div>
                    <div class="h-12 w-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-lg border border-indigo-50 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Questions</p>
                        <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $stats['total_questions'] }}</p>
                    </div>
                    <div class="h-12 w-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fa-solid fa-circle-question"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-lg border border-indigo-50 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Responses</p>
                        <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $stats['total_responses'] }}</p>
                    </div>
                    <div class="h-12 w-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fa-regular fa-comments"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                        <h3 class="font-bold text-gray-800">Recent Users</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="bg-gray-50 text-gray-900 font-bold">
                                <tr>
                                    <th class="px-6 py-3">Name</th>
                                    <th class="px-6 py-3">Role</th>
                                    <th class="px-6 py-3">Joined</th>
                                    <th class="px-6 py-3 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-1 rounded-md text-xs font-bold {{ $user->role === 'admin' ? 'bg-indigo-100 text-indigo-700' : 'bg-gray-100 text-gray-600' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">{{ $user->created_at->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 text-right">
                                            @if ($user->id !== auth()->id())
                                                <form action="{{ route('admin.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Ban this user?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="text-red-500 hover:text-red-700 font-bold text-xs bg-red-50 px-3 py-1 rounded-lg">Ban</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                        <h3 class="font-bold text-gray-800">Recent Questions</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="bg-gray-50 text-gray-900 font-bold">
                                <tr>
                                    <th class="px-6 py-3">Title</th>
                                    <th class="px-6 py-3">Author</th>
                                    <th class="px-6 py-3 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($questions as $question)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-900 truncate max-w-[150px]">
                                            <a href="{{ route('questions.show', $question->id) }}"
                                                class="hover:text-indigo-600 hover:underline">
                                                {{ $question->title }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">{{ $question->user->name }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('questions.destroy', $question->id) }}" method="POST"
                                                onsubmit="return confirm('Delete this question?');">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="text-red-500 hover:text-red-700 font-bold text-xs bg-red-50 px-3 py-1 rounded-lg">Delete</button>
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
