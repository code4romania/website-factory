<template>
    <form-field
        :name="name"
        :label="label"
        :label-for="id"
        :help="null"
        :required="required"
        :disabled="disabled"
        :locale="locale"
    >
        <draggable
            :list="media"
            item-key="id"
            class="w-full border divide-y divide-gray-200 border-inherit list-group"
            group="media"
            ghost-class="opacity-50"
            handle=".handle"
            :animation="200"
            @change="$emit('update:media', media)"
        >
            <template #item="{ element, index }">
                <div class="relative flex text-sm bg-white list-group-item">
                    <div
                        class="flex-shrink-0 w-5 px-1 py-2 bg-gray-100 border-r cursor-move handle"
                    >
                        <icon
                            name="drag"
                            class="w-full h-full text-gray-400"
                            local
                        />
                    </div>

                    <div class="flex flex-1 px-2 py-4">
                        <div class="flex-shrink-0 w-24">
                            <div
                                class="overflow-hidden border border-gray-200 group aspect-w-1 aspect-h-1"
                            >
                                <img
                                    class="object-contain object-center"
                                    :src="element.sizes.thumb.url"
                                    loading="lazy"
                                    alt=""
                                />
                            </div>
                        </div>

                        <div class="flex-1 flex-shrink px-4">
                            <div
                                class="font-bold truncate"
                                v-text="
                                    `${element.filename}.${element.extension}`
                                "
                            />
                            <div class="truncate" v-text="element.size" />
                        </div>

                        <div class="flex-shrink-0">
                            <button
                                type="button"
                                @click="deleteImage(index)"
                                class="text-gray-400 hover:text-red-600 focus:outline-none"
                            >
                                <icon
                                    name="System/delete-bin-line"
                                    class="w-5 h-5"
                                />
                            </button>
                        </div>
                    </div>
                </div>
            </template>

            <template #footer>
                <div
                    class="flex items-center justify-between px-6 py-4 list-group-item"
                >
                    <button
                        type="button"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-100 disabled:opacity-50"
                        :disabled="!remainingImages"
                        @click="addImage"
                    >
                        Add Image
                    </button>

                    <div v-if="limit > 1" class="text-sm text-gray-500">
                        Add up to {{ limit }} images
                    </div>
                </div>
            </template>
        </draggable>
    </form-field>
</template>

<script>
    import Draggable from 'vuedraggable';
    import { defineInput, useMedia } from '@/helpers';
    import { computed, ref, inject } from 'vue';

    export default defineInput({
        name: 'FormMedia',
        components: {
            Draggable,
        },
        props: {
            type: {
                type: String,
                default: 'text',
            },
            limit: {
                type: Number,
                default: 1,
            },
            media: {
                type: Array,
                required: true,
            },
        },
        emits: ['update:media'],
        setup(props) {
            // const media = ref(props.media);

            const remainingImages = computed(() =>
                Math.max(0, props.limit - props.media.length)
            );

            const { openMediaLibrary } = useMedia();

            const addImage = () => {
                if (!remainingImages.value) {
                    return;
                }

                openMediaLibrary(props.id, remainingImages.value, props.media);
            };

            const bus = inject('bus');
            bus.on('media-library:attach', ({ id, items }) => {
                if (!id || id !== props.id) {
                    return;
                }

                items.forEach((item) => {
                    if (
                        remainingImages.value > 0 &&
                        !props.media.some((image) => image.id === item.id)
                    ) {
                        props.media.push(item);
                    }
                });
            });

            const deleteImage = (index) => {
                props.media.splice(index, 1);
            };

            return {
                // media,
                remainingImages,
                addImage,
                deleteImage,
            };
        },
    });
</script>

