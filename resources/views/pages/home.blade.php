<x-gotime-app-layout layout="{{ config('naykel.template') }}" hasContainer class="py-5-3-2">

    <h1>{{ $title ?? null }}</h1>

    <h2>Quiz Table</h2>
    <p class="lead">The <code>quiz-table</code> is a stand alone component used to display quizzes from the database. There is no CRUD logic directly associated with this component, and all actions such as edit, create, and delete are events emitted to the <code>create-edit-quiz</code> component. This table could optionally include the <code>withDataTable</code> trait providing access to search and sort functionality.</p>
    <livewire:quiz-table />

    <h2>Create/Edit Quiz</h2>
    <p class="lead">The <code>create-edit-quiz</code> component displays provides the CRUD logic to to add or edit the a quiz.</p>
    <p>This component typically appears when the 'add', or 'edit' button is pressed and then redirects to a designated route or opens the component in a modal.</p>
    <livewire:create-edit-quiz />

</x-gotime-app-layout>
