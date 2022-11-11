<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditCreateQuestion extends Component
{

    private static $model = \App\Models\Question::class;

    public $editing;
    public $quizId; // current

    public function edit($id)
    {
        dd($id);
    }

    // on edit, open the question list where id = ...
    public function render()
    {
        $query = self::$model::whereQuizId($this->quizId);

        return view('livewire.edit-create-question')->with([
            'questions' => $query,
        ]);
    }
}
