<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Saved ideas!') }}
        </h2>


        <div class="flex justify-between">
            <div class="mt-5 border-b border-gray-200">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
                    data-tabs-toggle="#default-styled-tab-content"
                    data-tabs-active-classes="text-red-600 hover:text-red-600 dark:text-red-500 dark:hover:text-red-500 border-red-600 dark:border-red-500"
                    data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:hover:text-gray-300"
                    role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="post-styled-tab"
                            data-tabs-target="#styled-post" type="button" role="tab" aria-controls="post"
                            aria-selected="false">Posts</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="album-styled-tab" data-tabs-target="#styled-album" type="button" role="tab"
                            aria-controls="album" aria-selected="false">Album</button>
                    </li>
                </ul>
            </div>



            <div class="relative top-8 right-10">
                <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="dropdownDotsHorizontal"
                    class="inline-flex items-center p-3 text-sm font-medium text-center text-gray-900 bg-white rounded-full hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                    type="button">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M5 12h14m-7 7V5" />
                    </svg>

                </button>
            </div>

            <!-- Dropdown menu -->
            <div id="dropdownDotsHorizontal"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownMenuIconHorizontalButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Post</a>
                    </li>
                    <li>
                        <a data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                            class="block px-4 py-2 hover:bg-gray-100">Album</a>
                    </li>
                </ul>
            </div>

        </div>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="default-styled-tab-content">
                <div class="p-4 rounded-lg" id="styled-post" role="tabpanel" aria-labelledby="post-tab">
                    <div class="columns-1 gap-4 space-y-4 p-4 sm:columns-2 md:columns-3 lg:columns-4">
                        @forelse ($posts as $post)
                            <div class="group relative cursor-pointer rounded-lg">
                                <a href="{{ route('post.show', $post->id) }}" class="block">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                        class="rounded-lg" />
                                    <div
                                        class="absolute inset-0 opacity-0 transition duration-300 group-hover:opacity-100">
                                        <div
                                            class="pointer-events-none absolute rounded-lg inset-0 bg-black opacity-40">
                                        </div>
                                        <div class="absolute inset-0 flex flex-col p-8">
                                            <div
                                                class="relative z-10 mt-auto break-words text-lg font-semibold text-white">
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
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
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
                                                        data-drawer-show="drawer-right-example-{{ $post->id }}"
                                                        data-drawer-placement="right"
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
                <div class="hidden p-4 " id="styled-album" role="tabpanel" aria-labelledby="album-tab">


                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @forelse ($albums as $album)
                            @php
                                $latestPost = $album->posts->sortByDesc('created_at')->first();
                                $posts = $album->posts->sortByDesc('created_at')->skip(1)->take(2);
                            @endphp
                            <a href="{{ route('albums.show', $album->name) }}" class="block">
                                <div class="card max-w-24 sm:max-w-sm rounded-lg bg-gray-50">
                                    @if ($album->posts->count() == 0)
                                        <figure>
                                            <img src="{{ asset('default.jpg') }}"
                                                alt="overlay image" class="rounded-lg max-w-96 object-cover" />
                                        </figure>
                                    @else
                                        <figure class="grid grid-cols-2 gap-2 h-48 p-2">

                                            <img src="{{ asset($latestPost ? asset('storage/' . $latestPost->image) : '') }}"
                                                class="row-span-2 h-full w-full object-cover rounded-lg"
                                                alt="Image 1">

                                            @foreach ($posts as $post)
                                                <img src="{{ asset('storage/' . $post->image) }}"
                                                    class="h-24 w-full object-cover rounded-lg"
                                                    alt="{{ $post->title }}">
                                            @endforeach
                                        </figure>
                                    @endif
                                    <div class="card-body p-4">
                                        <h1 class="font-bold text-lg">{{ $album->name }}</h1>
                                        <p class="text-gray-700 text-sm">{{ $album->posts->count() }} post |
                                            {{ $album->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <h2>No albums</h2>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>





    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Create New Album
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('albums.store') }}" method="POST">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Type album name">
                        </div>
                        <div class="col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Album
                                Description</label>
                            <textarea id="description" rows="4" name="description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Write album description here"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Add new album
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
