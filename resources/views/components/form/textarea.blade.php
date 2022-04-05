@props(['name', 'value' => ''])
<textarea name="{{$name}}" value="{{$value}}" {{ $attributes(['class' => 'w-full focus:outline-none text-sm rounded-xl border-gray-400 focus:ring-1'])}}>{{$slot}}</textarea>
