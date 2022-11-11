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
            ->options()->createMany([
                ['option_text' => 'Blue', 'is_correct' => 1],
                ['option_text' => 'Yellow'],
                ['option_text' => 'Pink'],
                ['option_text' => 'Green'],
            ]);

        $quiz1->questions()->create(['question' => 'Is fire hot?'])
            ->options()->createMany([
                ['option_text' => 'Yes', 'is_correct' => 1],
                ['option_text' => 'No'],
            ]);

        $quiz1->questions()->create(['question' => 'How many wheels does a car have?'])
            ->options()->createMany([
                ['option_text' => '4', 'is_correct' => 1],
                ['option_text' => '128'],
                ['option_text' => '16'],
                ['option_text' => '2'],
            ]);

        $quiz1->questions()->create(['question' => '247 is greater than 987'])
            ->options()->createMany([
                ['option_text' => 'True'],
                ['option_text' => 'False', 'is_correct' => 1],
            ]);

        $quiz2->questions()->create(['id' => 427, 'question' => 'What color is the sun?'])
            ->options()->createMany([
                ['id' => 80, 'option_text' => 'Blue'],
                ['option_text' => 'Yellow', 'is_correct' => 1],
                ['option_text' => 'Red'],
            ]);

        $quiz2->questions()->create(['question' => 'Capital of France?'])
            ->options()->createMany([
                ['option_text' => 'Toulouse'],
                ['option_text' => 'Paris', 'is_correct' => 1],
                ['option_text' => 'Lyon'],
            ]);

        $quiz2->questions()->create(['question' => 'NBA: A stands for...?'])
            ->options()->createMany([
                ['option_text' => 'Association', 'is_correct' => 1],
                ['option_text' => 'America'],
                ['option_text' => 'Act'],
            ]);
    }
}
