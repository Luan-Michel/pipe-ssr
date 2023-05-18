<!-- show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-bold">Description:</h3>
                    <p>{{ $project->description }}</p>

                    <h3 class="font-bold mt-4">Organism:</h3>
                    <p>{{ $project->organism->name }}</p>

                    <h3 class="font-bold mt-4">Genome:</h3>
                    <p>{{ $project->genome->name }}</p>

                    <h3 class="font-bold mt-4">Samples:</h3>
                    <ul class="list-disc ml-6">
                        @foreach ($project->samples as $sample)
                            <li>
                                <h4 class="font-bold">{{ $sample->name }}</h4>
                                <p>{{ $sample->description }}</p>
                                <p>Library Type: {{ $sample->library_type->description }}</p>
                                <ul class="list-disc ml-6">
                                    @foreach ($sample->files as $file)
                                        <li>{{ $file->name }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
