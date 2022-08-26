<template>
    <form-field
        :name="name"
        :label="label"
        :label-for="id"
        :help="help"
        :required="required"
        :disabled="disabled"
        :locale="locale"
        v-click-away="closeDropdown"
    >
        <div
            class="flex flex-wrap items-center w-full gap-2 py-2 pl-3 pr-10 overflow-hidden border border-inherit sm:text-sm focus-within:ring-1 focus-within:ring-blue-500"
            @focus="openDropdown"
            ref="root"
        >
            <span
                v-for="option in selected"
                :key="option.key"
                class="inline-flex px-2.5 py-0.5 rounded-full text-xs bg-gray-200 text-gray-800"
            >
                <div class="flex-1" v-text="option.label" />

                <button
                    type="button"
                    class="flex-shrink-0 -mr-1.5 ml-0.5 inline-flex items-center justify-center focus:outline-none p-0.5 w-4 h-4 rounded-full"
                    @click.prevent="deleteItem(option)"
                >
                    <icon name="System/close-line" class="w-2.5 h-2.5" />
                </button>
            </span>

            <input
                class="flex-1 block focus:outline-none"
                autocomplete="off"
                tabindex="0"
                :id="id"
                v-model="search"
                ref="input"
                :placeholder="placeholder"
                @focus.prevent="openDropdown"
                @blur="resetPointer"
                @keydown.esc="closeDropdown"
                @keydown.up.prevent="prevItem"
                @keydown.down.prevent="nextItem"
                @keydown.enter.prevent="enterItem"
                @keydown.backspace="backspaceItem"
                :required="required && !selected.length"
                :disabled="disabled"
            />

            <div
                class="absolute inset-y-0 right-0 flex items-center pr-2"
                @click="openDropdown"
            >
                <icon
                    name="System/arrow-down-s-line"
                    class="w-5 h-5 text-gray-500 fill-current"
                />
            </div>
        </div>

        <transition
            leave-active-class="transition duration-100 ease-in"
            leave-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-if="open"
                class="absolute z-40 w-full py-1 mt-1 overflow-auto text-base bg-white shadow-lg top-full max-h-60 ring-1 ring-black ring-opacity-5 sm:text-sm"
                ref="menu"
            >
                <ul
                    v-if="filteredOptions.length"
                    role="listbox"
                    class="focus:outline-none"
                >
                    <li
                        v-for="(option, index) in filteredOptions"
                        :key="index"
                        role="option"
                        class="relative flex px-3 py-2 cursor-pointer select-none"
                        :class="{
                            'text-white bg-blue-600': pointer === index,
                            'text-gray-900': pointer !== index,
                        }"
                        @click="selectItem(option)"
                        @mouseenter="pointerSet(index)"
                    >
                        <span
                            class="flex-1 block font-normal truncate"
                            v-text="option.label"
                        />
                    </li>
                </ul>
                <p
                    v-else
                    class="flex px-3 py-2 text-gray-500 select-none"
                    v-text="$t('app.search.empty')"
                    @click="closeDropdown"
                />
            </div>
        </transition>
    </form-field>
</template>

<script>
    import { computed, ref, nextTick, watch } from 'vue';
    import { defineInput, useFilter, useLocale } from '@/helpers';
    import isEqual from 'lodash/isEqual';

    export default defineInput({
        name: 'FormSelectMultiple',
        props: {
            options: {
                type: Array,
                default: () => [],
            },
            optionValueKey: {
                type: String,
                default: 'value',
            },
            optionLabelKey: {
                type: String,
                default: 'label',
            },
        },
        setup(props, { emit }) {
            const { currentLocale } = useLocale();
            const { filterPredicate } = useFilter();

            const selected = ref([]);
            const open = ref(false);
            const search = ref('');
            const pointer = ref(-1);

            const root = ref(null);
            const input = ref(null);
            const menu = ref(null);

            const get = (option, key) => {
                return option.hasOwnProperty(key)
                    ? option[key][currentLocale.value] || option[key]
                    : option[currentLocale.value] || option || null;
            };

            const options = computed(() =>
                props.options.map((option) => ({
                    value: get(option, props.optionValueKey),
                    label: get(option, props.optionLabelKey),
                }))
            );

            const openDropdown = () => {
                if (props.disabled) {
                    return;
                }

                input.value.focus();
                open.value = true;
            };

            const closeDropdown = () => {
                open.value = false;

                resetPointer();
            };

            const resetPointer = () => {
                search.value = '';
                pointer.value = -1;
            };

            const prevItem = () => {
                if (!open.value) {
                    open.value = true;
                }

                nextTick(() => {
                    pointerAdjust(-1);

                    menu.value.scrollTop = root.value.offsetHeight * pointer.value;
                });
            };

            const nextItem = () => {
                if (!open.value) {
                    open.value = true;
                }

                nextTick(() => {
                    pointerAdjust(+1);

                    const nextIndexScrollTop =
                        root.value.offsetHeight * pointer.value;

                    // move scroll
                    const currentMenuHeight = menu.value.offsetHeight;
                    const currentPage = Math.ceil(
                        (menu.value.scrollTop + root.value.offsetHeight) /
                            currentMenuHeight
                    );
                    const itemPage = Math.ceil(
                        nextIndexScrollTop / currentMenuHeight
                    );

                    if (currentPage !== itemPage) {
                        menu.value.scrollTop =
                            (itemPage - 1) * menu.value.offsetHeight;
                    }
                });
            };

            const enterItem = () => {
                const currentItem = filteredOptions.value[pointer.value];

                if (!currentItem) {
                    return;
                }

                if (!selected.value.find((o) => o.value === currentItem.value)) {
                    selected.value.push(currentItem);
                }

                resetPointer();
            };

            const backspaceItem = () => {
                if (search.value) {
                    return;
                }

                selected.value.pop();
            };

            const pointerSet = (index) => {
                pointer.value = index;
            };

            const pointerAdjust = (offset = 0) => {
                pointer.value = pointer.value + offset;

                if (pointer.value < 0) {
                    pointer.value = filteredOptions.value.length - 1;
                } else if (pointer.value >= filteredOptions.value.length) {
                    pointer.value = 0;
                }
            };

            const selectItem = (option) => {
                if (!selected.value.find((o) => o.value === option.value)) {
                    selected.value.push(option);
                }

                closeDropdown();
            };

            const deleteItem = (option) => {
                selected.value = selected.value.filter(
                    (o) => o.value !== option.value
                );
            };

            const selectedValues = computed(() =>
                selected.value.map((option) => option.value)
            );

            const notSelected = computed(() =>
                options.value.filter((option) => !selected.value.includes(option))
            );

            const filteredOptions = computed(() => {
                if (!search.value) {
                    return notSelected.value;
                }

                return notSelected.value.filter((option) =>
                    filterPredicate(option.label, search.value)
                );
            });

            watch(
                () => props.modelValue,
                (value) => {
                    if (isEqual(selectedValues.value, value)) {
                        return;
                    }

                    selected.value = value
                        .map((v) => options.value.find((o) => o.value === v))
                        .filter((v) => typeof v !== 'undefined');
                },
                {
                    immediate: true,
                }
            );

            watch(
                selectedValues,
                (values) => {
                    emit('update:modelValue', values);
                },
                {
                    deep: true,
                }
            );

            return {
                selected,
                options,
                filteredOptions,

                search,
                open,
                pointer,

                openDropdown,
                closeDropdown,
                pointerSet,

                prevItem,
                nextItem,
                enterItem,
                backspaceItem,

                selectItem,
                deleteItem,

                // refs
                root,
                input,
                menu,
            };
        },
    });
</script>
