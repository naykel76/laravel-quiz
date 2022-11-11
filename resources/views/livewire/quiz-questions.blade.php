<div>

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

    {{-- @if(!$showModal) --}}
    <div class="bx">
        <form wire:submit.prevent>

            <x-gt-input wire:model.defer="editing.question" for="editing.question" label="Question" inline />

            <x-gt-input wire:model.defer="editing.sort_order" for="editing.sort_order" label="Order" inline
                helpText='Leave order blank to auto-assign to the end or leave value at 0 to add to the beginning.' />

            <hr>

            <div class="my space-y-05">
                <div class="flex space-between mb">
                    <div class="bx-title">Answer Options</div>
                    {{-- each time this is clicked a new empty option is created --}}
                    <x-gt-button-add wire:click.prevent="addEmptyRow" button-text="Add Option" />
                </div>

                @forelse($options as $index => $answerOption)
                    <div class="flex gg">
                        <x-gt-input wire:model.defer="editing.option.{{ $index }}" for="editing.option.{{ $index }}" label="Answer Option {{ $index + 1 }}" inline rowClass="fg1" />
                        <button wire:click.prevent="removeOption({{ $index }})" class="btn danger">Delete</button>
                    </div>
                @empty
                    There are no answer options!
                @endforelse
            </div>

        </form>

        <div class="bx-footer tar">
            <x-gt-button-save wire:click.prevent="save" button-text="Save All" />
        </div>
    </div>
    {{-- @endif --}}

</div>
