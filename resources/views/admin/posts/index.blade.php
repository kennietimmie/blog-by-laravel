<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard > Post > All') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg space-y-4">
        {{ $posts->links() }}
        <table class="w-full text-sm text-left text-gray-900 dark:text-gray-400 rounded-xl">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">
                Author
              </th>
              <th scope="col" class="px-6 py-3">
                Title
              </th>
              <th scope="col" class="px-6 py-3">
                Comments
              </th>
              <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
              <tr
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                  {{ $post->author->username }}
                </th>
                <td class="px-6 py-4">
                  <a href="{{route('posts.single', ['post' => $post->slug])}}">
                    {{ $post->title }}
                  </a>
                </td>
                <td class="px-6 py-4">
                  {{ $post->comments->count() }}
                </td>
                <td class="px-6 py-4 flex justify-between text-right">
                  <a href="javascript:void"
                  class="font-medium text-red-600 dark:text-red-500 hover:underline"
                  x-data="{}"
                  @click.preventDefault="document.querySelector('#delete-post').submit()">Delete</a>
                  <form id="delete-post" method="post" action="{{route('admin.posts.delete', ['post' => $post->id])}}" class="hidden">
                    @csrf
                    @method('delete')
                  </form>
                  <a href="{{route('admin.posts.edit', ['post' => $post->id])}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $posts->links() }}
      </div>
    </div>
  </div>
</x-app-layout>
