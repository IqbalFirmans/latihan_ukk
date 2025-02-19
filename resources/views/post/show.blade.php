<x-app-layout>

    <div class="py-0">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center space-x-1">
                <div class="grid place-items-start relative top-8 me-2">
                    <a class="items-center text-lg font-medium text-center text-black" href="javascript:history.back()">
                        <svg class="w-8 h-8 text-gray-800 dark:text-black" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M5 12h14M5 12l4-4m-4 4 4 4" />
                        </svg>
                    </a>
                </div>
                <div class="relative flex flex-col md:flex-row w-full max-w-4xl my-6 bg-white shadow-sm border border-slate-200 rounded-lg min-h-96 max-h-dvh">
                    <div class="relative md:w-1/2 shrink-0 overflow-hidden">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                            class="h-full w-full rounded-s-lg object-cover" />
                    </div>


                    <div class="p-6 pt-2 w-full">
                        <button
                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-full hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                            type="button">
                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="3"
                                    d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                            </svg>
                        </button>
                        
                        <div class="inline-flex relative right-1 mb-4 items-center text-lg align-middle font-medium text-center text-gray-900">
                            12 K
                        </div>

                        <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="dropdownDotsHorizontal"
                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-full hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 focus:text-white focus:bg-gray-900"
                            type="button">
                            <svg class="w-6 h-6  focus:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="4" d="M6 12h.01m6 0h.01m5.99 0h.01"/>
                              </svg>
                              
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdownDotsHorizontal"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                            <ul class="py-2 text-sm text-gray-700"
                                aria-labelledby="dropdownMenuIconHorizontalButton">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100">Earnings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100">Earnings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100">Earnings</a>
                                </li>
                            </ul>
                        </div>


                        <h4 class="mb-2 text-slate-800 text-xl font-semibold">
                            {{ $post->title }}
                        </h4>
                        <p class="mb-8 text-slate-600 leading-normal font-light">
                            {{ $post->description }}
                        </p>
                        <button onclick="toggleComments()"
                            class="text-slate-800 font-semibold text-sm hover:underline mb-3 flex items-center">
                            Show Comments!
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>

                        
                        <div id="commentSection"
                            class="hidden border-t border-slate-300 max-h-64 text-base overflow-y-auto">
                            <livewire:comments :model="$post" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="columns-1 gap-4 space-y-4 p-4 sm:columns-2 md:columns-3 lg:columns-4">
                @forelse ($posts as $post)
                    <div class="group relative cursor-pointer rounded-lg">
                        <a href="{{ route('post.show', $post->id) }}" class="block">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                class="rounded-lg" />
                            <div class="absolute inset-0 opacity-0 transition duration-300 group-hover:opacity-100">
                                <div class="pointer-events-none absolute rounded-lg inset-0 bg-black opacity-30"></div>
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
                                <button
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
                                        <li>
                                            <a class="block px-4 py-2 hover:bg-gray-100" type="button"
                                                data-drawer-target="drawer-right-example-{{ $post->id }}"
                                                data-drawer-show="drawer-right-example-{{ $post->id }}" data-drawer-placement="right"
                                                aria-controls="drawer-right-example-{{ $post->id }}">
                                                Edit
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="py-2">
                                        <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="block px-4 w-full py-2 text-sm text-gray-700 hover:bg-gray-100">Delete</button>
                                        </form>
                                    </div>
                                </div>
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
    <script>
        function toggleComments() {
            const commentSection = document.getElementById('commentSection');
            if (commentSection.classList.contains('hidden')) {
                commentSection.classList.remove('hidden');
            } else {
                commentSection.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>
