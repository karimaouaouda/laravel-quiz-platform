{{-- page container without any padding or margin --}}
<div class="w-screen min-h-screen">
    {{-- navbar with brand, login/register button and some links (about us ...) --}}
    <nav class="bg-white dark:bg-[#1b1b18] shadow-md p-4 flex justify-between items-center z-90">
        <div class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 mr-2">
            <span class="text-xl font-bold text-[#1b1b18] dark:text-white">Quiz App</span>
        </div>
        {{-- tabs for (home, about us, faq, ...) --}}
        <div class="hidden md:flex space-x-4">
            <a href="#" class="text-[#1b1b18] dark:text-white hover:underline">Home</a>
            <a href="#" class="text-[#1b1b18] dark:text-white hover:underline">About Us</a>
            <a href="#" class="text-[#1b1b18] dark:text-white hover:underline">FAQ</a>
            <a href="#" class="text-[#1b1b18] dark:text-white hover:underline">Contact</a>
        </div>
        {{-- login and register buttons --}}
        @guest
        <div class="flex items-center">
            <a href="{{ route('filament.student.auth.login') }}" class="text-[#1b1b18] dark:text-white hover:underline mr-4">Login</a>
            <a href="{{ route('filament.student.auth.register') }}" class="bg-[#1b1b18] text-white px-4 py-2 rounded hover:bg-[#333]">Register</a>
        </div>
        @endguest

        {{-- show dashboard button that redirect the user to he's dashboard--}}
        @auth
        <div class="flex items-center">
            <a href="{{ route('home') }}" class="bg-[#1b1b18] text-white px-4 py-2 rounded hover:bg-[#333]">Dashboard</a>
        </div>
        @endauth
    </nav>

    {{-- search form with search button with icon --}}
    <div class="flex px-2 md:px-10 lg:px-20 justify-center items-center mt-6 relative z-10">
        <div class="w-full md:w-1/2 lg:w-1/3 relative rounded-md overflow-hidden border">
            <input
                wire:model.live.debounce.500ms="search"
                type="text"
                placeholder="Search for quizzes..."
                class="w-full px-4 py-2 focus:outline-none focus:ring-none">
            <button type="submit" class="absolute right-0 top-0 h-full px-4">
                <i wire:loading.class="hidden" class="bi bi-search"></i>
                <i wire:loading wire:loading.class="animate-spin block" class="bi bi-arrow-clockwise"></i>
            </button>
        </div>
    </div>

    {{-- div that have two sides one for filtering and one to show the search results --}}
    <div class="flex w-full z-10">

        {{-- search results section --}}
        <div class="w-full bg-white dark:bg-[#1b1b18] p-4 relative z-10">

            {{-- title that tell users to chose one of the cards --}}
            <div class="flex items-center space-x-4 mb-4">
                <h2 class="text-xl">Results : ({{ $count }})</h2>
                <i wire:loading wire:loading.class="animate-spin block" class="bi bi-arrow-clockwise"></i>
            </div>
            {{-- quiz cards --}}
            <div class="w-full flex flex-wrap gap-2 justify-center">
                @foreach($quizzes as $quiz)
                <div
                    class="relative hover:bg-sky-500 group cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto sm:max-w-sm sm:rounded-lg sm:px-10">
                    <div class="relative z-10 max-w-md">
                        <h2 class="text-3xl text-slate-800 group-hover:text-white font-bold transition-all duration-300">
                            {{ $quiz->title }}
                        </h2>
                        <div
                            class="space-y-6 pt-3 text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-white/90">
                            <p class="max-h-76 line-clamp-3">
                                {{ $quiz->description }}
                            </p>
                        </div>
                        <div class="w-full mt-2 flex justify-start space-x-3">
                            <div class="flex space-x-1 items-center">
                                <i class="bi text-sm bi-people text-slate-800  transition-all duration-300 group-hover:text-white/90"></i>
                                <span class="text-xs text-slate-800  transition-all duration-300 group-hover:text-white/90">+100 submissions</span>
                            </div>
                            <div class="flex space-x-1 items-center">
                                <i class="bi text-sm bi-stopwatch text-slate-800  transition-all duration-300 group-hover:text-white/90"></i>
                                <span class="text-xs text-slate-800  transition-all duration-300 group-hover:text-white/90">
                                    3.5h 4min
                                </span>
                            </div>
                            <div class="flex space-x-1 items-center">
                                <i class="bi text-sm bi-list-ol text-slate-800  transition-all duration-300 group-hover:text-white/90"></i>
                                <span class="text-xs text-slate-800  transition-all duration-300 group-hover:text-white/90">
                                    {{ $quiz->questions()->count() }} questions
                                </span>
                            </div>
                        </div>
                        <div class="pt-5 text-base font-semibold leading-7">
                            <p>
                                <a href="{{ route('quizzes.pass', ['quiz' => $quiz->id]) }}" class="text-sky-500 transition-all duration-300 group-hover:text-white">take the quiz
                                    &rarr;
                                </a>
                            </p>
                        </div>

                    </div>
                </div>
                <!-- https://play.tailwindcss.com/eCfibrSI2X -->
                @endforeach
            </div>
            {{-- if no quizzes found --}}
            @if(false)
            <p class="text-gray-600 dark:text-gray-400">No quizzes found.</p>
            @endif
        </div>
    </div>

    <div class="w-full py-2 text-center">
        <i class="bi bi-arrow-clockwise text-lg block" wire:loading.class="animate-spin" x-intersect="$wire.loadMore()"></i>
    </div>

</div>