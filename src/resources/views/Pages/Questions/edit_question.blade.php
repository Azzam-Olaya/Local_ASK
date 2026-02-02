@extends('main')

@section('title', 'Edit Question | LocalASK')

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <a href="{{ route('questions.show', $question->id) }}"
                    class="text-indigo-600 font-medium hover:underline flex items-center gap-2 mb-2">
                    <i class="fa-solid fa-arrow-left"></i> Back to Question
                </a>
                <h1 class="text-3xl font-extrabold text-gray-900">Edit Your Question</h1>
                <p class="text-gray-500">Update the details of your discussion.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <form action="{{ route('questions.update', $question->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Required for Update requests --}}

                    <div class="mb-6">
                        <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $question->title) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('title') border-red-500 @enderror"
                            placeholder="e.g. Best pizza places in downtown?">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label for="content" class="block text-sm font-bold text-gray-700 mb-2">Details</label>
                        <textarea name="body" id="content" rows="8"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('content') border-red-500 @enderror"
                            placeholder="Provide more context... వీరి">{{ old('body', $question->body) }}</textarea>
                        @error('body')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('questions.show', $question->id) }}"
                            class="px-6 py-2.5 rounded-xl font-bold text-gray-600 hover:bg-gray-100 transition">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-2.5 rounded-xl font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
