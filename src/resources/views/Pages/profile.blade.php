@extends('main')

@section('title', 'My Profile | GeoAsk')

@section('content')
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm mb-8">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div
                        class="h-24 w-24 rounded-2xl bg-indigo-600 flex items-center justify-center text-white text-4xl font-black shadow-lg shadow-indigo-200">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="text-center md:text-left flex-grow">
                        <h1 class="text-3xl font-bold text-gray-900">{{ auth()->user()->name }}</h1>
                        <p class="text-gray-500">{{ auth()->user()->email }}</p>
                        <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-4">
                            <span
                                class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-xs font-bold uppercase tracking-wider">
                                {{ auth()->user()->role }} Account
                            </span>
                            <span
                                class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold uppercase tracking-wider">
                                Member since {{ auth()->user()->created_at->format('M Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-xl font-bold hover:bg-gray-50 transition">
                            Edit Profile
                        </button>
                    </div>
                </div>
            </div>

            <div x-data="{ tab: 'questions' }">
                <div class="flex gap-8 border-b border-gray-200 mb-8">
                    <button @click="tab = 'questions'"
                        :class="tab === 'questions' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500'"
                        class="pb-4 border-b-2 font-bold transition">
                        My Questions ({{ $myQuestions->count() }})
                    </button>
                </div>

                <div x-show="tab === 'questions'" class="space-y-6">
                    @forelse($myQuestions as $question)
                        <div
                            class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <span
                                    class="text-xs font-bold text-gray-400 uppercase">{{ $question->created_at->format('d M, Y') }}</span>
                                <h3 class="text-lg font-bold text-gray-900 mt-1 hover:text-indigo-600">
                                    <a href="{{ route('questions.show', $question->id) }}">{{ $question->title }}</a>
                                </h3>
                                <div class="flex items-center gap-3 mt-2 text-sm text-gray-500">
                                    <span><i class="fa-regular fa-comment mr-1"></i> {{ $question->responses_count }}
                                        answers</span>
                                    <span><i class="fa-solid fa-location-dot mr-1"></i> {{ $question->location }}</span>
                                </div>
                            </div>
                            <div class="flex gap-2 w-full md:w-auto">
                                <a href="{{ route('questions.edit', $question->id) }}"
                                    class="flex-grow md:flex-none text-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg font-bold hover:bg-blue-100 transition text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('questions.destroy', $question->id) }}" method="POST"
                                    class="flex-grow md:flex-none" onsubmit="return confirm('Delete this question?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="w-full text-center px-4 py-2 bg-red-50 text-red-600 rounded-lg font-bold hover:bg-red-100 transition text-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-12 rounded-3xl text-center border-2 border-dashed border-gray-100">
                            <p class="text-gray-500 italic">You haven't posted any questions yet.</p>
                            <a href="{{route('questions.create')}}" class="text-indigo-600 font-bold mt-2 inline-block">Ask your first
                                question</a>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
