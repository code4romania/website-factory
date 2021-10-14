<template>
    <div
        class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md"
        :class="{ 'bg-blue-50': isDragging }"
        @dragover.prevent="isDragging = true"
        @dragleave.prevent="isDragging = false"
        @drop.prevent="upload($event.dataTransfer.files)"
    >
        <div class="space-y-1 text-center">
            <icon
                name="System/upload-2-line"
                class="w-10 h-10 mx-auto text-gray-400"
            />

            <div class="flex text-sm text-gray-600">
                <label
                    class="relative font-medium text-blue-600 rounded-md cursor-pointer hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500"
                >
                    <span>Upload a file</span>
                    <input
                        type="file"
                        class="sr-only"
                        multiple
                        ref="uploader"
                        @change="upload($event.target.files)"
                        :accept="accept"
                    />
                </label>
                <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
        </div>
    </div>

    <!-- <progress v-if="form.progress" :value="form.progress.percentage" max="100">
        {{ form.progress.percentage }}%
    </progress> -->

    <!-- <ul class="mt-4" v-if="uploader.files.length">
        <li class="p-1 text-sm" v-for="file in uploader.files">
            ${ file.name }<button
                class="ml-2"
                type="button"
                @click="remove(filelist.indexOf(file))"
                title="Remove file"
            >
                remove
            </button>
        </li>
    </ul> -->
</template>

<script>
    import { ref } from 'vue';

    export default {
        name: 'MediaUploader',
        props: {
            accept: {
                type: String,
                default: null,
            },
        },
        emits: ['upload'],
        setup(props, { emit }) {
            const isDragging = ref(false);
            const uploader = ref(null);

            const upload = (files) => {
                emit('upload', files);
                isDragging.value = false;
            };

            return {
                isDragging,
                upload,
                uploader,
            };
        },
    };
</script>

