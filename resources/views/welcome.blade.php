<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    @livewireStyles
    <title>{{ config('app.name') }}</title>

</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

@livewireScripts

    <div class="flex flex-col items-center justify-center w-full max-w-2xl">
        <h1 class="text-4xl font-bold text-center mb-6">Welcome to {{ config('app.name') }}</h1>
        {{-- title that tell users to chose one of the cards --}}
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-4">Please choose your role to continue:</p>
        {{-- image of the app --}}

        
        {{-- two cards one for student and other to teacher each one has icon and title and description and hint each one redirect the user to login page --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
            <a 
                href="{{ route('filament.student.auth.login') }}" 
                class="bg-white dark:bg-[#1b1b18] shadow-md rounded-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition duration-300">
                <img src="{{ asset('images/student.jpeg') }}" alt="Student" class="w-16 h-16 mb-4">
                <h2 class="text-xl font-semibold mb-2">Student</h2>
                <p class="text-gray-600 dark:text-gray-400">Access your courses and track your progress.</p>
            </a>
            <a 
                href="{{ route('filament.teacher.auth.login') }}" 
                class="bg-white dark:bg-[#1b1b18] shadow-md rounded-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition duration-300">
                <img src="{{ asset('images/teacher.png') }}" alt="Teacher" class="w-16 h-16 mb-4">
                <h2 class="text-xl font-semibold mb-2">Teacher</h2>
                <p class="text-gray-600 dark:text-gray-400">Manage your courses and students.</p>
            </a>
        </div>
    </div>
</body>

</html>