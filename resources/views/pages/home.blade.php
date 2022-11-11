<x-gotime-app-layout layout="{{ config('naykel.template') }}" hasContainer class="py-5-3-2">

    <h1>{{ $title ?? null }}</h1>

    <div class="bx bdr-blue">
        <h2>Quiz Questions</h2>

        <p class="lead">Display a list of questions filtered by the selected question ID</p>

        {{-- how to pass in quizId? --}}
        <livewire:quiz-questions />

    </div>

    <hr>

    <div class="bx bdr-blue">
        <h2>Quiz Table</h2>
        <p class="lead">The <code>quiz-table</code> is a stand alone component used to display all the queried items from the database. There is no CRUD logic directly created in this component, all crud functions such as edit, create, and delete are events emitted to the <code>quiz-question</code> component. This table could optionallly include the <code>withDataTable</code> trait giving it access to search and sort functionality.</p>
        <livewire:quiz-table />
    </div>

</x-gotime-app-layout>
