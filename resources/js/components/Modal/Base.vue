<template>
    <teleport to="body">
        <component
            :is="isForm ? 'form' : 'div'"
            class="fixed inset-0 z-50 flex items-start justify-center min-h-screen sm:p-4 md:p-8 lg:p-16 xl:p-32"
            @submit.prevent="submit"
        >
            <div class="fixed inset-0 bg-gray-500 opacity-75" @click="close" />

            <div
                class="w-full max-h-full transition-all transform bg-white shadow-xl"
                :class="[maxWidth, containerClass]"
            >
                <slot />
            </div>
        </component>
    </teleport>
</template>

<script>
    import { computed, watch, onMounted, onUnmounted } from 'vue';

    export default {
        name: 'BaseModal',
        props: {
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
                if (!['Esc', 'Escape'].includes(event.key)) {
                    return;
                }

                // Bail if key was pressed inside inputs
                if (
                    event.target.isContentEditable ||
                    ['INPUT', 'TEXTAREA', 'SELECT'].includes(event.target.tagName)
                ) {
                    return;
                }

                close();
            };

            onMounted(() => {
                console.log('mounted');
                document.addEventListener('keydown', closeOnKeyPress);
                document.body.classList.add('overflow-hidden');
            });

            onUnmounted(() => {
                console.log('unmounted');
                document.removeEventListener('keydown', closeOnKeyPress);
                document.body.classList.remove('overflow-hidden');
            });

            return {
                maxWidth,
                submit,
                close,
            };
        },
    };
</script>
