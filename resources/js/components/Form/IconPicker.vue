<template>
    <form-field
        :name="name"
        :label="$t('field.icon')"
        :label-for="id"
        :help="help"
        :required="required"
        :disabled="disabled"
        :locale="locale"
    >
        <button
            type="button"
            class="w-16 h-16 p-4 border border-gray-400"
            :title="$t('app.action.select')"
            @click="open"
        >
            <icon v-if="selectedIcon" :name="selectedIcon" />
        </button>

        <div
            v-show="isOpen"
            v-click-away="() => close()"
            class="absolute z-50 flex flex-col bg-white rounded shadow-xl top-full w-72 max-h-96"
        >
            <input
                type="search"
                class="block w-full px-3 py-2 text-gray-900 placeholder-gray-500 border-transparent focus:outline-none focus:placeholder-gray-400 focus:ring-0 sm:text-sm"
                autocomplete="off"
                :placeholder="$t('app.action.search')"
                @keydown.stop
                @keydown.enter.prevent
                @keydown.esc.stop="close"
                v-model="query"
                ref="search"
            />

            <div class="flex-1 overflow-scroll">
                <div
                    v-for="({ group, icons }, groupIndex) in filteredIcons"
                    :key="groupIndex"
                >
                    <p
                        class="sticky top-0 z-10 flex items-center px-4 py-1 text-sm font-medium text-gray-500 border-t border-b border-gray-200 bg-gray-50"
                        v-text="group"
                    />

                    <div class="grid grid-cols-6 gap-1 px-2 py-2 text-gray-700">
                        <button
                            type="button"
                            v-for="icon in icons"
                            :key="`${group}/${icon}`"
                            :title="`${group}/${icon}`"
                            @click.prevent="select(group, icon)"
                            class="p-2 hover:text-blue-500"
                        >
                            <icon
                                :name="`${group}/${icon}`"
                                class="w-full h-full"
                            />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form-field>
</template>

<script>
    import { computed, ref, nextTick } from 'vue';
    import { defineInput } from '@/helpers';
    import cloneDeep from 'lodash/cloneDeep';
    import icons from '@/icons';

    export default defineInput({
        name: 'FormIconPicker',
        setup(props, { emit }) {
            const isOpen = ref(false);
            const query = ref('');
            const search = ref(null);

            const filteredIcons = computed(() => {
                if (!query.value) {
                    return icons;
                }

                return cloneDeep(icons)
                    .map((group) => {
                        group.icons = group.icons.filter((icon) =>
                            icon.toLowerCase().includes(query.value.toLowerCase())
                        );

                        return group;
                    })
                    .filter(({ icons }) => icons.length);
            });

            const selectedIcon = computed({
                get: () => {
                    let fullpath = null;

                    icons.forEach(({ group, icons }) => {
                        if (icons.includes(props.modelValue)) {
                            fullpath = `${group}/${props.modelValue}`;
                        }
                    });

                    return fullpath;
                },
                set: (icon) => emit('update:modelValue', icon),
            });

            const open = async () => {
                isOpen.value = true;

                await nextTick();

                search.value.focus();
            };

            const close = () => {
                isOpen.value = false;
                query.value = '';
            };

            const select = (group, icon) => {
                selectedIcon.value = icon;

                close();
            };

            return {
                isOpen,
                query,

                open,
                close,
                select,

                search,
                filteredIcons,
                selectedIcon,
            };
        },
    });
</script>

