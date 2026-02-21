@props([
    'variant' => 'primary', // primary, secondary, outline, ghost
    'size' => 'md',         // sm, md, lg
    'href' => null,
    'disabled' => false
])

@php
    $baseClasses = 'inline-flex items-center justify-center rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none';

    $variantClasses = match($variant) {
        'primary' => 'bg-[#F5C400] text-[#0B2A4A] hover:bg-yellow-400 focus:ring-yellow-500',
        'secondary' => 'bg-[#0B2A4A] text-white hover:bg-navy-600 focus:ring-navy-500',
        'outline' => 'border border-[#0B2A4A] text-[#0B2A4A] hover:bg-[#0B2A4A] hover:text-white focus:ring-navy-500',
        'ghost' => 'text-[#0B2A4A] hover:bg-[#F5C400] hover:text-[#0B2A4A] focus:ring-navy-500',
        'gold' => 'bg-[#F5C400] text-[#0B2A4A] hover:bg-yellow-400 focus:ring-yellow-500',
        'navy' => 'bg-[#0B2A4A] text-white hover:bg-navy-600 focus:ring-navy-500',
        default => 'bg-[#F5C400] text-[#0B2A4A] hover:bg-yellow-400 focus:ring-yellow-500'
    };

    $sizeClasses = match($size) {
        'sm' => 'text-sm py-2 px-4',
        'lg' => 'text-lg py-3 px-6',
        default => 'text-base py-2.5 px-5'
    };

    $disabledClass = $disabled ? 'opacity-50 cursor-not-allowed' : '';
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "{$baseClasses} {$variantClasses} {$sizeClasses} {$disabledClass}"]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'button', 'class' => "{$baseClasses} {$variantClasses} {$sizeClasses} {$disabledClass}"]) }}>
        {{ $slot }}
    </button>
@endif