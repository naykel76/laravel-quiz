<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

# Laravel and Livewire Quiz Application



## Quiz Table Component

The quiz-table is a stand alone component used to display quizzes from the database. There is no CRUD logic directly acciosated with this component, and all actions such as edit, create, and delete are events emitted to the create-edit-quiz component. This table could optionallly include the withDataTable trait giving it access to search and sort functionality.




## Data Structures

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
