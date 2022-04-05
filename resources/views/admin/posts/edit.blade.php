<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard > Post > ' . $post->title) }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <x-auth-validation-errors class="mb-4" :errors="$errors" />
      <form method="POST" action="{{route('admin.posts.update', ['post' => $post->id])}}" class="space-y-3" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div>
          <x-form.label for="title" :value="__('Post Title')" />
          <x-form.input id="title" class="block mt-1 w-full text-sm" type="text" name="title" :value="old('title', $post->title)" placeholder="Post title" required
            autofocus />
        </div>
        <div>
          <x-form.label for="slug" :value="__('Post Slug')" />
          <x-form.input id="slug" class="block mt-1 w-full text-sm" type="text" name="slug" :value="old('slug', $post->slug)" placeholder="URL friendly" required
            autofocus />
        </div>
        <div>
          <x-form.label for="excerpt" :value="__('Post Excerpt')" />
          <x-form.input id="excerpt" class="block mt-1 w-full" type="text" name="excerpt" :value="old('excerpt', $post->excerpt)" placeholder="Quick description, short and simple" required
            autofocus />
        </div>
        <div>
          <x-form.label for="categories" :value="__('Post categories')" />
          <select id="categories" class="mt-1 w-full text-sm" name="categories[]" :value="old('categories')" multiple autofocus>
            <option value="">--Please choose an option--</option>
            @foreach (( \App\Models\Category::latest()->get()) as $category)
              <option value="{{$category->id}}" {{in_array($category->id, old('categories', $post->categories->pluck('id')->toArray())) ? 'selected' : ''}}>{{$category->name}}</option>
            @endforeach
          </select>
        </div>
         <div>
          <x-form.label for="thumbnail" :value="__('Post Thumbnail')" />
          <x-form.input id="thumbnail" class="block mt-1 w-full" type="file" accept="image/*" name="thumbnail" placeholder="Select file"
            autofocus />
        </div>
        <div class="mt-4">
          <x-form.label for="content" :value="__('content')" />
           <x-form.textarea :name="'content'" :value="old('content', $post->content)" id="content" placeholder="What is on your mind?" id="content" cols="10" rows="5" required>{{old('content', $post->content)}}</x-form.textarea>

        </div>
        <x-form.button class="ml-3">
          {{ __('Update') }}
        </x-form.button>
      </form>
    </div>
    <script>
      $('[name="slug"]').change((event) => {
        event.target.value = event.target.value.trim().toLowerCase().replace(" ", "-")
      })
    </script>
  </div>
</x-app-layout>
