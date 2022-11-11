<div>

    <div class="my">
        <button wire:click.prevent="" class="btn primary">
            <x-iconit.plus-round class="icon" /> <span>Add Quiz</span></button>
    </div>

    <div class="bx">

        @forelse($items as $quiz)

            <div class="flex space-between py-025 bdr-b">
                <div>{{ $quiz->title }}</div>
                <div>
                    <button wire:click.prevent="" class="btn sm success">edit</button>
                    <button wire:click.prevent="" class="btn sm danger">delete</button>
                </div>
            </div>

        @empty

            <p class="bx warning-light">Theare a no quizzes available.</p>

        @endforelse

    </div>

</div>
