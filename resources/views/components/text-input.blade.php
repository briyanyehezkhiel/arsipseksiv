@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'text-black bg-white border-black focus:border-black focus:ring-black rounded-md shadow-sm']) }}>
