<x-app-layout>
    <div>
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">

                @include('components.steps', ['step' => 2])

                <div class="flex flex-col lg:flex-row">
                    <div class="w-full lg:w-full bg-gray-100 dark:bg-gray-800">
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ __("Project Information") }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ __("Fill in the information below to create a new project.") }}</p>
                        </div>
                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            <div class="px-6 py-4 bg-gray-200 dark:bg-gray-700">
                               
                                <input type="hidden" name="id" value="{{ $id }}">
                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">fas, fasta, fa, fastq or fastq.gz</p>
                                        </div>
                                        <input id="dropzone-file" onchange="selectedFile(event)" type="file" class="hidden" multiple />
                                    </label>
                                </div> 

                                <div id="files" class="flex flex-col lg:flex-row">

                                </div>

                                <div class="pt-4 flex flex-col lg:flex-row items-end">
                                    <div>
                                        <a href="{{ route('projects.step3', $id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            {{ __('Next') }}
                                        </a>
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
    function dropHandler(ev) {
        console.log("File(s) dropped");

        // Prevent default behavior (Prevent file from being opened)
        ev.preventDefault();

        if (ev.dataTransfer.items) {
            // Use DataTransferItemList interface to access the file(s)
            [...ev.dataTransfer.items].forEach((item, i) => {
                // If dropped items aren't files, reject them
                if (item.kind === "file") {
                    const file = item.getAsFile();
                    uploadFile(file);
                }
            });
        } else {
            // Use DataTransfer interface to access the file(s)
            [...ev.dataTransfer.files].forEach((file, i) => {
                uploadFile(file);
            });
        }
    }

    function dragOverHandler(ev) {
        console.log("File(s) in drop zone");

        // Prevent default behavior (Prevent file from being opened)
        ev.preventDefault();
    }

    function selectedFile(event){
        [...event.target.files].forEach((file, i) => {
            uploadFile(file);
        });
    }

    function uploadFile(file){
        console.log(file);
        // return;
        var token = document.getElementsByName('_token')[0].value;
        var chunkSize = 1024 * 1024; // 1 MB
        var offset = 0;
        var index = 1;
    
        while (offset < file.size) {
            var chunk = file.slice(offset, offset + chunkSize);
            offset += chunkSize;
            
            var formData = new FormData();
            formData.append('file', chunk, file.name);
            formData.append('index', index);
            formData.append('final', offset >= file.size);
            formData.append('_token', token);
    
            // Use AJAX para enviar o chunk para o servidor
            var xhr = new XMLHttpRequest();
            xhr.open('POST', "{{ route('projects.uploadFile', array('id' => $id)) }}", false);
            xhr.send(formData);
    
            index++;
        }
    }

</script>