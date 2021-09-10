<template>
    <div
        aria-live="assertive"
        class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start"
    >
        <div class="flex flex-col items-center w-full space-y-4 sm:items-end">
            <transition
                enter-active-class="transition duration-300 ease-out transform"
                enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                leave-active-class="transition duration-100 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    v-if="visible"
                    class="w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5"
                >
                    <div class="flex items-start p-4 gap-x-3">
                        <img
                            v-if="toastType === 'success'"
                            src="remixicon/icons/System/checkbox-circle-line.svg"
                            class="flex-shrink-0 w-6 h-6 text-green-400 fill-current"
                            svg-inline
                        />
                        <img
                            v-else-if="toastType === 'error'"
                            src="remixicon/icons/System/error-warning-line.svg"
                            class="flex-shrink-0 w-6 h-6 text-red-400 fill-current"
                            svg-inline
                        />

                        <div class="flex-1 pt-0.5 text-sm space-y-1">
                            <p
                                class="font-medium text-gray-900"
                                v-text="toastMessage"
                            />

                            <p
                                class="text-gray-500"
                                v-if="toastDetails"
                                v-text="toastDetails"
                            />
                        </div>

                        <div class="flex flex-shrink-0">
                            <button
                                @click="visible = false"
                                class="inline-flex text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 p-0.5"
                            >
                                <span class="sr-only">Close</span>

                                <img
                                    src="remixicon/icons/System/close-line.svg"
                                    class="w-5 h-5 fill-current"
                                    svg-inline
                                />
                            </button>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import { watch, computed, ref, nextTick } from 'vue';
    import { usePage } from '@inertiajs/inertia-vue3';

    import isEmpty from 'lodash/isEmpty';

    export default {
        name: 'FlashToast',
        props: {
            closeAfter: {
                type: Number,
                default: 5000,
            },
        },

        setup(props) {
            const visible = ref(false);

            const hide = () => (visible.value = false);
            const show = () => {
                visible.value = true;

                setTimeout(hide, props.closeAfter);
            };

            const flash = computed(() => usePage().props.value.flash);
            const errors = computed(() => usePage().props.value.errors);

            watch(
                [flash, errors],
                ([flash, errors]) => {
                    if (!isEmpty(flash) || !isEmpty(errors)) {
                        nextTick(show);
                    }
                },
                { deep: true }
            );

            return {
                visible,
                show,
                hide,
                ///
                flash,
                errors,
            };
        },
        computed: {
            toastType() {
                if (!isEmpty(this.errors)) {
                    return 'error';
                }

                return !isEmpty(this.flash) && this.flash.hasOwnProperty('type')
                    ? this.flash.type
                    : null;
            },
            toastMessage() {
                if (!isEmpty(this.errors)) {
                    let count = Object.keys(this.errors).length;

                    return this.$tc('error.validation', count, { count });
                }

                return this.flash.message || null;
            },
            toastDetails() {
                return !isEmpty(this.flash) && this.flash.hasOwnProperty('details')
                    ? this.flash.details
                    : null;
            },
        },
    };
</script>
