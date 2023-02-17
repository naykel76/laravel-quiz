<div>

    <div class="mb">
        <x-gt-button-create wire:click.prevent="$emitTo('create-edit-quiz', 'create')" text="Add Quiz" />
    </div>

    <div class="bx">

        @forelse($items as $quiz)

            <div class="flex space-between py-025 my-05 bdr-b">

                <div>{{ $quiz->title }}</div>

                <div>
                    <button wire:click.prevent="$emitTo('create-edit-quiz', 'edit', {{ $quiz->id }})" class="btn sm success">edit</button>
                    <button wire:click.prevent="$emitTo('create-edit-quiz', 'delete', {{ $quiz->id }})" class="btn sm danger">delete</button>
                </div>

            </div>

        @empty

            <p class="bx warning-light">Theare a no quizzes available.</p>

        @endforelse

    </div>

</div>
