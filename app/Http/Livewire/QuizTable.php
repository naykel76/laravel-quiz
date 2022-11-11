<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Quiz;

class QuizTable extends Component
{

    protected static $model = Quiz::class;

    public function render()
    {
        $query = self::$model::all();

        return view('livewire.quiz-table')->with([
            'items' => $query,
        ]);
    }
}
