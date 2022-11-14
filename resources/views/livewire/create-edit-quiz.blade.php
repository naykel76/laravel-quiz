<div>

    @if($showModal)

        <div class="bx">

            <form wire:submit.prevent="save">

                <x-gt-input wire:model.defer="editing.title" for="editing.title" label="Quiz Title" />

                <div class="tar">
                    <x-gt-button-save wire:model.prevent="save" />
                </div>

            </form>

            {{-- quiz questions --}}
            @if(isset($editing->id))
                {{-- force the child component to mount each time the parent changes to make sure questions update --}}
                <livewire:create-question-answers key="{{ Str::random() }}" :quiz-id="$editing->id" />
            @else
                <div class="bx warning-light">You must save the quiz before you can add the questions.</div>
            @endif

        </div>

    @endif

</div>
