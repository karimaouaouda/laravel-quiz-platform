<div class="bg-gray-50 min-h-screen flex flex-col items-center justify-center py-10 px-2">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow p-8 flex flex-col items-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Quiz Result</h1>
        <!-- Example: Pass in $score and $message from Livewire -->
        @php
            // Example logic for demonstration
            $score = $score ?? 65; // Replace with actual score
            if ($score < 50) {
                $color = 'red';
                $message = 'Don\'t worry, keep practicing and you will improve!';
            } elseif ($score < 80) {
                $color = 'blue';
                $message = 'Good job! You\'re getting there.';
            } else {
                $color = 'green';
                $message = 'Excellent! You did great!';
            }
            $colorClasses = [
                'red' => 'bg-red-100 text-red-600 border-red-200',
                'blue' => 'bg-blue-100 text-blue-600 border-blue-200',
                'green' => 'bg-green-100 text-green-600 border-green-200',
            ];
        @endphp
        <div class="w-full flex flex-col items-center mb-6">
            <div class="text-5xl font-extrabold text-gray-800 mb-2">{{ $score }}%</div>
            <div class="w-full text-center border rounded-lg px-4 py-3 font-semibold text-lg mb-2 {{ $colorClasses[$color] }}">
                {{ $message }}
            </div>
        </div>
        <a href="{{ route('quizzes') }}" class="mt-4 px-6 py-2 bg-blue-500 text-white rounded-md font-semibold shadow hover:bg-blue-600 transition">Back to Quizzes</a>
    </div>
    <footer class="w-full max-w-lg mx-auto mt-10 bg-white border-t border-gray-200 py-4 rounded-b-2xl shadow flex flex-col md:flex-row items-center justify-between px-6">
        <div class="flex items-center space-x-2 mb-2 md:mb-0">
            <img src="{{ asset('logo.png') }}" alt="QuizGen Logo" class="h-6 w-6">
            <span class="text-blue-500 font-bold text-lg">QuizGen</span>
        </div>
        <div class="text-gray-400 text-sm">&copy; 2024 QuizGen. All rights reserved.</div>
    </footer>
</div>
