@extends('main')

@section('title', 'Community Statistics | LocalASK')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">

        <div class="mb-10 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">LocalAsk Insights</h1>
            <p class="mt-3 text-lg text-gray-500 italic">Static Snapshot of Community Engagement</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-indigo-100 text-indigo-600 rounded-xl mb-4">
                    <i class="fa-solid fa-file-circle-question text-xl"></i>
                </div>
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Questions</p>
                <h2 class="text-4xl font-black text-gray-900 mt-1">1,254</h2>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-green-100 text-green-600 rounded-xl mb-4">
                    <i class="fa-solid fa-comments text-xl"></i>
                </div>
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Responses</p>
                <h2 class="text-4xl font-black text-gray-900 mt-1">3,892</h2>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-amber-100 text-amber-600 rounded-xl mb-4">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Active Members</p>
                <h2 class="text-4xl font-black text-gray-900 mt-1">840</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50 bg-gray-50/50 flex items-center gap-2">
                    <i class="fa-solid fa-fire text-orange-500"></i>
                    <h3 class="font-bold text-gray-900">Trending Questions</h3>
                </div>
                <div class="divide-y divide-gray-100">
                    <div class="p-6 flex items-center gap-4 hover:bg-gray-50 transition">
                        <div class="text-2xl font-black text-gray-200">#1</div>
                        <div class="flex-grow">
                            <span class="font-bold text-gray-900 block">Best pizza in the city center?</span>
                            <span class="text-xs text-gray-500">Location: Paris, FR</span>
                        </div>
                        <div class="text-right">
                            <span class="bg-indigo-50 text-indigo-700 text-xs font-bold px-2.5 py-1 rounded-full">42
                                responses</span>
                        </div>
                    </div>

                    <div class="p-6 flex items-center gap-4 hover:bg-gray-50 transition">
                        <div class="text-2xl font-black text-gray-200">#2</div>
                        <div class="flex-grow">
                            <span class="font-bold text-gray-900 block">Any local running groups?</span>
                            <span class="text-xs text-gray-500">Location: London, UK</span>
                        </div>
                        <div class="text-right">
                            <span class="bg-indigo-50 text-indigo-700 text-xs font-bold px-2.5 py-1 rounded-full">28
                                responses</span>
                        </div>
                    </div>

                    <div class="p-6 flex items-center gap-4 hover:bg-gray-50 transition">
                        <div class="text-2xl font-black text-gray-200">#3</div>
                        <div class="flex-grow">
                            <span class="font-bold text-gray-900 block">Finding a plumber for an emergency</span>
                            <span class="text-xs text-gray-500">Location: Lyon, FR</span>
                        </div>
                        <div class="text-right">
                            <span class="bg-indigo-50 text-indigo-700 text-xs font-bold px-2.5 py-1 rounded-full">15
                                responses</span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 flex flex-col justify-center items-center text-center">
                <div class="w-full h-48 bg-gray-50 rounded-2xl mb-6 flex items-end justify-around p-4 gap-2">
                    <div class="w-full bg-indigo-200 rounded-t-lg" style="height: 35%"></div>
                    <div class="w-full bg-indigo-300 rounded-t-lg" style="height: 55%"></div>
                    <div class="w-full bg-indigo-400 rounded-t-lg" style="height: 45%"></div>
                    <div class="w-full bg-indigo-500 rounded-t-lg" style="height: 75%"></div>
                    <div class="w-full bg-indigo-600 rounded-t-lg" style="height: 95%"></div>
                    <div class="w-full bg-indigo-400 rounded-t-lg" style="height: 60%"></div>
                    <div class="w-full bg-indigo-200 rounded-t-lg" style="height: 40%"></div>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Weekly Activity Trend</h3>
                <p class="text-gray-500 text-sm">Engagement is currently up <span
                        class="text-green-600 font-bold">+15.4%</span> this week.</p>
            </div>

        </div>
    </div>
@endsection
