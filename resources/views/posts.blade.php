<x-app-layout>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="columns-1 gap-4 space-y-4 p-4 sm:columns-2 md:columns-3 lg:columns-4">
                @forelse ($posts as $post)
                    <div class="group relative cursor-pointer rounded-lg">
                        <a href="{{ route('post.show', $post->id) }}" class="block">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                class="rounded-lg" />
                            <div class="absolute inset-0 opacity-0 transition duration-300 group-hover:opacity-100">
                                <div class="pointer-events-none absolute rounded-lg inset-0 bg-black opacity-40"></div>
                                <div class="absolute inset-0 flex flex-col p-8">
                                    <div class="relative z-10 mt-auto break-words text-lg font-semibold text-white">
                                        {{ $post->title }}
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div
                            class="absolute inset-0 flex flex-col p-8 opacity-0 transition duration-300 group-hover:opacity-100 pointer-events-none">
                            <div class="flex justify-between">
                                <button data-modal-target="save-modal-{{ $post->id }}" data-modal-toggle="save-modal-{{ $post->id }}"
                                    class="mr-auto rounded-full bg-red-500 py-2 px-8 text-sm font-bold pointer-events-auto text-white">Save</button>

                                <button id="dropdownMenuIconHorizontalButton-{{ $post->id }}"
                                    data-dropdown-toggle="dropdownDotsHorizontal-{{ $post->id }}"
                                    class=" pointer-events-auto items-center p-1 text-sm font-medium text-center text-gray-900 bg-white rounded-full hover:bg-gray-100 focus:ring-4 focus:outline-none  focus:ring-gray-50"
                                    type="button">
                                    <svg class="w-8 h-8 text-gray-800" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="4"
                                            d="M6 12h.01m6 0h.01m5.99 0h.01" />
                                    </svg>
                                </button>

                                <div id="dropdownDotsHorizontal-{{ $post->id }}"
                                    class="z-50 hidden absolute  bottom-full right-0 pointer-events-auto bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                                    <ul class="py-2 text-sm text-gray-700"
                                        aria-labelledby="dropdownMenuIconHorizontalButton-{{ $post->id }}">
                                        <li>
                                            <a href="{{ asset('storage/' . $post->image) }}"
                                                download="{{ $post->title ?? rand(1000, 9999) }}.jpeg"
                                                class="block px-4 py-2 hover:bg-gray-100">Download</a>
                                        </li>
                                        @if ($post->user_id == auth()->user()->id)
                                            <li>
                                                <a class="block px-4 py-2 hover:bg-gray-100" type="button"
                                                    data-drawer-target="drawer-right-example-{{ $post->id }}"
                                                    data-drawer-show="drawer-right-example-{{ $post->id }}"
                                                    data-drawer-placement="right"
                                                    aria-controls="drawer-right-example-{{ $post->id }}">
                                                    Edit
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                    @if ($post->user_id == auth()->user()->id)
                                        <div class="py-2">
                                            <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="block px-4 w-full py-2 text-sm text-gray-700 hover:bg-gray-100">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main modal -->
    <div id="save-modal-{{ $post->id }}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Create New Product
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                        data-modal-toggle="save-modal-{{ $post->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('save') }}" method="POST">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2 ">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <label for="albums" class="block mb-2 text-sm font-medium text-gray-900">Choose Albums</label>
                            <select
                                class="js-example-basic-multiple bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="albums[]" multiple="multiple">
                                @forelse ($albums as $album)
                                    <option value="{{ $album->id }}"
                                        {{ in_array($album->id, $post->albums->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $album->name }}</option>
                                @empty
                                    <p>No albums</p>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
                    @include('components.drawer-edit')
                @empty
                    <h2>Not Found</h2>
                @endforelse
            </div>
        </div>
    </div>


</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Event listener untuk menampilkan modal
    document.querySelector("[data-modal-toggle='save-modal-{{ $post->id }}']").addEventListener("click", function () {
        setTimeout(function () {
            $('.js-example-basic-multiple').select2();
        }, 100); // Delay untuk memastikan modal telah muncul
    });
});

</script>