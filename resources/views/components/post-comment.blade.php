@props(['comment' => []])
<x-panel class="bg-gray-50">
  <article class="flex  space-x-4">
    <div class="flex-shrink-0">
      <img src="https://i.pravatar.cc/60?u={{ $comment->author->username }}" class="rounded-xl" width="60"
        height="60" />
    </div>
    <div>
      <header class="mb-4">
        <h3>{{ $comment->author->name }}</h3>
        <p class="text-xs">Posted <time timestamp="48219939292">{{ $comment->created_at->diffForHumans() }}</time>
        </p>
      </header>
      <p>{{ $comment->content }}</p>
    </div>
  </article>
</x-panel>
