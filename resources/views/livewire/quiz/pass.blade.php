<div class="bg-gray-50 min-h-screen flex flex-col items-center py-10 px-2">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow p-8 flex flex-col">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <h1 class="text-2xl font-bold text-gray-800 tracking-wide capitalize">
                #{{ $quiz->id }}: {{ $this->quiz->title }}
            </h1>
            <div class="flex items-center gap-4">
                <div class="text-lg font-semibold text-red-500 bg-red-50 px-3 py-1 rounded">
                    Time Left: <span id="timer">{{ $timeLeft }}</span>s
                </div>
                <input type="hidden" id="timeLeftInput" name="timeLeft" value="{{ $timeLeft }}" />
            </div>
        </div>

        <div class="w-full p-5 rounded-xl border border-gray-200 mt-2 text-xl text-gray-700 bg-blue-50 mb-6">
            <span class="font-bold">Question</span>: {!! $question->text !!}
        </div>

        <div class="flex flex-col gap-3 bg-white rounded-xl border border-gray-200 p-4 mb-6">
            @switch($question->question_type->value)
                @case('multiple_choice')
                @foreach($question->choices as $choice)
                        <label class="flex items-center gap-3 cursor-pointer p-2 rounded hover:bg-blue-50 transition">
                            <input type="checkbox" wire:model="answers.{{$choice->id}}" class="w-5 h-5 text-blue-500 border-gray-300 focus:ring-blue-500 rounded-md">
                            <span class="text-lg text-gray-700">{{ $choice->text }}</span>
                        </label>
                @endforeach
                @break
                @default
                @foreach($question->choices as $choice)
                    <label class="flex items-center gap-3 cursor-pointer p-2 rounded hover:bg-blue-50 transition">
                        <input wire:model="answer" value="{{ $choice->id }}" type="radio" name="answer" class="w-5 h-5 text-blue-500 border-gray-300 focus:ring-blue-500 rounded-md">
                        <span class="text-lg text-gray-700">{{ $choice->text }}</span>
                    </label>
                @endforeach
            @endswitch

        </div>

        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mt-2">
            <div class="flex items-center gap-2 w-full md:w-auto">
                <x-button  wire:click="validateAnswer" class="bg-blue-500 text-white px-5 py-2 rounded-md font-semibold hover:bg-blue-600 transition">Validate</x-button>
                <x-button wire:click="nextQuestion" class="bg-gray-100 text-blue-500 px-5 py-2 rounded-md font-semibold hover:bg-blue-50 transition">Next Question</x-button>
            </div>
            <div class="text-gray-500 w-full text-center md:w-auto">Question {{ $currentQuestionNumber }} of {{ $totalQuestions }}</div>
            <x-button wire:click="cancelQuiz" class="bg-red-100 text-red-500 px-5 py-2 rounded-md font-semibold hover:bg-red-200 transition">Cancel Quiz</x-button>
        </div>
    </div>

    <footer class="w-full max-w-2xl mx-auto mt-10 bg-white border-t border-gray-200 py-4 rounded-b-2xl shadow flex flex-col md:flex-row items-center justify-between px-6">
        <div class="flex items-center space-x-2 mb-2 md:mb-0">
            <img src="{{ asset('logo.png') }}" alt="QuizGen Logo" class="h-12 w-12">
            <span class="text-blue-500 font-bold text-lg">QuizGen</span>
        </div>
        <div class="text-gray-400 text-sm">&copy; 2024 QuizGen. All rights reserved.</div>
    </footer>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var shouldAskBeforeLeave = true
        let timeLeft = parseInt(document.getElementById('timer').textContent);
        const timerDisplay = document.getElementById('timer');
        const timeLeftInput = document.getElementById('timeLeftInput');
        let timerInterval = setInterval(function () {
            if (timeLeft > 0) {
                timeLeft--;
                timerDisplay.textContent = timeLeft;
                timeLeftInput.value = timeLeft;
            } else {
                clearInterval(timerInterval);
                shouldAskBeforeLeave = false
                // Trigger Livewire method when time runs out
                Livewire.dispatch('timeExpired');
            }
        }, 1000);
        Livewire.on('validationError', function(params){
            let data = params[0]
            alert(data['message'])
        })
        function goodby(e){
            e.preventDefault()
            Livewire.dispatch('cancelQuiz')
            return "sorry"
        }

        Livewire.on('reloadEvent', function(){
            window.location.reload()
        })
        //window.onbeforeunload = goodby
    });
</script>
