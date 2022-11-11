<?php

namespace App\Http\Livewire;

use App\Rules\HasTwo;
use Livewire\Component;
use Naykel\Gotime\Traits\WithCrud;


class QuizQuestions extends Component
{
    use WithCrud;

    private static $model = \App\Models\Question::class;
    public $initialData = ['sort_order' => 0];
    public $quizId; // parentId passed in with component

    public $editing; // this is the question
    public $answers = []; // answers options

    // the setQuizId listeners is only required because the quizId is not
    // being passed in the conventual way.
    public $listeners = ['setQuizId', 'refreshComponent'];

    protected function rules()
    {
        return [
            'editing.quiz_id' => 'required|numeric',
            'editing.question' => 'required',
            'editing.sort_order' => 'numeric',
            'answers' => [
                'required', 'array',
                function ($attribute, $value, $fail) {
                    if (count($value) < 2) {
                        $fail('The must be at least two answer options, please add another.');
                    }
                },
            ],
            'answers.*.answer_text' => 'required:max:255',
            // 'editing.answer.*.is_correct' => 'numeric',
        ];
    }

    protected $messages = [
        'editing.question.required' => 'The question field is required.',
        'answers.required' => 'Please add at least two answer options.',
        'answers.*.answer_text.required' => 'Question answers cannot be empty.',
    ];

    public function mount()
    {

        $this->quizId = 1;
        $this->initialData['quiz_id'] = $this->quizId;
        $this->answers = [[], []]; // create two blank answers

        // THIS SECTION ONLY NEEDED FOR TESTING
        // $this->mountTesting();
    }

    public function save()
    {
        // returns an array with 'editing' and 'answers'
        $validated = $this->validate();
        // creates the question from 'editing' in the array
        $question = self::$model::create($validated['editing']);
        // creates the answers from 'answers' in the array
        $question->answers()->createMany($validated['answers']);
        $this->showModal = false;
    }

    public function setQuizId($id)
    {
        $this->quizId = $id;
    }

    public function refreshComponent()
    {
        // $this->editing = null;
    }

    /**
     * Add row for new answer_text option
     * @return void
     */
    public function addEmptyRow()
    {
        $this->answers[] = '';
    }

    // should I make this delete as well???
    public function removeOption($index)
    {
        unset($this->answers[$index]);
        $this->answers = array_values($this->answers);
    }

    public function render()
    {

        $query = self::$model::whereQuizId($this->quizId)->get();

        return view('livewire.quiz-questions')->with([
            'questions' => $query,
        ]);
    }

    public function mountTesting()
    {
        $this->initialData['question'] = 'Test Question';
        $this->initialData['sort_order'] = 5;

        $this->answers = [
            [
                'answer_text' => 'This is the answer text',
                'sort_order' => 0,
                'is_correct' => 0,
                'question_id' => 72
            ],
            [
                'answer_text' => 'This is another answer',
                'sort_order' => 0,
                'is_correct' => 0,
                'question_id' => 72
            ],
        ];

        $this->editing = $this->makeBlankModel();
    }
}
