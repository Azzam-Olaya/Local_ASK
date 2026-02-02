@extends('main')

@section('title', 'Ask a Question | GeoAsk')

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <nav class="flex mb-8 text-sm text-gray-500">
                <a href="/browse" class="hover:text-indigo-600 transition">Questions</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900 font-medium">New Question</span>
            </nav>

            <div class="bg-white rounded-3xl shadow-xl shadow-indigo-100/50 border border-gray-100 overflow-hidden">
                <div class="bg-indigo-600 p-8 text-white">
                    <h1 class="text-2xl font-bold">Ask the Community</h1>
                    <p class="text-indigo-100 text-sm mt-1">Get answers from people living in your area.</p>
                </div>

                <form action="{{ route('questions.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Question Title</label>
                        <input type="text" name="title" id="title" required value="{{ old('title') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('title') border-red-500 @enderror"
                            placeholder="e.g., Where is the best place to find fresh organic vegetables?">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-bold text-gray-700 mb-2">Details</label>
                        <textarea name="body" id="content" rows="6" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('content') border-red-500 @enderror"
                            placeholder="Provide more context here. The more details, the better the answers!">{{ old('content') }}</textarea>
                        <div class="flex justify-between mt-1">
                            @error('body')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                            <p id="charCount" class="text-xs text-gray-400 ml-auto">0 / 1000 characters</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit"
                            class="flex-grow bg-indigo-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 active:scale-[0.98]">
                            Publish Question
                        </button>
                        <a href="/browse" class="px-8 py-4 text-gray-500 font-bold hover:text-gray-700 transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>

            <div class="mt-8 bg-amber-50 rounded-2xl p-6 border border-amber-100">
                <h3 class="flex items-center gap-2 text-amber-800 font-bold mb-2">
                    <i class="fa-solid fa-lightbulb"></i>
                    Quick Tips for a Great Question
                </h3>
                <ul class="text-amber-700 text-sm space-y-2 list-disc ml-5">
                    <li>Check for similar questions before posting.</li>
                    <li>Use a clear, descriptive title.</li>
                    <li>Be polite and respect the community guidelines.</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Content character counter
        const textarea = document.getElementById('content');
        const charCount = document.getElementById('charCount');

        textarea.addEventListener('input', () => {
            const count = textarea.value.length;
            charCount.innerText = `${count} / 1000 characters`;
            if (count > 900) {
                charCount.classList.add('text-amber-600');
            } else {
                charCount.classList.remove('text-amber-600');
            }
        });
    </script>
@endsection
