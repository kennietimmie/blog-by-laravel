@props(['trigger'])
<div x-data="{show: false}" @click.away="show=false" class="w-full">
  <div @click="show = !show">
    {{$trigger}}
  </div>
  <div x-show="show" class="absolute min-w-full py-2 bg-gray-100 rounded-xl mt-2 text-left z-50 max-h-52 overflow-auto"
    style="display: none">
    {{ $slot }}
  </div>
</div>
