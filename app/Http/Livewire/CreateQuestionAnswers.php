<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use Livewire\Component;
use Naykel\Gotime\Traits\WithCrud;

class CreateQuestionAnswers extends Component
{
    use WithCrud;

    private static $model = \App\Models\Question::class;
    public array $initialData = ['sort_order' => 0];
    public int $quizId; // passed in with component
    public string $message = 'Question Saved!';

    public object $editing; // this is the question
    public array $answers = []; // answers options

    protected $listeners = ['refreshComponent' => '$refresh'];

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
            // 'answers.points' => [
            //     function ($attribute, $value, $fail) {
            //         if (count($value) < 2) {
            //             $fail('The must be at least two answer options, please add another.');
            //         }
            //     },
            // ],
        ];
    }

    // For testing, mount a question
    protected $messages = [
        'editing.question.required' => 'The question field is required.',
        'answers.required' => 'Please add at least two answer options.',
        'answers.*.answer_text.required' => 'Question answers cannot be empty.',
    ];


    public function updating()
    {
        $this->resetErrorBag();
    }

    // redefine to to include resetting the answers array
    public function create(): void
    {
        $this->answers = [[], []]; // create two blank answers
        $this->initialData['quiz_id'] = $this->quizId;
        $this->editing = $this->makeBlankModel();
        $this->showModal = true;
    }

    /**
     * Edit the selected model
     */
    public function edit($id): void
    {
        $this->editing = self::$model::find($id);
        $this->answers = \App\Models\Answer::whereQuestionId($id)->get()->toArray();
        $this->showModal = true;
    }


    public function save()
    {

        $this->validate();
        $this->editing->save();
        // NK::TD!! check there is at least one correct answer

        $this->handleAnswers();
        $this->dispatchBrowserEvent('notify', ($this->message ?? 'Saved!'));
        $this->showModal = false;
        $this->emit('refreshComponent'); // refresh any component listening
    }

    /**
     * Persist or update answer options
     * @return void
     */
    public function handleAnswers(): void
    {
        // this is not the most elegant way to manage the answers. if the
        // answer is an existing record it will fire the update regardless
        foreach ($this->answers as $answer) {
            // if there is an answer id then existing record, else new?
            isset($answer['id'])
                ? Answer::find($answer['id'])->update($answer)
                : $this->editing->answers()->create($answer);;
        }
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

        return view('livewire.create-question-answers')->with([
            'questions' => $query,
        ]);
    }
}
