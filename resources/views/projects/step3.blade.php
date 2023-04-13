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
                        <div class="px-6 py-4 bg-white dark:bg-gray-700">
                            <div class="grid grid-cols-6 gap-4">
                                <div class="text-left text-sm font-medium text-gray-500 uppercase tracking-wider col-span-3">{{ __("Name") }}</div>
                                <div class="text-left text-sm font-medium text-gray-500 uppercase tracking-wider">{{ __("Description") }}</div>
                                <div class="text-left text-sm font-medium text-gray-500 uppercase tracking-wider">{{ __("Library Type") }}</div>
                                <div class="text-left text-sm font-medium text-gray-500 uppercase tracking-wider">{{ __("Files") }}</div>
                            </div>
                            {{-- @foreach ($projects as $project)
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
                            @endforeach --}}

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
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h3>
                <form class="space-y-6" action="#">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="flex justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                            </div>
                            <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500">Lost Password?</a>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        Not registered? <a href="#" class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 