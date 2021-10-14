<template>
    <base-modal
        :show="show"
        container-class="flex flex-col h-full"
        @close="$emit('close')"
    >
        <div class="px-4 py-3 bg-gray-100 border-b border-gray-200 md:px-6">
            <h1
                class="text-lg font-medium text-gray-900"
                v-text="$t('media.library')"
            />
        </div>

        <div class="flex items-stretch flex-1 h-full overflow-hidden bg-white">
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

                    <media-view-grid
                        v-if="currentView === 'grid'"
                        :items="items"
                        :selectedItems="selectedItems"
                        @toggle-selected="toggleSelected"
                    />
                </div>
            </div>

            <media-details
                class="hidden border-l border-gray-200 w-80 lg:block xl:w-96"
                :items="items.filter((item) => selectedItems.includes(item.id))"
                @clear-selected="selectedItems = []"
                @delete-selected="deleteSelected"
            />
        </div>
    </base-modal>
</template>

<script>
    import { computed, ref, onMounted } from 'vue';
    import { useMedia } from '@/helpers';

    export default {
        name: 'MediaManager',
        props: {
            show: {
                type: Boolean,
                default: false,
            },
        },
        emits: ['close'],
        setup(props) {
            const { fetchMedia, uploadMedia, deleteMedia } = useMedia();
            const loading = ref(true);

            const types = computed(() => ['images', 'files']);
            const views = computed(() => ['grid', 'list']);

            const currentType = ref(types.value[0]);
            const currentView = ref(views.value[0]);

            const items = ref([]);
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

            onMounted(refreshItems);

            const selectedItems = ref([]);
            const toggleSelected = (id) => {
                if (!selectedItems.value.includes(id)) {
                    return selectedItems.value.push(id);
                }

                selectedItems.value = selectedItems.value.filter(
                    (item) => item !== id
                );
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

            return {
                types,
                currentType,

                views,
                currentView,

                items,
                selectedItems,
                toggleSelected,
                deleteSelected,

                upload,
            };
        },
    };
</script>
