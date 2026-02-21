@props([
    'padding' => 'p-6',
    'rounded' => 'rounded-xl',
    'shadow' => 'shadow-lg',
    'background' => 'bg-white'
])

<div {{ $attributes->merge(['class' => "{$background} {$padding} {$rounded} {$shadow}"]) }}>
    {{ $slot }}
</div>