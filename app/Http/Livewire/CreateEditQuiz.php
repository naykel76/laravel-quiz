<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Naykel\Gotime\Traits\WithCrud;

class CreateEditQuiz extends Component
{
    use WithCrud;

    private static $model = \App\Models\Quiz::class;
    public array $initialData = ['sort_order' => 0];
    public object $editing;
    public string $message = 'Quiz has been saved.';

    // listen for crud actions emitted from the quiz-table
    protected $listeners = ['edit', 'create', 'delete'];

    protected $rules = [
        'editing.title' => 'required',
        'editing.sort_order' => 'nullable|numeric'
    ];

    protected $messages = [
        'editing.title.required' => 'The quiz title is required.',
    ];

    /**
     * Validate and persist new quiz
     */
    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->dispatchBrowserEvent('notify', ($this->message ?? 'Saved!'));
        $this->emit('refreshComponent');
    }

    public function render()
    {
        return view('livewire.create-edit-quiz');
    }
}
