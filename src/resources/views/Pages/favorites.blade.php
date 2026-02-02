@extends('main')

@section('title', 'My Saved Favorites | GeoAsk')

@section('content')
    <div class="bg-gray-50 min-h-screen">
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="h-12 w-12 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center text-2xl shadow-sm">
                            <i class="fa-solid fa-heart"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-extrabold text-gray-900">Your Favorites</h1>
                            <p class="text-gray-500 mt-1">Quick access to the discussions you saved.</p>
                        </div>
                    </div>
                    <a href="{{ route('questions.index') }}"
                        class="hidden md:block bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                        Browse More
                    </a>
                </div>
            </div>
        </div>

        <main class="max-w-5xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
            <div class="space-y-6">
                {{-- We use $favorites passed from the controller (Collection of Question models) --}}
                @forelse($favorites as $question)
                    <div
                        class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition group relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1.5 h-full bg-red-400"></div>

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
                                class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full flex items-center gap-1">
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

                                {{-- The Toggle Form: Sending the REAL Question ID --}}
                                <form action="{{ route('favorites.toggle', $question->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="text-sm text-red-500 hover:text-red-700 transition flex items-center gap-1.5 font-bold">
                                        <i class="fa-solid fa-heart"></i>
                                        Remove from Favorites
                                    </button>
                                </form>
                            </div>

                            <a href="{{ route('questions.show', $question->id) }}"
                                class="text-sm font-bold text-indigo-600 hover:underline">
                                View Full Thread →
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-16 rounded-3xl text-center border-2 border-dashed border-gray-200">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 bg-gray-50 text-gray-300 rounded-full mb-4">
                            <i class="fa-solid fa-bookmark text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No favorites yet</h3>
                        <p class="text-gray-500 mb-8 max-w-sm mx-auto">Found a question you want to keep? Hit the heart icon
                            to save it here.</p>
                        <a href="{{ route('questions.index') }}"
                            class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                            Explore Questions
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if (method_exists($favorites, 'links'))
                <div class="mt-12">
                    {{ $favorites->links() }}
                </div>
            @endif
        </main>
    </div>
@endsection
