@extends('main')

@section('title', 'Browse All Questions | GeoAsk')

@section('content')
    <div class="bg-gray-50 min-h-screen">

        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
                <div class="flex flex-row justify-between pb-5 items-center">
                    <h1 class="text-3xl font-extrabold text-gray-900 mb-6">Explore the Community</h1>
                    @auth
                        <a href="{{ route('questions.create') }}"
                            class="inline-flex items-center justify-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 whitespace-nowrap">
                            <i class="fa-solid fa-plus-circle text-lg"></i>
                            Post a Question
                        </a>
                    @endauth
                </div>
                <form action="" method="GET" class="flex flex-col lg:flex-row gap-4">
                    <div class="flex-grow relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search by title or keyword..."
                            class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition bg-gray-50">
                    </div>

                    <div class="relative w-full lg:w-64">
                        <i class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="location" value="{{ request('location') }}"
                            placeholder="Location (e.g. Paris)"
                            class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition bg-gray-50">
                    </div>

                    <select name="sort"
                        class="px-6 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:ring-2 focus:ring-indigo-500 outline-none font-medium text-gray-700">
                        <option value="distance" {{ request('sort') == 'distance' ? 'selected' : '' }}>Sort by: Distance
                        </option>
                        <option value="newest" {{ request('sort') == 'newest' || !request('sort') ? 'selected' : '' }}>Sort
                            by: Newest</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Sort by: Popular
                        </option>
                    </select>

                    <button type="submit"
                        class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                        Search
                    </button>
                </form>
            </div>
        </div>

        <main class="max-w-5xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-lg font-semibold text-gray-600">Showing {{ $questions->count() }} Questions</h2>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-400">Filter:</span>
                    <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full uppercase">All
                        Questions</span>
                </div>
            </div>

            <div class="space-y-6">
                @forelse($questions as $question)
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition group">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($question->user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900">{{ $question->user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $question->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <span
                                class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full flex items-center gap-1">
                                <i class="fa-solid fa-location-dot text-[10px]"></i> {{ $question->location }}
                            </span>
                        </div>

                        <a href="{{ route('questions.show', $question->id) }}" class="block">
                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition mb-2">
                                {{ $question->title }}
                            </h3>
                            <p class="text-gray-600 line-clamp-2">
                                {{ $question->content }}
                            </p>
                        </a>

                        <div class="mt-6 flex items-center justify-between border-t pt-4">
                            <div class="flex items-center gap-6">
                                <span class="text-sm text-gray-500 flex items-center gap-1.5">
                                    <i class="fa-regular fa-comment text-indigo-500"></i>
                                    <strong>{{ $question->responses->count() }}</strong> answers
                                </span>

                                @auth
                                    <form action="{{ route('favorites.toggle', $question->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="text-sm {{ auth()->user()->favorites->contains($question->id) ? 'text-red-500' : 'text-gray-400' }} hover:text-red-500 transition flex items-center gap-1.5">
                                            <i
                                                class="{{ auth()->user()->favorites->contains($question->id) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                            {{ auth()->user()->favorites->contains($question->id) ? 'Saved' : 'Favorite' }}
                                        </button>
                                    </form>
                                @endauth
                            </div>

                            <div class="flex gap-2">
                                @auth
                                    @if (auth()->user()->role === 'admin' || auth()->id() === $question->user_id)
                                        <a href="{{ route('questions.edit', $question->id) }}"
                                            class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded hover:bg-blue-100">Edit</a>

                                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-xs font-bold text-red-600 bg-red-50 px-2 py-1 rounded hover:bg-red-100">Delete</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-12 rounded-2xl text-center border border-gray-200">
                        <p class="text-gray-500 text-lg">No questions found matching your criteria.</p>
                    </div>
                @endforelse
            </div>

            @if (method_exists($questions, 'links'))
                <div class="mt-12">
                    {{ $questions->links() }}
                </div>
            @endif
        </main>
    </div>
@endsection
