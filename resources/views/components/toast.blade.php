<div x-data="toastManager()" 
     x-init="init()"
     @toast.window="show($event.detail)"
     class="fixed top-20 right-4 z-50 space-y-2">
    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.visible"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-x-8"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             :class="{
                 'bg-green-50 border-green-500 text-green-800': toast.type === 'success',
                 'bg-red-50 border-red-500 text-red-800': toast.type === 'error',
                 'bg-blue-50 border-blue-500 text-blue-800': toast.type === 'info',
                 'bg-yellow-50 border-yellow-500 text-yellow-800': toast.type === 'warning'
             }"
             class="flex items-center px-6 py-4 rounded-lg shadow-lg border-l-4 min-w-80 max-w-md">
            <div class="flex-1" x-text="toast.message"></div>
            <button @click="remove(toast.id)" class="ml-4 text-gray-500 hover:text-gray-700">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    </template>
</div>

<script>
function toastManager() {
    return {
        toasts: [],
        nextId: 1,

        init() {
            // Listen for Laravel flash messages
            @if(session('success'))
                this.show({ message: "{{ session('success') }}", type: 'success' });
            @endif
            @if(session('error'))
                this.show({ message: "{{ session('error') }}", type: 'error' });
            @endif
            @if(session('info'))
                this.show({ message: "{{ session('info') }}", type: 'info' });
            @endif
        },

        show(data) {
            const toast = {
                id: this.nextId++,
                message: data.message,
                type: data.type || 'info',
                visible: true
            };

            this.toasts.push(toast);

            setTimeout(() => {
                this.remove(toast.id);
            }, data.duration || 5000);
        },

        remove(id) {
            const toast = this.toasts.find(t => t.id === id);
            if (toast) {
                toast.visible = false;
                setTimeout(() => {
                    this.toasts = this.toasts.filter(t => t.id !== id);
                }, 300);
            }
        }
    }
}

// Global toast helper
window.toast = function(message, type = 'info', duration = 5000) {
    window.dispatchEvent(new CustomEvent('toast', {
        detail: { message, type, duration }
    }));
}
</script>
