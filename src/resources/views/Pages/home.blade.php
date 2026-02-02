@extends('main')

@section('title', 'Home - LocalASK')

@section('content')



<header class="bg-white border-b">
    <div
        class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="max-w-xl">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                Got a question? <span class="text-indigo-600">Ask your neighbors.</span>
            </h1>
            <p class="mt-4 text-lg text-gray-600">
                Find answers based on your location. From local recommendations to community help, LocalAsk connects
                you with the people nearby.
            </p>
            <div class="mt-8 flex gap-4">
                <button onclick="document.getElementById('ask-modal').classList.remove('hidden')"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Ask a Question
                </button>
                <button class="border border-gray-300 px-6 py-3 rounded-xl font-semibold hover:bg-gray-50 transition">
                    Explore Nearby
                </button>
            </div>
        </div>
        <div class="w-full md:w-1/3 bg-indigo-50 p-6 rounded-2xl border border-indigo-100">
            <h3 class="font-bold text-indigo-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-chart-line"></i> Quick Stats
            </h3>
            <div class="space-y-4">
                <div class="bg-white p-3 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Total Questions</p>
                    <p class="text-2xl font-bold">1,284</p>
                </div>
                <div class="bg-white p-3 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Active Users</p>
                    <p class="text-2xl font-bold">850</p>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row gap-4 mb-8">
        <div class="relative flex-grow">
            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input type="text" placeholder="Search by keyword or topic..."
                class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">
        </div>
        <div class="relative w-full md:w-64">
            <i class="fa-solid fa-location-crosshairs absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input type="text" placeholder="Location..."
                class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">
        </div>
        <select
            class="px-4 py-3 rounded-xl border border-gray-200 bg-white focus:ring-2 focus:ring-indigo-500 outline-none">
            <option>Sort by: Newest</option>
            <option>Sort by: Distance</option>
            <option>Sort by: Popular</option>
        </select>
    </div>

    <div class="grid gap-6">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition group">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <span
                        class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-2 py-1 rounded mb-2 inline-block">2.5
                        km away</span>
                    <h2 class="text-xl font-bold group-hover:text-indigo-600 transition cursor-pointer">Best bakery
                        for fresh croissants around here?</h2>
                </div>
                <button onclick="toggleFavorite(this)" class="text-gray-300 hover:text-red-500 transition text-xl">
                    <i class="fa-solid fa-heart"></i>
                </button>
            </div>
            <p class="text-gray-600 line-clamp-2">I just moved to the neighborhood and I'm looking for a bakery that
                opens early on Sundays...</p>
            <div class="mt-6 flex items-center justify-between border-t pt-4">
                <div class="flex items-center gap-3 text-sm text-gray-500">
                    <span class="flex items-center gap-1"><i class="fa-regular fa-comment"></i> 12 answers</span>
                    <span>•</span>
                    <span>Asked by <strong>@JeanD</strong></span>
                </div>
                <span class="text-sm text-gray-400">2 hours ago</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition group">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <span
                        class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded mb-2 inline-block">0.8
                        km away</span>
                    <h2 class="text-xl font-bold group-hover:text-indigo-600 transition cursor-pointer">Any local
                        running groups meeting on Tuesdays?</h2>
                </div>
                <button onclick="toggleFavorite(this)" class="text-gray-300 hover:text-red-500 transition text-xl">
                    <i class="fa-solid fa-heart"></i>
                </button>
            </div>
            <p class="text-gray-600 line-clamp-2">Looking to join a casual running group for 5-10km sessions.
                Preferably starting near the park.</p>
            <div class="mt-6 flex items-center justify-between border-t pt-4">
                <div class="flex items-center gap-3 text-sm text-gray-500">
                    <span class="flex items-center gap-1"><i class="fa-regular fa-comment"></i> 4 answers</span>
                    <span>•</span>
                    <span>Asked by <strong>@Sara_Run</strong></span>
                </div>
                <span class="text-sm text-gray-400">5 hours ago</span>
            </div>
        </div>
    </div>
</main>

<div id="ask-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-[60] flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-8 shadow-2xl">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold">New Question</h3>
            <button onclick="document.getElementById('ask-modal').classList.add('hidden')"
                class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>
        <form class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Title</label>
                <input type="text"
                    class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none"
                    placeholder="What is your question?">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Location</label>
                <input type="text"
                    class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none"
                    placeholder="City or Neighborhood">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Details</label>
                <textarea class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none h-32"
                    placeholder="Provide more context..."></textarea>
            </div>
            <button type="button"
                class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700 transition">Post
                Question</button>
        </form>
    </div>
</div>

@endsection
