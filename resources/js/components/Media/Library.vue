<template>
    <base-modal
        :show="isOpen"
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
            <!-- Main -->
            <div class="flex-1 overflow-y-auto">
                <div class="flex flex-col flex-1 max-h-full gap-8 px-4 md:px-6">
                    <media-manager-controls
                        :types="types"
                        :current-type="currentType"
                        :current-view="currentView"
                        @change-view="currentView = $event"
                        @change-type="currentType = $event"
                    />

                    <media-uploader @upload="upload" />

                    <component
                        :is="`media-view-${currentView}`"
                        :items="items"
                        :selectedItems="selectedItems"
                        :disabledItems="disabledItems"
                        @toggle-selected="toggleSelected"
                    />
                </div>
            </div>

            <div class="flex flex-col border-gray-200 lg:border-l">
                <media-details
                    class="hidden lg:flex-1 lg:w-80 lg:block xl:w-96"
                    :items="selectedItems"
                    @clear-selected="clearSelected"
                    @delete-selected="deleteSelected"
                />

                <media-attach
                    v-if="attachingMediaTo && selectedItems.length"
                    class="border-t border-inherit"
                    :selected-items="selectedItems"
                    :to="attachingMediaTo"
                />
            </div>
        </div>
    </base-modal>
</template>

<script>
    import { computed, ref, inject } from 'vue';
    import { useMedia } from '@/helpers';

    export default {
        name: 'MediaLibrary',
        setup() {
            const isOpen = ref(false);
            const loading = ref(true);

            const attachingMediaTo = ref(null);
            const remainingItems = ref(0);
            const selectedItems = ref([]);
            const disabledItems = ref([]);

            const close = () => {
                isOpen.value = false;

                clearSelected();
            };

            const types = computed(() => ['images', 'files']);
            const views = computed(() => ['grid', 'list']);

            const currentType = ref(types.value[0]);
            const currentView = ref(views.value[0]);

            const items = ref([]);

            const { fetchMedia, uploadMedia, deleteMedia } = useMedia();

            const refreshItems = () => {
                fetchMedia({
                    onSuccess: (response) => {
                        items.value = response.data;

                        loading.value = false;
                    },
                    onError: (error) => {
                        //
                    },
                });
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
                    beforeStart: (file) => {
                        console.log(file);
                    },
                    onUploadProgress: (progress) => {
                        console.log('progress', progress);
                    },
                    onSuccess: (response) => {
                        items.value = [].concat(response.data).concat(items.value);
                    },
                    onError: (error) => {
                        //
                    },
                });
            };

            const deleteSelected = () => {
                deleteMedia(selectedItems.value, {
                    onSuccess: () => {
                        selectedItems.value = [];

                        refreshItems();
                    },
                    onError: (error) => {
                        //
                    },
                });
            };

            const bus = inject('bus');
            bus.on('media-library:open', (attach) => {
                isOpen.value = true;

                refreshItems();

                if (attach) {
                    console.log(attach, attach.selected);

                    attachingMediaTo.value = attach.id;
                    remainingItems.value = attach.remaining;
                    disabledItems.value = attach.selected.map((item) => item.id);
                }
            });

            bus.on('media-library:close', close);

            return {
                isOpen,
                close,
                types,
                currentType,

                views,
                currentView,

                items,
                selectedItems,
                disabledItems,
                toggleSelected,
                deleteSelected,
                clearSelected,

                upload,

                attachingMediaTo,
                remainingItems,
            };
        },
    };
</script>
