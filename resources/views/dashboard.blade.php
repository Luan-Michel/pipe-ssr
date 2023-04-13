<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-4">
                    <div class="grid grid-cols-6 gap-4">
                        <div class="text-left text-sm font-medium text-gray-500 uppercase tracking-wider col-span-3">{{ __("Title") }}</div>
                        <div class="text-left text-sm font-medium text-gray-500 uppercase tracking-wider">{{ __("Date") }}</div>
                        <div class="text-left text-sm font-medium text-gray-500 uppercase tracking-wider">{{ __("Status") }}</div>
                        <div class="text-left text-sm font-medium text-gray-500 uppercase tracking-wider">{{ __("Actions") }}</div>
                    </div>
                    @foreach ($projects as $project)
                        <div class="grid grid-cols-6 gap-4">
                            <div class="col-span-3">{{ $project->title }}</div>
                            <div class="">{{ date('Y-m-d', strtotime($project->created_at)) }}</div>
                            <div class="">{{ $project->status->description }}</div>
                            @if($project->status->id == 1)
                                <div class="">
                                    <a href="{{ route('projects.show', $project->id) }}" class="text-blue-500 hover:text-blue-700">{{ __("View") }}</a>
                                </div>
                            @else
                                <div class="">
                                    <a href="{{ route('projects.edit', $project->id) }}" class="text-blue-500 hover:text-blue-700">{{ __("Edit") }}</a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
