@props(['disabled' => false, 'error' => []])
@php
$classes ='rounded-md shadow-sm border focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 ';
$classes .= count($error) > 0 ? 'border-red-300' : 'border-gray-400';
@endphp
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $classes]) !!}>

<div>
  @foreach ($error as $message)
    <div class="font-medium text-red-600 text-sm">
      {{ $message }}
    </div>
  @endforeach
</div>
