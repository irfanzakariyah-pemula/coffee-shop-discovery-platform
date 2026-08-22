@props([
    'type' => 'text',
    'name',
    'label' => null,
    'error' => null,
    'required' => false,
    'icon' => null
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-2">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        @if($icon)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                {!! $icon !!}
            </div>
        @endif

        <input 
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            {{ $attributes->merge([
                'class' => ($icon ? 'pl-10 ' : '') . 
                          'w-full px-4 py-2 border rounded-lg transition-all duration-200 ' .
                          'focus:ring-2 focus:ring-coffee-500 focus:border-coffee-500 ' .
                          ($error ? 'border-red-500 focus:ring-red-500' : 'border-gray-300')
            ]) }}
            @if($required) required @endif
        >

        @if($error)
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            </div>
        @endif
    </div>

    @if($error)
        <p class="mt-1 text-sm text-red-600 slide-up">{{ $error }}</p>
    @endif
</div>
