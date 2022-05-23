<template>
    <div class="flex items-center justify-center flex-1">
        <div class="text-center">
            <icon
                name="Editor/list-check-2"
                class="w-12 h-12 mx-auto text-gray-300"
            />

            <h3
                class="mt-2 text-lg font-medium text-gray-800"
                v-text="$t(`${properties.model}.empty.title`)"
            />
        </div>
    </div>
</template>

<script>
    export default {
        name: 'TableEmpty',
        props: {
            properties: {
                type: Object,
                required: true,
            },
        },
    };
</script>
