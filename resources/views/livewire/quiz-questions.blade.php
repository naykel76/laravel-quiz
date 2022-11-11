<div>

    <x-gotime-errors />

    <div class="bx">

        <div class="mb">
            <x-gt-button-add wire:click.prevent="create" button-text="Add Question" />
        </div>

        @forelse($questions as $question)

            <div class="flex space-between bdr-b ">
                <div class="flex">
                    <div class="mr-2">{{ $question->sort_order }}</div>
                    <div class="">{{ $question->question }}</div>
                </div>
                <div class="mxy-0">
                    {{-- <button wire:click.prevent="$emitTo('quiz-questions', 'edit', {{ $quiz->id }})" class="btn sm success">edit</button> --}}
                    <button wire:click.prevent="delete({{ $question->id }})" class="btn sm danger">delete</button>
                </div>
            </div>

        @empty

            <p class="fw7">There are no questions available for this quiz.</p>

        @endforelse

    </div>

    {{-- <x-gt-modal wire:model="showModal"> --}}

        <form wire:submit.prevent>

            <x-gt-input wire:model.defer="editing.question" for="editing.question" label="Question" inline />

            <x-gt-input wire:model.defer="editing.sort_order" for="editing.sort_order" label="Order" inline
                helpText='Leave order blank to auto-assign to the end or leave value at 0 to add to the beginning.' />

            <hr>

            <div class="my">

                <div class="bx-title">Answer Options</div>

                @forelse($answers as $index => $answer)
                    <div class="flex gg">
                        <x-gt-input wire:model.defer="answers.{{ $index }}.answer_text"
                            for="answers.{{ $index }}.answer_text" rowClass="fg1" />
                        <button wire:click.prevent="removeOption({{ $index }})" class="btn danger">Delete</button>
                    </div>
                @empty
                    There are no answer options!
                @endforelse

            </div>

        </form>

        <div class="bx-footer flex space-between">

            <x-gt-button-add wire:click.prevent="addEmptyRow" button-text="Add Option" />
            <x-gt-button-save wire:click.prevent="save" button-text="Save All" />

        </div>

    {{-- </x-gt-modal> --}}

</div>
