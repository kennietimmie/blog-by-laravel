@props(['categories'])
<div class="space-x-2">
  @foreach ($categories as $category)
    <a href="{{ route('categories.single', ['category' => $category->slug]) }}"
      class="px-3 py-1 border {{ $loop->odd ? 'border-blue-300' : 'border-red-300' }} rounded-full {{ $loop->odd ? 'text-blue-300' : 'text-red-300' }}  text-xs uppercase font-semibold"
      style="font-size: 10px">{{ $category->name }}</a>
  @endforeach
</div>
