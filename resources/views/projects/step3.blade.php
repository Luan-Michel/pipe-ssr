<x-app-layout>
    <div>
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                @include('components.steps', ['step' => 3])

                <div class="flex flex-col lg:flex-row">
                    <div class="w-full lg:w-full bg-gray-100 dark:bg-gray-800">
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ __("Samples") }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ __("Describe your samples.") }}</p>
                        </div>
                        <div class="px-6 py-4 bg-white dark:bg-gray-700">
                            <div class="flex flex-col lg:flex-row">
                                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    {{ __('Add New Sample') }}
                                </button>
                            </div>
                        </div>
                        <div id="samples" class="px-6 py-4 bg-white dark:bg-gray-700">
                            <div class="grid grid-cols-6 gap-4">
                                <div class="text-left text-sm font-medium text-gray-500 uppercase tracking-wider col-span-2">{{ __("Name") }}</div>
                                <div class="text-left text-sm font-medium text-gray-500 uppercase tracking-wider col-span-2">{{ __("Description") }}</div>
                                <div class="text-left text-sm font-medium text-gray-500 uppercase tracking-wider">{{ __("Library Type") }}</div>
                                <div class="text-left text-sm font-medium text-gray-500 uppercase tracking-wider">{{ __("Files") }}</div>
                                {{-- <div class="text-left text-sm font-medium text-gray-500 uppercase tracking-wider">{{ __("Edit") }}</div> --}}
                            </div>
                            @foreach ($samples as $sample)
                                <div class="grid grid-cols-6 gap-4">
                                    <div class="col-span-2">{{ $sample->name }}</div>
                                    <div class="col-span-2">{{ $sample->description }}</div>
                                    <div class="">{{ $sample->library_type->description }}</div>
                                    <div class="">
                                        @foreach ($sample->files as $file)
                                            {{$file->name}} <br> 
                                        @endforeach
                                    </div>
                                    {{-- <div class="">
                                        <a href="{{ route('projects.show', $project->id) }}" class="text-blue-500 hover:text-blue-700">{{ __("View") }}</a>
                                    </div> --}}
                                </div>
                            @endforeach

                        </div>
                        <div class="px-6 py-4 bg-white dark:bg-gray-700">
                            <div class="flex flex-col lg:flex-row">
                                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<!-- Main modal -->
<div id="authentication-modal" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">{{ __("Add your samples") }}</h3>
                <form id="form" class="space-y-6" action="#">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $id }}">
                    <div class="flex flex-col lg:flex-row">
                        <div class="lg:w-1/2">
                            <div class="w-full">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div class="w-full">
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                            <div class="w-full">
                                <x-input-label for="library_type_id" :value="__('Library Type')" />
                                <select name="library_type_id" id="library_type_id" class="block p-2 mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="" disabled selected>{{ __("Select Library Type") }}</option>
                                    @foreach($library_types as $library_type)
                                        <option value="{{ $library_type->id }}">{{$library_type->description}}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('library_type_id')" class="mt-2" />
                            </div>
                        </div>
                        <div class="lg:w-1/2 rounded-lg border border-gray-500 m-2 p-2">
                            <h4 class="text-1xl font-bold mb-2 ml-2">Files</h4>
                            @foreach ($files as $file)
                                <div class="w-full">
                                    <div class="flex items-center mt-2 ml-2">
                                        <input type="checkbox" class="form-checkbox" data-name="{{$file->name}}" name="file[]" value="{{$file->id}}">
                                        <span class="text-sm ml-2">{{$file->name}}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __("Add") }}</button>
                </form>
            </div>
        </div>
    </div>
</div> 

<script type="text/javascript">
    var form = document.getElementById('form');   

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var xhr = new XMLHttpRequest();
        var url = "{{route('projects.insertSample')}}";
        var async = true; // Define se a requisição será assíncrona ou não

        xhr.open('POST', url, async);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Função a ser executada quando a requisição estiver concluída com sucesso
                addToList();
            }
        };

        var formData = new FormData(form);
        xhr.send(formData);
    });

    const addToList = () => {
        let sample = {
            name: document.getElementById('name').value,
            description: document.getElementById('description').value,
            library_type: document.getElementById('library_type_id').selectedOptions[0].text,
            files: Array.from(document.getElementsByName('file[]')).map(function (el) {
                return el.dataset.name;
            }),
        }

        let element = '<div class="g    rid grid-cols-6 gap-4"> \
            <div class="col-span-2">'+sample.name+'</div> \
            <div class="col-span-2">'+sample.description+'</div> \
            <div class="">'+sample.library_type+'</div> \
            <div class="">'+sample.files.join(' - ')+'</div> \
        </div>';

        document.getElementById('samples').innerHTML += element;
    }

    const getSamples = () => {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', "{{route('projects.getSamples', $id)}}", true); // Substitua 'URL_DO_BACKEND' pela URL correta do seu backend

        xhr.onload = function() {
        if (xhr.status === 200) {
            var jsonResponse = JSON.parse(xhr.responseText);
            // Faça algo com o JSON retornado, por exemplo:
            console.log(jsonResponse);
        }
        };

        xhr.send();
    }

</script>