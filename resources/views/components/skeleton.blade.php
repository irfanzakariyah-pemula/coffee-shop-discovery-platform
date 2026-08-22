@props(['type' => 'card'])

@if($type === 'card')
    <div class="bg-white rounded-lg shadow overflow-hidden animate-pulse">
        <div class="h-48 bg-gray-300"></div>
        <div class="p-4 space-y-3">
            <div class="h-4 bg-gray-300 rounded w-3/4"></div>
            <div class="h-3 bg-gray-300 rounded w-1/2"></div>
            <div class="h-3 bg-gray-300 rounded w-2/3"></div>
        </div>
    </div>
@elseif($type === 'list')
    <div class="bg-white rounded-lg shadow p-4 animate-pulse">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
            <div class="flex-1 space-y-2">
                <div class="h-4 bg-gray-300 rounded w-3/4"></div>
                <div class="h-3 bg-gray-300 rounded w-1/2"></div>
            </div>
        </div>
    </div>
@elseif($type === 'text')
    <div class="animate-pulse space-y-2">
        <div class="h-4 bg-gray-300 rounded w-full"></div>
        <div class="h-4 bg-gray-300 rounded w-5/6"></div>
        <div class="h-4 bg-gray-300 rounded w-4/6"></div>
    </div>
@endif

<style>
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
