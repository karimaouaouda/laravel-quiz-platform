<div class="w-screen h-screen flex items-center justify-center">
    <div class="flex flex-col gap-4">
        <h1 class="text-2xl font-bold text-center">Join Quiz</h1>
        <p class="text-center">Enter the code provided by your teacher to join the quiz.</p>
        <div class="flex items-center flex-col  gap-4">
            <x-input wire:model.live.debounce.250ms="code" placeholder="Enter quiz code" />
            @if (!empty($error))
            <div class="text-red-500 text-sm text-center">
                {{ $error }}
            </div>
            @endif
            <x-button :disabled="!empty($error)" wire:click="checkCode" text="Join">Join the quiz</x-button>
        </div>

    </div>
</div>