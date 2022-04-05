@props(['posts'])
<div class="lg:grid lg:grid-cols-6">
  @unless(!$posts->count() > 0)
    @foreach ($posts as $post)
      <x-post-card :post="$post"
        class="{{ $loop->iteration < 3
            ? // $loop->last && $loop->even ||
            // $loop->count - $loop->iteration == 1 && $loop->odd ||
            // ($loop->last && $loop->even) ||
            // ($loop->count - $loop->iteration === 3 && $loop->odd) ||
            // ($loop->count - $loop->iteration === 2 && $loop->even)
            'col-span-3'
            : 'col-span-2' }}" />
    @endforeach
  @endunless
</div>
