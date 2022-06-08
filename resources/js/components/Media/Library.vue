<template>
    <base-modal
        v-if="isOpen"
        container-class="flex flex-col h-full"
        @close="close"
    >
        <div
            class="flex justify-between py-3 pl-4 pr-3 bg-gray-100 border-b border-gray-200 md:pl-6"
        >
            <h1
                class="text-lg font-medium text-gray-900"
                v-text="$t('media.library')"
            />

            <button
                type="button"
                @click="close"
                class="text-gray-400 hover:text-gray-700 focus:outline-none"
            >
                <icon name="System/close-line" class="w-5 h-5" />
            </button>
        </div>

        <div
            class="flex flex-col items-stretch flex-1 h-full overflow-hidden bg-white lg:flex-row"
        >
            <div class="relative flex flex-col flex-1 overflow-hidden">
                <media-manager-controls
                    class="px-4 pt-8 md:px-6 md:pt-0"
                    :types="types"
                    :current-type="currentType"
                    @change-type="changeType"
                />

                <div
                    class="px-4 py-8 overflow-y-auto md:px-6"
                    ref="itemsContainer"
                >
                    <media-uploader
                        class="mb-8"
                        @upload="upload"
                        :current-type="currentType"
                    />

                    <media-loading-indicator v-if="loading" />

                    <div
                        v-if="currentType === 'files'"
                        class="divide-y divide-gray-200"
                    >
                        <div
                            v-for="(item, index) in items"
                            :key="`media-view-file-${index}`"
                            class="relative flex items-center w-full py-4 text-base bg-white focus:outline-none group disabled:cursor-default disabled:bg-gray-100"
                        >
                            <div class="min-w-0">
                                <form-checkbox
                                    :modelValue="isSelected(item)"
                                    @update:modelValue="toggleSelected(item.id)"
                                    :disabled="item.hasOwnProperty('loading')"
                                />
                            </div>

                            <div
                                v-if="item.hasOwnProperty('loading')"
                                class="flex flex-1 pl-4 text-left sm:pl-6"
                            >
                                <progress-bar
                                    class="h-2"
                                    :value="item.progress"
                                />
                            </div>

                            <button
                                v-else
                                type="button"
                                @click="select(item.id)"
                                class="flex flex-1 text-left"
                            >
                                <div class="flex-1 px-4 sm:px-6">
                                    {{ item.filename }}.{{ item.extension }}
                                </div>

                                <div class="justify-end text-right">
                                    {{ item.size }}
                                </div>
                            </button>
                        </div>
                    </div>

                    <div
                        v-else
                        class="grid grid-cols-2 gap-4 sm:grid-cols-3 sm:gap-6 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-7"
                    >
                        <div
                            v-for="(item, index) in items"
                            :key="`media-view-image-${index}`"
                            class="relative bg-white focus:outline-none group"
                        >
                            <div
                                v-if="item.hasOwnProperty('loading')"
                                class="w-full overflow-hidden aspect-w-1 aspect-h-1"
                            >
                                <div
                                    class="flex items-center p-4 border border-gray-200"
                                >
                                    <progress-bar
                                        class="h-2"
                                        :value="item.progress"
                                    />
                                </div>
                            </div>

                            <template v-else>
                                <form-checkbox
                                    :modelValue="isSelected(item)"
                                    @update:modelValue="toggleSelected(item.id)"
                                    class="absolute top-0 left-0 z-10"
                                    checkbox-class="w-6 h-6"
                                />

                                <button
                                    type="button"
                                    class="block w-full overflow-hidden border border-gray-200 aspect-w-1 aspect-h-1 disabled:cursor-default disabled:bg-gray-100"
                                    :class="{
                                        'ring-4 ring-blue-500': isSelected(
                                            item
                                        ),
                                    }"
                                    :disabled="isDisabled(item)"
                                    @click="select(item.id)"
                                >
                                    <img
                                        :src="item.sizes.thumb.url"
                                        class="object-contain object-center transition-opacity duration-150 select-none group-disabled:opacity-50"
                                        :class="{
                                            'group-hover:opacity-75 group-focus:opacity-75':
                                                !isSelected(item) &&
                                                !isDisabled(item),
                                        }"
                                        loading="lazy"
                                        draggable="false"
                                        alt=""
                                    />
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col border-gray-200 lg:border-l">
                <media-details
                    class="hidden lg:flex-1 lg:w-80 lg:block 2xl:w-96"
                    :items="selectedItems"
                    @clear-selected="clearSelected"
                />

                <media-actions
                    v-if="selectedItems.length"
                    class="border-t border-inherit"
                    :items="selectedItems"
                    :attach-to="attachingMediaTo"
                    @delete-selected="deleteSelected"
                />
            </div>
        </div>
    </base-modal>
</template>

<script>
    import { computed, ref, inject, onMounted, onUnmounted } from 'vue';
    import { useInfiniteScroll } from '@vueuse/core';
    import { useMedia } from '@/helpers';

    export default {
        name: 'MediaLibrary',
        setup() {
            const isOpen = ref(false);
            const loading = ref(true);

            const nextPage = ref(1);

            const attachingMediaTo = ref(null);
            const remainingItems = ref(0);
            const selectedItems = ref([]);
            const disabledItems = ref([]);

            const itemsContainer = ref(null);

            const close = () => {
                isOpen.value = false;

                document.body.style.overflow = null;

                clearSelected();
            };

            const types = computed(() => ['images', 'files']);

            const currentType = ref(types.value[0]);

            const items = ref([]);

            const {
                fetchMedia,
                uploadMedia,
                deleteMedia,
                getMediaConfig,
            } = useMedia();

            const getItems = () => {
                if (nextPage.value === null) {
                    return;
                }

                loading.value = true;

                fetchMedia(currentType.value, nextPage.value, {
                    onSuccess: (response) => {
                        const data = response.data.data;
                        const meta = response.data.meta;

                        items.value.push(...data);

                        if (meta.current_page < meta.last_page) {
                            nextPage.value = meta.current_page + 1;
                        } else {
                            nextPage.value = null;
                        }

                        loading.value = false;
                    },
                    onError: (error) => {
                        loading.value = false;
                    },
                });
            };

            const select = (id) => {
                selectedItems.value = [items.value.find((item) => item.id === id)];
            };

            const toggleSelected = (id) => {
                const alreadyExists = selectedItems.value.find(
                    (item) => item.id === id
                );

                if (!alreadyExists) {
                    selectedItems.value.push(
                        items.value.find((item) => item.id === id)
                    );
                } else {
                    selectedItems.value = selectedItems.value.filter(
                        (item) => item.id !== id
                    );
                }
            };

            const clearSelected = () => {
                selectedItems.value = [];
            };

            const upload = (files) => {
                uploadMedia(files, {
                    beforeStart: (file, replaces) => {
                        const item = {
                            replaces,
                            filename: file.name,
                            loading: true,
                            progress: 0,
                        };

                        items.value.unshift(item);
                    },
                    onUploadProgress: (progress, replaces) => {
                        items.value.find(
                            (item) => item.replaces === replaces
                        ).progress = progress.percentage;
                    },
                    onSuccess: (response, replaces) => {
                        const index = items.value.findIndex(
                            (item) => item.replaces === replaces
                        );

                        items.value[index] = response.data;
                    },
                    onError: (error) => {
                        console.error(error);
                    },
                });
            };

            const deleteSelected = () => {
                deleteMedia(selectedItems.value, {
                    onSuccess: () => {
                        const ids = selectedItems.value.map((item) => item.id);

                        clearSelected();

                        ids.forEach((id) => {
                            items.value.splice(
                                items.value.findIndex((item) => item.id === id),
                                1
                            );
                        });
                    },
                    onError: (error) => {
                        console.error(error);
                    },
                });
            };

            const isSelected = (item) =>
                selectedItems.value.some((i) => i.id === item.id);

            const isDisabled = (item) => disabledItems.value.includes(item.id);

            const bus = inject('bus');
            bus.on('media-library:open', (attach) => {
                isOpen.value = true;

                document.body.style.overflow = 'hidden';

                getItems();

                if (attach) {
                    attachingMediaTo.value = attach.id;
                    remainingItems.value = attach.remaining;
                    disabledItems.value = attach.selected.map((item) => item.id);
                }
            });

            const changeType = (type) => {
                items.value = [];
                currentType.value = type;

                nextPage.value = 1;

                getItems();
            };

            bus.on('media-library:close', close);

            useInfiniteScroll(itemsContainer, getItems, { distance: 25 });

            return {
                isOpen,
                close,
                types,
                currentType,
                changeType,
                loading,

                items,
                selectedItems,
                disabledItems,
                select,
                toggleSelected,
                deleteSelected,
                clearSelected,

                isSelected,
                isDisabled,

                upload,

                itemsContainer,
                attachingMediaTo,
                remainingItems,
            };
        },
    };
</script>

