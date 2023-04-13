<x-app-layout>
    <h1>{{ __("Create Project") }}</h1>

    <div>
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">

                @include('components.steps', ['step' => 1])

                <div class="flex flex-col lg:flex-row">
                    <div class="w-full lg:w-full bg-gray-100 dark:bg-gray-800">
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ __("Project Information") }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ __("Fill in the information below to create a new project.") }}</p>
                        </div>
                        <form method="post" action="{{ route('projects.store') }}" class="mt-6 space-y-6">
                            @csrf
                            <div class="px-6 py-4 bg-gray-200 dark:bg-gray-700">
                                <div class="flex flex-col lg:flex-row">
                                    <div class="w-full lg:w-1/2">
                                        <x-input-label for="title" :value="__('Title')" />
                                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus autocomplete="title" />
                                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                    </div>
                                    <div class="w-full lg:w-1/2 lg:ml-6 mt-4 lg:mt-0">
                                        <x-input-label for="description" :value="__('Description')" />
                                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" required autofocus autocomplete="description" />
                                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                    </div>
                                </div>
                                <div class="flex flex-col lg:flex-row">
                                    <div class="w-full lg:w-1/2">
                                        <x-input-label for="organism" :value="__('Organism')" />
                                        <select name="organism" id="organism" class="block p-2 mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <option value="" disabled selected>{{ __("Select Organism") }}</option>
                                            @foreach($organisms as $organism)
                                                <option value="{{ $organism->id }}">{{$organism->name}}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('organism_id')" class="mt-2" />
                                    </div>
                                    <div class="w-full lg:w-1/2 lg:ml-6 mt-4 lg:mt-0">
                                        <x-input-label for="genome" :value="__('Genome Build')" />
                                        <select name="genome" id="genome" class="block p-2 mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <option value="" disabled selected>{{ __("Select Genome Build") }}</option>
                                            @foreach($genomes as $genome)
                                                <option value="{{ $genome->id }}">{{$genome->name}}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('genome_id')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="pt-4 flex flex-col lg:flex-row items-end">
                                    <div>
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            {{ __('Next') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
<script type="text/javascript">

    
</script>