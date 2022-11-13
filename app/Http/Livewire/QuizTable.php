<?php

namespace App\Http\Livewire;

use Livewire\Component;

class QuizTable extends Component
{
    private static $model = \App\Models\Quiz::class;

    private $view = 'livewire.quiz-table';

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {

        $query = self::$model::all();

        return view($this->view)->with([
            'items' => $query,
        ]);
    }
}
