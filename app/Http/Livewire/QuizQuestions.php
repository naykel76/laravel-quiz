<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Naykel\Gotime\Traits\WithCrud;

class QuizQuestions extends Component
{
    use WithCrud;

    private static $model = \App\Models\Question::class;
    public $initialData = ['sort_order' => 0];
    public $quizId; // parentId passed in with component

    public $editing; // this is the question
    public $options = []; // answer options

    // this is only required because the component is not being called in a
    // way where I can pass in the id. Normally it would come from the url
    // public $listeners = ['setQuizId', 'refreshComponent' => '$refresh'];
    public $listeners = ['setQuizId', 'refreshComponent'];

    protected $rules = [
        'editing.quiz_id' => 'required|numeric',
        'editing.question' => 'required',
        'editing.sort_order' => 'numeric',
        // 'options' => ['required', 'array'],
        // 'options.*.option_text' => 'required:max:255',
        // 'options.*.is_correct' => 'numeric',
    ];

    protected $messages = [
        'editing.question.required' => 'The question field is required.',
    ];

    public function mount()
    {

        $this->quizId = 1;
        $this->initialData['quiz_id'] = $this->quizId;

        $this->editing = $this->makeBlankModel(); // ONLY NEEDED FOR TESTING
    }

    public function setQuizId($id)
    {
        $this->quizId = $id;
    }

    public function refreshComponent()
    {
        $this->editing = null;
    }
    /**
     * Add row for new answer option
     * @return void
     */
    public function addEmptyRow()
    {
        $this->options[] = '';
    }

    // should I make this delete as well???
    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function render()
    {

        $query = self::$model::whereQuizId($this->quizId)->get();

        return view('livewire.quiz-questions')->with([
            'questions' => $query,
        ]);
    }
}
