<template>
    <div :class="absolute ? 'absolute' : 'relative'" ref="target">
        <button type="button" @click="isOpen = !isOpen" :class="triggerClass">
            <slot name="trigger" />

            <icon
                v-if="withArrow"
                name="Arrows/arrow-down-s-line"
                class="w-4 h-4 shrink-0"
                :class="iconClass"
            />

            <icon
                v-else-if="withMore"
                name="System/more-fill"
                class="w-4 h-4 shrink-0"
                :class="iconClass"
            />
        </button>

        <transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >
            <div
                v-show="isOpen"
                class="absolute z-50 mt-2 shadow-lg"
                :class="[width, alignmentClasses]"
                @click="close"
            >
                <div
                    class="ring-1 ring-black ring-opacity-5"
                    :class="contentClass"
                >
                    <slot name="content" />
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    import { computed, ref } from 'vue';
    import { onClickOutside, onKeyStroke } from '@vueuse/core';

    export default {
        name: 'Dropdown',
        props: {
            width: {
                type: String,
                default: 'w-48',
            },
            contentClass: {
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
            iconClass: {
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
            absolute: {
                type: Boolean,
                default: false,
            },
        },
        setup(props) {
            const isOpen = ref(false);
            const target = ref(null);

            const open = () => {
                isOpen.value = true;
            };

            const close = () => {
                isOpen.value = false;
            };

            const alignmentClasses = computed(
                () =>
                    ({
                        'top-right': `origin-top-right right-0 mt-2`,
                        'top-left': `origin-top-left left-0 mt-2`,
                        'bottom-right': `origin-bottom-right bottom-full right-0 mb-2`,
                        'bottom-left': `origin-bottom-left bottom-full left-0 mb-2`,
                    }[props.origin])
            );

            onClickOutside(target, close);

            onKeyStroke('Escape', close);

            return {
                isOpen,
                target,
                open,
                close,

                alignmentClasses,
            };
        },
    };
</script>
