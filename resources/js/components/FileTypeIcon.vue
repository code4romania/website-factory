<template>
    <div>
        <icon
            v-if="type === 'pdf'"
            name="Document/file-pdf-fill"
            class="w-full h-full text-red-600"
        />

        <icon
            v-else-if="type === 'video'"
            name="Media/video-fill"
            class="w-full h-full text-rose-600"
        />

        <icon
            v-else-if="type === 'audio'"
            name="Document/file-music-fill"
            class="w-full h-full text-teal-600"
        />

        <icon
            v-else-if="type === 'archive'"
            name="Document/file-zip-fill"
            class="w-full h-full text-yellow-600"
        />

        <icon
            v-else-if="type === 'document'"
            name="Document/file-text-fill"
            class="w-full h-full text-blue-600"
        />

        <icon
            v-else-if="type === 'spreadsheet'"
            name="Document/file-excel-fill"
            class="w-full h-full text-green-600"
        />

        <icon
            v-else-if="type === 'presentation'"
            name="Document/file-ppt-fill"
            class="w-full h-full text-orange-600"
        />

        <icon
            v-else
            name="Document/file-fill"
            class="w-full h-full text-gray-300"
        />
    </div>
</template>

<script>
    export default {
        name: 'FileTypeIcon',
        props: {
            type: {
                type: String,
                required: true,
            },
        },
    };
</script>
