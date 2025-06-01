{{-- page container with consistent design --}}
<div class="bg-gray-50 min-h-screen flex flex-col">
    {{-- Header/Navbar --}}
    <header class="flex items-center justify-between px-8 py-4 bg-white shadow-sm">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('logo.png') }}" alt="QuizGen Logo" class="h-12 w-12">
            <span class="text-blue-500 font-bold text-xl">QuizGen</span>
        </div>
        <nav class="flex items-center space-x-6">
            <a href="#" class="text-gray-600 hover:text-blue-500">Home</a>
            <a href="#" class="text-gray-600 hover:text-blue-500">About</a>
            <a href="#" class="text-gray-600 hover:text-blue-500">FAQ</a>
            <a href="#" class="text-gray-600 hover:text-blue-500">Contact</a>
            @guest
            <a href="{{ route('filament.student.auth.login') }}" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md font-semibold shadow hover:bg-blue-600 transition">Sign In</a>
            <a href="{{ route('filament.student.auth.register') }}" class="ml-2 px-4 py-2 border border-blue-400 text-blue-500 rounded-md font-medium hover:bg-blue-50 transition">Register</a>
            @endguest
            @auth
            <a href="{{ route('home') }}" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md font-semibold shadow hover:bg-blue-600 transition">Dashboard</a>
            @endauth
        </nav>
    </header>

    {{-- Search Bar --}}
    <div class="flex justify-center items-center mt-10 mb-6 px-4">
        <div class="w-full max-w-xl relative rounded-md overflow-hidden border bg-white shadow">
            <input
                wire:model.live.debounce.500ms="search"
                type="text"
                placeholder="Search for quizzes..."
                class="w-full px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-200 rounded-md">
            <button type="submit" class="absolute right-0 top-0 h-full px-4 text-blue-500">
                <i wire:loading.class="hidden" class="bi bi-search"></i>
                <i wire:loading wire:loading.class="animate-spin block" class="bi bi-arrow-clockwise"></i>
            </button>
        </div>
    </div>

    {{-- Main Content: Quiz Results --}}
    <main class="flex-1 max-w-6xl mx-auto w-full px-4">
        <div class="bg-white rounded-2xl shadow p-8 mt-4">
            <div class="flex items-center space-x-4 mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Results <span class="font-normal">({{ $count }})</span></h2>
                <i wire:loading wire:loading.class="animate-spin block" class="bi bi-arrow-clockwise"></i>
            </div>
            <div class="w-full flex flex-wrap gap-6 justify-center">
                @foreach($quizzes as $quiz)
                <div
                    class="relative group cursor-pointer bg-white rounded-xl shadow p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl max-w-xs w-full border border-transparent hover:border-blue-400">
                    <div class="relative z-10 flex flex-col justify-between h-full">
                        <div class="card-header flex justify-between items-center">
                        <h2 class="text-xl text-slate-800 group-hover:text-blue-500 font-bold transition-all duration-300">
                            {{ $quiz->title }}
                        </h2>
                        <span class="text-xs text-gray-500">
                            {{ $quiz->created_at->format('M d, Y') }}
                        </span>
                        </div>
                        <div class="pt-3 text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-gray-700">
                            <p class="max-h-24 line-clamp-3">
                                {{ $quiz->description }}
                            </p>
                        </div>

                        <div class="flex mt-4 flex-col space-y-2">
                            <div class="flex  space-x-1 items-center">
                                <i class="bi text-sm bi-person text-slate-800"></i>
                                <span class="text-xs text-slate-800">published by: {{ $quiz->teacher->name }}</span>
                            </div>
                            <div class="w-full flex flex-wrap gap-3">
                                <div class="flex space-x-1 items-center">
                                    <i class="bi text-sm bi-people text-slate-800"></i>
                                    <span class="text-xs text-slate-800">+{{ $quiz->submissions()->count() }} submissions</span>
                                </div>
                                <div class="flex space-x-1 items-center">
                                    <i class="bi text-sm bi-stopwatch text-slate-800"></i>
                                    <span class="text-xs text-slate-800"> {{ $quiz->questions()->sum('time_limit') }}s </span>
                                </div>
                                <div class="flex space-x-1 items-center">
                                    <i class="bi text-sm bi-list-ol text-slate-800"></i>
                                    <span class="text-xs text-slate-800">{{ $quiz->questions()->count() }} questions</span>
                                </div>
                            </div>
                            <div class="pt-2 text-base font-semibold leading-7">
                                <a href="{{ route('quizzes.pass', ['quiz' => $quiz->id]) }}" class="text-blue-500 hover:underline transition-all duration-300">Take the quiz &rarr;</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if(false)
            <p class="text-gray-600 text-center mt-8">No quizzes found.</p>
            @endif
        </div>
    </main>

    {{-- Loading spinner for infinite scroll --}}
    <div class="w-full py-2 text-center">
        <i class="bi bi-arrow-clockwise text-lg block" wire:loading.class="animate-spin" x-intersect="$wire.loadMore()"></i>
    </div>

    {{-- Footer Section --}}
    <footer class="bg-white border-t border-gray-200 py-6 mt-8">
        <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center space-x-2 mb-4 md:mb-0">
                <img src="{{ asset('logo.png') }}" alt="QuizGen Logo" class="h-12 w-12">
                <span class="text-blue-500 font-bold text-lg">QuizGen</span>
            </div>
            <div class="flex space-x-6 mb-4 md:mb-0">
                <a href="#" class="text-gray-600 hover:text-blue-500">Home</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">About</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">FAQ</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">Contact</a>
            </div>
            <div class="text-gray-400 text-sm">&copy; 2024 QuizGen. All rights reserved.</div>
        </div>
    </footer>
</div>
