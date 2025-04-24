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
        <span class="font-bold">Question</span>: {{ $quiz->questions()->first()->text }}
    </div>

    <div class="flex flex-col mt-5 p-4 bg-white rounded-md border border-gray-300">
        <div class="flex items-center gap-2">
            <input type="radio" name="answer" id="answer1" value="1" class="w-5 h-5 text-sky-500 border-gray-300 focus:ring-sky-500 rounded-md">
            <label for="answer1" class="text-lg text-gray-700">Answer 1</label>
        </div>
        <div class="flex items-center gap-2 mt-2">
            <input type="radio" name="answer" id="answer2" value="2" class="w-5 h-5 text-sky-500 border-gray-300 focus:ring-sky-500 rounded-md">
            <label for="answer2" class="text-lg text-gray-700">Answer 2</label>
        </div>
        <div class="flex items-center gap-2 mt-2">
            <input type="radio" name="answer" id="answer3" value="3" class="w-5 h-5 text-sky-500 border-gray-300 focus:ring-sky-500 rounded-md">
            <label for="answer3" class="text-lg text-gray-700">Answer 3</label>
        </div>
        <div class="flex items-center gap-2 mt-2">
            <input type="radio" name="answer" id="answer4" value="4" class="w-5 h-5 text-sky-500 border-gray-300 focus:ring-sky-500 rounded-md">
            <label for="answer4" class="text-lg text-gray-700">Answer 4</label>
        </div>
    </div>
    <div class="flex justify-between items-center mt-5">
        <button class="px-4 py-2 bg-sky-500 text-white rounded-md hover:bg-sky-600 duration-300 ease-in-out">
            Next Question
        </button>
        <span class="text-gray-500">Question 1 of 10</span>
        <button class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 duration-300 ease-in-out">
            End Quiz
        </button>
    </div>
</div>