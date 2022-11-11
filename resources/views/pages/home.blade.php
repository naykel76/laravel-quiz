<x-gotime-app-layout layout="{{ config('naykel.template') }}" hasContainer class="py-5-3-2">

    <h1>{{ $title ?? null }}</h1>

    <h2>Quiz Table</h2>
        <p class="lead">The table component is used to display all the queried items from the database and does not have any logic for CRUD operations. The create, edit, and delete functions all emit events to other components.</p>
    <livewire:quiz-table />

</x-gotime-app-layout>
