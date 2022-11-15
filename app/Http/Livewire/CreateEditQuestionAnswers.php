<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use Livewire\Component;
use Naykel\Gotime\Traits\WithCrud;

class CreateEditQuestionAnswers extends Component
{
    use WithCrud;

    private static $model = \App\Models\Question::class;
    public array $initialData = ['sort_order' => 0];
    public int $quizId; // passed in with component
    public string $message = 'Question Saved!';

    public object $editing; // this is the question
    public array $answers = []; // answers options
    public array $removeAnswers = []; // answers to be deleted from database

    protected $listeners = ['refreshComponent' => '$refresh'];

    protected function rules()
    {
        return [
            'editing.quiz_id' => 'required|numeric',
            'editing.question' => 'required',
            'editing.sort_order' => 'numeric',
            'answers' => [
                'required', 'array',  function ($attribute, $value, $fail) {
                    if (count($value) < 2) {
                        $fail('The must be at least two answer options, please add another.');
                    }
                },
            ],
            'answers.*.answer_text' => 'required:max:255',
            'answers.*.is_correct' => ['sometimes', function ($attribute, $value, $fail) {
                $collection = collect($this->answers);
                $filtered = $collection->where('is_correct', true);
                if (count($filtered) <> 1) {
                    $fail('please select exactly 1 correct answer');
                }
            },],
        ];
    }

    protected $messages = [
        'editing.question.required' => 'The question field is required.',
        'answers.required' => 'Please add at least two answer options.',
        'answers.*.answer_text.required' => 'Question answers cannot be empty.',
    ];

    public function updating()
    {
        $this->resetErrorBag();
    }

    public function create(): void
    {
        $this->answers = [[], []]; // create two blank answers
        $this->initialData['quiz_id'] = $this->quizId;
        $this->editing = $this->makeBlankModel();
        $this->showModal = true;
    }

    public function edit($id): void
    {
        $this->editing = self::$model::find($id);
        $this->answers = \App\Models\Answer::whereQuestionId($id)->get()->toArray();
        $this->showModal = true;
    }


    public function save()
    {

        // $collection = collect($this->answers);
        // $filtered = $collection->where('is_correct', true);
        // if (count($filtered) <> 1) {
        //     dd('please select 1 correct answer');
        // }


        $this->validate();
        $this->editing->save();
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
        // not sure if this is the most elegant way to manage the answers but
        // it works. If the answer is an existing record it will update
        // regardless. Or in other words is may update un-necessarily because
        // there is not change.
        foreach ($this->answers as $answer) {
            isset($answer['id'])
                ? Answer::find($answer['id'])->update($answer) // existing record, UPDATE it
                : $this->editing->answers()->create($answer); // new record, CREATE it
        }

        // dd($this->removeAnswers);
        foreach ($this->removeAnswers as $id) {
            $answer = Answer::find($id);
            $answer ? $answer->delete() : null;
        }

        $this->reset('answers', 'removeAnswers');
    }

    /**
     * Add row for new answer_text option
     * @return void
     */
    public function addEmptyRow()
    {
        $this->answers[] = '';
    }

    /**
     * Remove answer from $answers array and delete from database on save
     */
    public function removeOption($index)
    {
        // If an id (not index) exists, then the answer comes from the
        // database. Answers are not deleted from the database until we click
        // the save button, so store them in an array until it's go time!
        isset($this->answers[$index]['id'])
            ? array_push($this->removeAnswers, $this->answers[$index]['id'])
            : null;

        // remove from array
        unset($this->answers[$index]);

        // $this->answers = array_values($this->answers);

    }

    public function render()
    {
        $query = self::$model::whereQuizId($this->quizId)->get();

        return view('livewire.create-edit-question-answers')->with([
            'questions' => $query,
        ]);
    }
}
