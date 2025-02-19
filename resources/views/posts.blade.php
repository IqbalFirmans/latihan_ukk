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

</x-app-layout>
