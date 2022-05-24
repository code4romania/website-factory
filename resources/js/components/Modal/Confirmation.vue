<template>
    <base-modal max-width="lg" @submit="submit" @close="close" is-form>
        <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4 sm:flex sm:items-start">
            <div
                class="flex items-center justify-center w-12 h-12 mx-auto rounded-full shrink-0 sm:mx-0 sm:h-10 sm:w-10"
                :class="iconColor"
            >
                <icon
                    name="System/error-warning-line"
                    class="w-6 h-6 fill-current"
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
    import { computed } from 'vue';

    export default {
        name: 'ConfirmationModal',
        props: {
            color: {
                type: String,
                default: 'yellow',
                validator: (color) =>
                    ['blue', 'green', 'red', 'yellow'].includes(color),
            },
        },
        emits: ['submit', 'close'],
        setup(props, { emit }) {
            const submit = (event) => emit('submit', event);
            const close = () => emit('close');

            const iconColor = computed(
                () =>
                    ({
                        blue: 'bg-blue-100 text-blue-600',
                        green: 'bg-green-100 text-green-600',
                        red: 'bg-red-100 text-red-600',
                        yellow: 'bg-yellow-100 text-yellow-600',
                    }[props.color])
            );

            return {
                submit,
                close,

                iconColor,
            };
        },
    };
</script>

