<!-- drawer component -->
<div id="drawer-right-example-{{ $post->id }}"
    class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full w-96 bg-white"
    tabindex="-1" aria-labelledby="drawer-right-label" style="margin-top: 0">
    <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500"><svg
            class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>Edit Post</h5>
    <button type="button" data-drawer-hide="drawer-right-example-{{ $post->id }}"
        aria-controls="drawer-right-example-{{ $post->id }}"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center ">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <form class="mb-6" action="{{ route('post.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-6">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
            <input type="text" id="title" name="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  block w-full p-2.5 @error('title') border-red-300 text-red-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 @enderror"
                placeholder="Post title" value="{{ $post->title }}" />

            @error('title')
                <p class="text-red">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
            <textarea id="description" name="description" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('description') text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 @enderror"
                placeholder="Write description...">{{ $post->description }}</textarea>

            @error('description')
                <p class="text-red">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="album" class="block mb-2 text-sm font-medium text-gray-900">Choose Albums</label>
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
        <button type="submit"
            class="text-white justify-center flex items-center bg-red-700 hover:bg-red-800 w-full focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Update</button>
    </form>

</div>
