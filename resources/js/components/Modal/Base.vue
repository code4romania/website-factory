<template>
    <teleport to="body">
        <transition
            enter-active-class="duration-300 ease-out"
            leave-active-class="duration-200"
        >
            <component
                :is="isForm ? 'form' : 'div'"
                v-show="show"
                class="fixed inset-0 z-50 flex items-start justify-center min-h-screen p-4 md:p-8"
                @submit.prevent="submit"
            >
                <transition
                    enter-active-class="duration-300 ease-out"
                    enter-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="duration-200 ease-in"
                    leave-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div
                        v-show="show"
                        class="fixed inset-0 transition-opacity transform"
                        @click="close"
                    >
                        <div class="absolute inset-0 bg-gray-500 opacity-75" />
                    </div>
                </transition>

                <transition
                    enter-active-class="duration-300 ease-out"
                    enter-class="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                    enter-to-class="translate-y-0 opacity-100 sm:scale-100"
                    leave-active-class="duration-200 ease-in"
                    leave-class="translate-y-0 opacity-100 sm:scale-100"
                    leave-to-class="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                >
                    <div
                        v-if="show"
                        class="w-full max-h-full transition-all transform bg-white shadow-xl"
                        :class="[maxWidth, containerClass]"
                    >
                        <slot />
                    </div>
                </transition>
            </component>
        </transition>
    </teleport>
</template>

<script>
    import { computed, watch, onMounted, onUnmounted } from 'vue';

    export default {
        name: 'BaseModal',
        props: {
            show: {
                type: Boolean,
                default: false,
            },
            isForm: {
                type: Boolean,
                default: false,
            },
            maxWidth: {
                type: String,
                default: null,
            },
            containerClass: {
                type: String,
                default: null,
            },
        },
        emits: ['submit', 'close'],
        setup(props, { emit }) {
            const maxWidth = computed(
                () =>
                    ({
                        sm: 'sm:max-w-sm',
                        md: 'sm:max-w-md',
                        lg: 'sm:max-w-lg',
                        xl: 'sm:max-w-xl',
                        '2xl': 'sm:max-w-2xl',
                    }[props.maxWidth] || null)
            );

            const submit = (event) => {
                if (props.isForm) {
                    emit('submit', event);
                }
            };

            const close = () => emit('close');
            const closeOnKeyPress = (event) => {
                if (!props.show) {
                    return;
                }

                if (!['Esc', 'Escape'].includes(event.key)) {
                    return;
                }

                // Bail if key was pressed inside inputs
                if (
                    event.target.contentEditable ||
                    ['INPUT', 'TEXTAREA', 'SELECT'].includes(event.target.tagName)
                ) {
                    return;
                }

                close();
            };

            onMounted(() => {
                document.addEventListener('keydown', closeOnKeyPress);
            });

            onUnmounted(() => {
                document.removeEventListener('keydown', closeOnKeyPress);
                document.body.classList.remove('overflow-hidden');
            });

            watch(
                () => props.show,
                (show) => {
                    document.body.classList.toggle('overflow-hidden', show);
                },
                { immediate: true }
            );

            return {
                maxWidth,
                submit,
                close,
            };
        },
    };
</script>
