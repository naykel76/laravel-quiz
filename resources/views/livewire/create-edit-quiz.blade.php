<div>

    <div class="bx">

        <form wire:submit.prevent="save">

            <x-gt-input wire:model.defer="editing.title" for="editing.title" label="Quiz Title" />
            <x-gt-input wire:model.defer="editing.sort_order" for="editing.sort_order" label="Order" />

            <div class="tar">
                <x-gt-button-save wire:model.prevent="save" />
            </div>

        </form>

        <div class="bx-title">Quiz Questions</div>

        @if(isset($editing->id))
            <livewire:create-question-answers :quiz-id="$editing->id" />
        @else
            <div class="bx warning-light">You must save the quiz before you can add the questions.</div>
        @endif

    </div>

    <div class="bx light pxy-05 txt-sm">
        <strong>Show Modal:</strong> {{ $showModal ? 'True' : 'False' }} &nbsp;
        <strong>Editing Object:</strong> {{ $editing ?? 'Not Available' }} &nbsp;
    </div>

</div>
