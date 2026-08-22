@props(['name', 'title' => '', 'show' => false])

<div x-data="{ show: @js($show) }"
     x-show="show"
     @open-modal.window="if($event.detail === '{{ $name }}') show = true"
     @close-modal.window="if($event.detail === '{{ $name }}') show = false"
     @keydown.escape.window="show = false"
     style="display: none;"
     class="fixed inset-0 z-50 overflow-y-auto"
     x-cloak>
    
    <!-- Backdrop -->
    <div x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-50"
         @click="show = false"></div>

    <!-- Modal -->
    <div class="flex items-center justify-center min-h-screen px-4">
        <div x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-90"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-90"
             class="relative bg-white rounded-lg shadow-xl max-w-lg w-full">
            
            <!-- Header -->
            @if($title)
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-900">{{ $title }}</h3>
                    <button @click="show = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Content -->
            <div class="px-6 py-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

<script>
window.openModal = (name) => {
    window.dispatchEvent(new CustomEvent('open-modal', { detail: name }));
}

window.closeModal = (name) => {
    window.dispatchEvent(new CustomEvent('close-modal', { detail: name }));
}
</script>
