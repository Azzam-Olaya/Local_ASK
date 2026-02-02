@extends('main')

@section('title', $question->title . ' | GeoAsk')

@section('content')
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">

            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('questions.index') }}"
                    class="text-indigo-600 hover:text-indigo-800 font-bold flex items-center gap-2 transition">
                    <i class="fa-solid fa-arrow-left"></i> Back to Feed
                </a>

                @auth
                    <form action="{{route('favorites.toggle', $question->id)}}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2 px-4 py-2 rounded-xl border transition {{ auth()->user()->favorites->contains($question->id) ? 'bg-red-50 border-red-200 text-red-600' : 'bg-white border-gray-200 text-gray-500 hover:bg-gray-50' }}">
                            <i
                                class="{{ auth()->user()->favorites->contains($question->id) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                            <span>{{ auth()->user()->favorites->contains($question->id) ? 'Saved' : 'Add to Favorites' }}</span>
                        </button>
                    </form>
                @endauth
            </div>

            <article class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex items-center gap-4">
                            <div
                                class="h-12 w-12 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr($question->user->name, 0, 2)) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">{{ $question->user->name }}</h4>
                                <p class="text-xs text-gray-400">Asked {{ $question->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span
                            class="bg-indigo-50 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                            <i class="fa-solid fa-location-dot"></i> {{ $question->location }}
                        </span>
                    </div>

                    <h1 class="text-3xl font-black text-gray-900 mb-6 leading-tight">
                        {{ $question->title }}
                    </h1>

                    <div class="prose max-w-none text-gray-700 text-lg leading-relaxed mb-8">
                        {{ $question->body }}
                    </div>

                    @auth
                        @if (auth()->user()->role === 'admin' || auth()->id() === $question->user_id)
                            <div class="flex gap-3 pt-6 border-t border-gray-50">
                                <a href="{{ route('questions.edit', $question->id) }}"
                                    class="text-sm font-bold text-blue-600 bg-blue-50 px-4 py-2 rounded-lg hover:bg-blue-100 transition">
                                    <i class="fa-solid fa-pen mr-1"></i> Edit
                                </a>
                                <form action="{{ route('questions.destroy', $question->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this question permanently?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="text-sm font-bold text-red-600 bg-red-50 px-4 py-2 rounded-lg hover:bg-red-100 transition">
                                        <i class="fa-solid fa-trash-can mr-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </article>

            <div class="space-y-6">
                <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-comments text-indigo-500"></i>
                    Answers ({{ $question->responses->count() }})
                </h3>

                <div class="space-y-4">
                    @forelse($question->responses as $response)
                        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative group">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-gray-900">{{ $response->user->name }}</span>
                                    <span class="text-gray-400 text-xs">{{ $response->created_at->diffForHumans() }}</span>
                                </div>

                                @auth
                                    @if (auth()->user()->role === 'admin' || auth()->id() === $response->user_id)
                                        <form action="{{ route('responses.destroy', $response->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button
                                                class="text-gray-300 hover:text-red-500 transition opacity-0 group-hover:opacity-100">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                            <p class="text-gray-600 leading-relaxed">{{ $response->body }}</p>
                        </div>
                    @empty
                        <div class="bg-white p-10 rounded-2xl text-center border-2 border-dashed border-gray-100">
                            <p class="text-gray-400">No answers yet. Be the first to help out!</p>
                        </div>
                    @endforelse
                </div>

                @auth
                    <div class="mt-10 bg-white p-8 rounded-3xl border border-indigo-100 shadow-lg shadow-indigo-50">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Your Answer</h3>
                        <form action="{{ route('responses.store', $question->id) }}" method="POST">
                            @csrf
                            <textarea name="body" rows="4" required placeholder="Type your response here..."
                                class="w-full p-4 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition bg-gray-50 mb-4 @error('content') border-red-500 @enderror"></textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mb-4">{{ $message }}</p>
                            @enderror
                            <button type="submit"
                                class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                                Post Answer
                            </button>
                        </form>
                    </div>
                @else
                    <div class="mt-10 bg-gray-100 p-6 rounded-2xl text-center">
                        <p class="text-gray-600">Please <a href="{{ route('login') }}"
                                class="text-indigo-600 font-bold hover:underline">log in</a> to post an answer.</p>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
