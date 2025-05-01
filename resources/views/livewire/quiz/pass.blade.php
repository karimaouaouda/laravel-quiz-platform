<div class="w-full flex flex-col py-4 px-10 bg-slate-100 min-h-screen">
    <div class="header w-full flex justify-between items-center">
        <h1 class="text-2xl font-bold text-slate-800 tracking-wide capitalize">
            #{{ $quiz->id }}: {{ $this->quiz->title }}
        </h1>

        <a href="#" class="font-semibold text-sky-500 hover:text-sky-600 duration-300 ease-in-out">
            cancel quiz
        </a>
    </div>

    <div class="w-full p-5 rounded-md border border-gray-300 mt-10 text-xl text-gray-700 bg-white">
        <span class="font-bold">Question</span>: {!! $question->text !!}
    </div>

    <div class="flex flex-col mt-5 p-4 bg-white rounded-md border border-gray-300">
        @foreach($question->choices as $choice)
        <div class="flex items-center gap-2">
            <input wire:model="answer" value="{{ $choice->id }}" type="radio" name="answer" id="answer1" class="w-5 h-5 text-sky-500 border-gray-300 focus:ring-sky-500 rounded-md">
            <label for="answer1" class="text-lg text-gray-700">
                {{ $choice->text }}
            </label>
        </div>
        @endforeach
    </div>
    <div class="flex justify-between items-center mt-5">
        <div class="flex items-center gap-2">
            <x-button wire:click="validateAnswer" text="Join">
                validate
            </x-button>
            <x-button wire:click="nextQuestion" text="Join">
                next question
            </x-button>
        </div>

        <span class="text-gray-500">Question 1 of 10</span>

        <x-button
            wire:click="cancelQuiz" text="Join">
            cancel quiz
        </x-button>
    </div>
</div>