@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-[#1c92d2] focus:ring-[#1c92d2] rounded-md shadow-sm']) !!}>
