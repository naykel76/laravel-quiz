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

    public function mount()
    {
        $this->testing();
    }

    /**
     * This function loads testing data and can be removed
     */
    public function testing()
    {
        $this->showModal = true;
        $this->editing = self::$model::find(2);
    }

    public function render()
    {
        return view('livewire.create-edit-quiz');
    }
}
