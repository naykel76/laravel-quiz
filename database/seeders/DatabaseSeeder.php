<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $quiz1 = \App\Models\Quiz::create(['title' => 'Quiz One']);
        $quiz2 = \App\Models\Quiz::create(['title' => 'Quiz Two']);

        \App\Models\Quiz::factory(3)->create();

        $quiz1->questions()->create(['id' => 72, 'question' => 'What is the colour of the ocean?'])
            ->answers()->createMany([
                ['answer_text' => 'Blue', 'is_correct' => 1],
                ['answer_text' => 'Yellow'],
                ['answer_text' => 'Pink'],
                ['answer_text' => 'Green'],
            ]);

        $quiz1->questions()->create(['question' => 'Is fire hot?'])
            ->answers()->createMany([
                ['answer_text' => 'Yes', 'is_correct' => 1],
                ['answer_text' => 'No'],
            ]);

        $quiz1->questions()->create(['question' => 'How many wheels does a car have?'])
            ->answers()->createMany([
                ['answer_text' => '4', 'is_correct' => 1],
                ['answer_text' => '128'],
                ['answer_text' => '16'],
                ['answer_text' => '2'],
            ]);

        $quiz1->questions()->create(['question' => '247 is greater than 987'])
            ->answers()->createMany([
                ['answer_text' => 'True'],
                ['answer_text' => 'False', 'is_correct' => 1],
            ]);

        $quiz2->questions()->create(['id' => 427, 'question' => 'What color is the sun?'])
            ->answers()->createMany([
                ['id' => 80, 'answer_text' => 'Blue'],
                ['answer_text' => 'Yellow', 'is_correct' => 1],
                ['answer_text' => 'Red'],
            ]);

        $quiz2->questions()->create(['question' => 'Capital of France?'])
            ->answers()->createMany([
                ['answer_text' => 'Toulouse'],
                ['answer_text' => 'Paris', 'is_correct' => 1],
                ['answer_text' => 'Lyon'],
            ]);

        $quiz2->questions()->create(['question' => 'NBA: A stands for...?'])
            ->answers()->createMany([
                ['answer_text' => 'Association', 'is_correct' => 1],
                ['answer_text' => 'America'],
                ['answer_text' => 'Act'],
            ]);
    }
}
