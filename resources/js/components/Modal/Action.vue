<template>
    <base-modal
        container-class="flex flex-col overflow-hidden"
        max-width="lg"
        @submit="submit"
        @close="close"
        is-form
    >
        <div class="p-4 border-b border-gray-200 sm:px-6">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-medium text-gray-900">
                    <slot name="title" />
                </h2>

                <button
                    type="button"
                    class="text-gray-400 bg-white hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    @click="close"
                >
                    <icon name="System/close-line" class="w-6 h-6" />
                </button>
            </div>
            <div v-if="$slots.description" class="mt-1 text-sm text-gray-300">
                <slot name="description" />
            </div>
        </div>

        <div class="relative flex-1 px-4 py-6 overflow-scroll sm:px-6">
            <slot name="content" />
        </div>

        <div
            v-if="$slots.footer"
            class="flex justify-between items-center space-x-2.5 px-4 py-3 sm:px-6 bg-gray-100"
        >
            <slot name="footer" />
        </div>
    </base-modal>
</template>

<script>
    export default {
        name: 'ActionModal',
        emits: ['submit', 'close'],
        setup(props, { emit }) {
            const submit = (event) => emit('submit', event);
            const close = () => emit('close');

            return {
                submit,
                close,
            };
        },
    };
</script>

