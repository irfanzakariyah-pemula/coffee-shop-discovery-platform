@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'loading' => false,
    'icon' => null
])

@php
$baseClasses = 'inline-flex items-center justify-center font-semibold rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 btn-ripple disabled:opacity-50 disabled:cursor-not-allowed';

$variantClasses = match($variant) {
    'primary' => 'bg-coffee-600 text-white hover:bg-coffee-700 focus:ring-coffee-500',
    'secondary' => 'bg-gray-200 text-gray-900 hover:bg-gray-300 focus:ring-gray-500',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
    'success' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500',
    'outline' => 'border-2 border-coffee-600 text-coffee-600 hover:bg-coffee-50 focus:ring-coffee-500',
    default => 'bg-coffee-600 text-white hover:bg-coffee-700 focus:ring-coffee-500'
};

$sizeClasses = match($size) {
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2 text-base',
    'lg' => 'px-6 py-3 text-lg',
    default => 'px-4 py-2 text-base'
};

$classes = $baseClasses . ' ' . $variantClasses . ' ' . $sizeClasses;
@endphp

<button 
    type="{{ $type }}"
    {{ $attributes->merge(['class' => $classes]) }}
    @if($loading) disabled @endif
>
    @if($loading)
        <div class="spinner mr-2"></div>
    @elseif($icon)
        <span class="mr-2">{{ $icon }}</span>
    @endif
    
    {{ $slot }}
</button>
