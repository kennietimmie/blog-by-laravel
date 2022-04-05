<x-guest-layout>
    @include('posts.header')
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
      @if ($posts->count())
        <x-post-featured-card :post="$posts->first()" />
        <x-post-grid :posts="$posts->skip(1)"/>
        {{$posts->links()}}
      @else
        <pre>No posts</pre>
      @endif
      {{-- <div class="lg:grid lg:grid-cols-3">
        <x-post-card />
        <x-post-card />
        <x-post-card />
      </div> --}}
    </main>
</x-guest-layout>