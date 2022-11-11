<div>

    <div class="my">
        <x-gt-button-add wire:click.prevent="" button-text="Add Quiz" />
    </div>

    <div class="bx">

        @forelse($items as $quiz)

            <div class="flex space-between py-025 bdr-b">
                <div>{{ $quiz->title }}</div>
                <div>
                    {{-- this edit function could go to a route --}}
                    {{-- in this case mou --}}
                    <button wire:click.prevent="$emitTo('quiz-questions', 'setQuizId', {{ $quiz->id }})" class="btn sm success">edit</button>
                    {{-- <button wire:click.prevent="$emitTo('edit-create-question', 'edit', {{ $quiz->id }})" class="btn sm success">edit</button> --}}
                    <button wire:click.prevent="" class="btn sm danger">delete</button>
                </div>
            </div>

        @empty

            <p class="bx warning-light">Theare a no quizzes available.</p>

        @endforelse

    </div>

</div>
