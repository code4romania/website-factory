<template>
    <div>
        <div
            class="border-2 border-gray-300 border-dashed"
            :class="{ 'bg-blue-50': isOverDropZone }"
            ref="dropzone"
        >
            <div class="flex justify-center px-6 py-8">
                <div class="space-y-1 text-center">
                    <icon
                        name="System/upload-2-line"
                        class="w-10 h-10 mx-auto text-gray-400"
                    />

                    <div
                        class="flex flex-wrap justify-center gap-1 text-sm text-gray-600"
                    >
                        <label
                            class="relative font-medium text-blue-600 cursor-pointer hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500"
                        >
                            <span v-text="$t('media.upload.file')" />
                            <input
                                type="file"
                                class="sr-only"
                                multiple
                                @change="upload($event.target.files)"
                                :accept="allowedMimeTypes"
                            />
                        </label>

                        <p v-text="$t('media.upload.drag')" />
                    </div>
                </div>
            </div>

            <div
                class="flex flex-wrap justify-between gap-4 px-2 py-1 text-xs text-gray-500 bg-gray-100 border-t border-gray-200"
            >
                <p
                    v-text="
                        $t('media.upload.allowed_extensions', {
                            extensions: allowedExtensions,
                        })
                    "
                />
                <p
                    v-text="
                        $t('media.upload.max_file_size', {
                            size: maxFileSize.formatted,
                        })
                    "
                />
            </div>
        </div>
    </div>
</template>

<script>
    import { ref, computed } from 'vue';
    import { usePage } from '@inertiajs/vue3';
    import { useDropZone } from '@vueuse/core';

    export default {
        name: 'MediaUploader',
        props: {
            currentType: {
                type: String,
                required: true,
                validator: (type) => ['images', 'files'].includes(type),
            },
        },
        emits: ['upload'],
        setup(props, { emit }) {
            const allowedExtensions = computed(() =>
                usePage().props.mediaLibrary.allowedExtensions[
                    props.currentType
                ].join(', ')
            );

            const allowedMimeTypes = computed(
                () =>
                    usePage().props.mediaLibrary.allowedMimeTypes[props.currentType]
            );

            const maxFileSize = computed(
                () => usePage().props.mediaLibrary.maxFileSize
            );

            const dropzone = ref(null);

            const upload = (files) => {
                const filteredFiles = Array.from(files).filter(
                    (file) =>
                        allowedMimeTypes.value.includes(file.type) &&
                        file.size <= maxFileSize.value.raw
                );

                emit('upload', filteredFiles);
            };

            const { isOverDropZone } = useDropZone(dropzone, upload);

            return {
                allowedExtensions,
                allowedMimeTypes,

                maxFileSize,

                dropzone,
                isOverDropZone,
                upload,
            };
        },
    };
</script>

