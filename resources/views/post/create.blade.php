<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create') }}
            </h2>

            <button form="create" type="submit"
                class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Publish</button>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data" id="create">
                @csrf
                <div class="flex items-start space-x-6">
                    <div class="w-2/3 relative border-2 border-gray-300 border-dashed rounded-lg p-6 @error('image') border-red-300 @enderror"
                        id="dropzone">
                        <input type="file" id="file-upload" name="image"
                            class="absolute inset-0 w-full h-full opacity-0 z-50" />
                        <div class="text-center">
                            <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg"
                                alt="">

                            <h3 class="mt-2 text-sm font-medium text-gray-900">
                                <label for="file-upload" class="relative cursor-pointer">
                                    <span>Drag and drop</span>
                                    <span class="text-red-600"> or browse</span>
                                    <span>to upload</span>
                                </label>
                            </h3>
                            <p class="mt-1 text-xs text-gray-500">
                                PNG, JPG, GIF up to 10MB
                            </p>
                        </div>

                        <img src="" class="mt-4 mx-auto max-h-60 hidden" id="preview">

                        @error('image')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-2/3 flex-col space-y-4">
                        <div class="mb-5">
                            <label for="title-input"
                                class="block mb-2 text-sm font-medium text-gray-900 @error('title') text-red-500 @enderror">Title</label>
                            <input type="text" id="title-input" name="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('title') border border-red-300 text-red-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 dark:border-red-600 dark:placeholder-red-400  dark:focus:ring-red-500 dark:focus:border-red-500 @enderror">

                            @error('title')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="description-input"
                                class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                            <input type="text" id="description-input" name="description"
                                class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</x-app-layout>


<script>
    document.getElementById('file-upload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
        }
    });
</script>
