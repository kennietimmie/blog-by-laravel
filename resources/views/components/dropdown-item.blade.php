@props(['active' => false])
@php
  $classes='block rounded-xl py-2 pl-3 text-sm font-semibold hover:bg-blue-300 focus:bg-blue-300 ';
  if($active) $classes .= is_bool($active) ?'bg-blue-300': $active;
 @endphp
<a {{ $attributes([
  'class' => $classes
  ])}}>{{$slot}}</a>