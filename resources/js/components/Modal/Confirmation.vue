<template>
    <base-modal max-width="lg" @submit="submit" @close="close" is-form>
        <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4 sm:flex sm:items-start">
            <div
                class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10"
            >
                <icon
                    name="System/error-warning-line"
                    class="w-6 h-6 text-red-600"
                />
            </div>

            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3
                    class="text-lg font-semibold leading-6 text-gray-900"
                    v-if="$slots.title"
                >
                    <slot name="title" />
                </h3>

                <div class="mt-2 text-sm text-gray-500">
                    <slot name="content" />
                </div>
            </div>
        </div>

        <div
            v-if="$slots.footer"
            class="flex justify-end space-x-2.5 px-4 py-3 sm:px-6 bg-gray-100"
        >
            <slot name="footer" />
        </div>
    </base-modal>
</template>

<script>
    export default {
        name: 'ConfirmationModal',
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

