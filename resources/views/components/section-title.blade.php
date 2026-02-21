@props([
    'level' => 'h2',
    'size' => 'text-3xl', // text-xl, text-2xl, text-3xl, text-4xl
    'align' => 'text-left', // text-left, text-center, text-right
    'color' => 'text-gray-900'
])

<{!! $level !!} {{ $attributes->merge(['class' => "{$size} {$color} font-bold {$align}"]) }}>
    {{ $slot }}
</{!! $level !!}>