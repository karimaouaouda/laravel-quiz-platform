<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - Welcome</title>
    <meta name="description" content="Lovable Generated Project" />
    <meta name="author" content="Lovable" />

    <meta property="og:title" content="Quiz" />
    <meta property="og:description" content="Quiz is a platform for creating and taking quizzes" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://img.icons8.com/ios-filled/50/000000/quiz.png" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@Quiz" />
    <meta name="twitter:image" content="https://img.icons8.com/ios-filled/50/000000/quiz.png" />
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="flex items-center justify-between px-8 py-4 bg-white shadow-sm">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('logo.png') }}" alt="Quiz Logo" class="h-12 w-12">
            <span class="text-blue-500 font-bold text-xl">Quiz</span>
        </div>
        <nav class="flex items-center space-x-6">
            <a href="#" class="text-gray-600 hover:text-blue-500">Help</a>
            <a href="{{route('quizzes')}}" class="text-gray-600 hover:text-blue-500">Browse Quizzes</a>
            <a href="#" class="text-gray-600 hover:text-blue-500">About</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="w-full mx-auto mt-16 flex flex-col items-center justify-between gap-10 px-4">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Welcome to the Quiz Generator</h1>
        <p class="text-gray-500 mb-8">Create, share and take quizzes with ease</p>

        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-10 px-4">
            <!-- Left: Text and Cards -->
            <div class="flex-1 flex flex-col items-start">

                <div class="flex w-full flex-col md:flex-row gap-6 mb-6">
                    <!-- Student Card -->
                    <a href="{{route('filament.student.pages.dashboard')}}"
                        class="bg-white rounded-xl shadow p-6 flex-1 min-w-[220px] flex flex-col items-center hover:bg-sky-600 hover:!text-white ease-in-out duration-300 group">
                        <div class="text-blue-500 group-hover:text-white mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="font-semibold text-lg mb-1">Student</div>
                        <div class="text-gray-500 text-sm text-center group-hover:text-white">Join and answer quizzes</div>
                    </a>
                    <!-- Teacher Card -->
                    <a href="{{route('filament.teacher.pages.dashboard')}}" class="bg-white rounded-xl shadow p-6 flex-1 min-w-[220px] flex flex-col items-center hover:bg-sky-600 hover:!text-white ease-in-out duration-300 group">
                        <div class="text-blue-500 group-hover:text-white mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none" />
                            </svg>
                        </div>
                        <div class="font-semibold text-lg mb-1">Teacher</div>
                        <div class="text-gray-500 text-sm text-center group-hover:text-white">Create and manage quizzes</div>
                    </a>
                </div>
                <a href="#" class="block w-full  text-center border border-blue-400 text-blue-500 rounded-md px-6 py-2 font-medium hover:bg-blue-50 transition">Create New Account</a>
            </div>
            <!-- Right: Illustration -->
            <div class="flex justify-center w-2/5">
                <img loading="lazy" src="{{ asset('/images/landing-pic3.webp') }}">
            </div>
        </div>
    </main>

    <!-- About Us Section -->
    <section class="max-w-6xl mx-auto mt-20 px-4">
        <div class="bg-slate-50 rounded-2xl shadow-md p-8 flex flex-col items-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">About Us</h2>
            <p class="text-gray-500 text-center max-w-2xl">Quiz is dedicated to making learning interactive and fun. Our platform empowers students and teachers to create, share, and participate in quizzes, fostering collaboration and knowledge sharing in a modern, user-friendly environment.</p>
        </div>
    </section>

    <!-- Services Section -->
    <section class="max-w-6xl mx-auto mt-16 px-4">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">Our Services</h2>
        <div class="flex flex-col md:flex-row gap-8 justify-center">
            <!-- Share Quizzes -->
            <div class="flex-1 bg-white rounded-xl shadow p-6 flex flex-col items-center">
                <div class="text-blue-500 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A2 2 0 0020 6.382V5a2 2 0 00-2-2H6a2 2 0 00-2 2v1.382a2 2 0 00.447 1.342L9 10m6 0v10m0 0H9m6 0a2 2 0 002-2v-8a2 2 0 00-2-2H9a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="font-semibold text-lg mb-1">Share Quizzes</div>
                <div class="text-gray-500 text-center">Easily create and share quizzes with your peers or students.</div>
            </div>
            <!-- Pass Quizzes -->
            <div class="flex-1 bg-white rounded-xl shadow p-6 flex flex-col items-center">
                <div class="text-blue-500 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="font-semibold text-lg mb-1">Pass Quizzes</div>
                <div class="text-gray-500 text-center">Take quizzes, test your knowledge, and track your progress.</div>
            </div>
            <!-- Collaboration -->
            <div class="flex-1 bg-white rounded-xl shadow p-6 flex flex-col items-center">
                <div class="text-blue-500 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-4a4 4 0 10-8 0 4 4 0 008 0zm6 4v2a4 4 0 01-3 3.87M3 16v2a4 4 0 003 3.87" />
                    </svg>
                </div>
                <div class="font-semibold text-lg mb-1">Collaboration</div>
                <div class="text-gray-500 text-center">Work together on quizzes and share results for better learning.</div>
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="max-w-6xl mx-auto mt-16 px-4 mb-20">
        <div class="bg-white rounded-2xl shadow p-8 flex flex-col md:flex-row gap-10 items-center">
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Contact Us</h2>
                <p class="text-gray-500 mb-4">Have questions or feedback? Reach out to us!</p>
                <form class="space-y-4">
                    <div>
                        <input type="text" placeholder="Your Name" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    </div>
                    <div>
                        <input type="email" placeholder="Your Email" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    </div>
                    <div>
                        <textarea placeholder="Your Message" rows="3" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-600 transition">Send Message</button>
                </form>
            </div>
            <div class="flex-1 flex flex-col items-center md:items-start">
                <div class="flex items-center space-x-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 01-8 0 4 4 0 018 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7m0 0H9m3 0h3" />
                    </svg>
                    <span class="text-gray-700">support@Quiz.com</span>
                </div>
                <div class="flex items-center space-x-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="text-gray-700">123 Learning Ave, Edutown</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-white border-t border-gray-200 py-6 mt-8">
        <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center space-x-2 mb-4 md:mb-0">
                <img src="{{ asset('logo.png') }}" alt="Quiz Logo" class="h-12 w-12">
                <span class="text-blue-500 font-bold text-lg">Quiz</span>
            </div>
            <div class="flex space-x-6 mb-4 md:mb-0">
                <a href="#" class="text-gray-600 hover:text-blue-500">Home</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">About</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">Services</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">Contact</a>
            </div>
            <div class="text-gray-400 text-sm">&copy; 2024 Quiz. All rights reserved.</div>
        </div>
    </footer>
</body>

</html>
