<template>
    <div class="relative">
        <button type="button" @click="open = !open" :class="triggerClass">
            <slot name="trigger" />

            <icon
                v-if="withArrow"
                name="System/arrow-down-s-line"
                class="w-4 h-4"
            />

            <icon
                v-else-if="withMore"
                name="System/more-fill"
                class="w-4 h-4"
            />
        </button>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="fixed inset-0 z-40" @click="open = false" />

        <transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >
            <div
                v-show="open"
                class="absolute z-50 mt-2 shadow-lg"
                :class="[width, alignmentClasses]"
                @click="open = false"
            >
                <div
                    class="ring-1 ring-black ring-opacity-5"
                    :class="contentClasses"
                >
                    <slot name="content" />
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    import { onMounted, onUnmounted, ref } from 'vue';

    export default {
        name: 'Dropdown',
        props: {
            width: {
                type: String,
                default: 'w-48',
            },
            contentClasses: {
                default: () => ['py-1', 'bg-white'],
            },
            origin: {
                type: String,
                default: 'top-left',
            },
            triggerClass: {
                type: String,
                default: null,
            },
            withArrow: {
                type: Boolean,
                default: false,
            },
            withMore: {
                type: Boolean,
                default: false,
            },
        },
        setup() {
            const open = ref(false);

            const closeOnEscape = (e) => {
                if (open.value && e.keyCode === 27) {
                    open.value = false;
                }
            };

            onMounted(() => {
                document.addEventListener('keydown', closeOnEscape);
            });

            onUnmounted(() => {
                document.removeEventListener('keydown', closeOnEscape);
            });

            return {
                open,
            };
        },

        computed: {
            alignmentClasses() {
                return {
                    'top-right': 'origin-top-right right-0 mt-2',
                    'top-left': 'origin-top-left left-0 mt-2',
                    'bottom-right': 'origin-bottom-right bottom-full right-0 mb-2',
                    'bottom-left': 'origin-bottom-left bottom-full left-0 mb-2',
                }[this.origin];
            },
        },
    };
</script>
