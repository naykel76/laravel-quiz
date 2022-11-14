<div class="bx">

    <div class="bx-header blue3 flex va-c">
        <div class="bx-title mr-2">Quiz Questions</div>
        <x-gt-button-add wire:click.prevent="create" button-text="Add Question" />
    </div>

    {{-- display a list of available questions --}}
    @forelse($questions as $question)

        <div class="flex space-between py-025 my-05 bdr-b">

            <div class="flex">
                <div>{{ $question->question }}</div>
            </div>

            <div class="mxy-0">
                <button wire:click.prevent="edit({{ $question->id }})" class="btn sm success">edit</button>
                <button wire:click.prevent="delete({{ $question->id }})" class="btn sm danger">delete</button>
            </div>

        </div>

    @empty

        <p class="bx warning-light fw7">There are no questions available for this quiz.</p>

    @endforelse

    {{-- create question and answer options --}}
    <x-gt-modal wire:model="showModal">

        <div class="bx-title"> {{ isset($editing->id) ? 'Edit' : 'Create' }} Question and Answers</div>

        <form wire:submit.prevent>

            <x-gt-input wire:model.lazy="editing.question" for="editing.question" label="Question" inline />

            <hr>

            <div class="my">

                <div class="bx-title">Answer Options</div>

                @forelse($answers as $index => $answer)
                    <div class="flex gg">
                        <x-gt-input wire:model.lazy="answers.{{ $index }}.answer_text"
                            for="answers.{{ $index }}.answer_text" rowClass="fg1" />
                        <button wire:click.prevent="removeOption({{ $index }})" class="btn sm danger">Remove</button>
                    </div>
                @empty
                    There are no answer options!
                @endforelse

            </div>

        </form>

        @error('answers')
            <div class="bx danger">
                {{ $message }}
            </div>
        @enderror

        <div class="bx-footer flex space-between">

            <x-gt-button-add wire:click.prevent="addEmptyRow" button-text="Add Option" />
            <x-gt-button-save wire:click.prevent="save" button-text="Save All" />

        </div>

    </x-gt-modal>

</div>
