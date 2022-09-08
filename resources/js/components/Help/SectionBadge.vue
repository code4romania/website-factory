<template>
    <span
        class="inline-flex items-center rounded px-2 py-0.5 text-xs font-medium"
        :class="[color]"
        v-text="section"
    />
</template>

<script>
    export default {
        name: 'HelpSectionBadge',
        props: {
            section: {
                type: String,
                required: true,
            },
            index: {
                type: Number,
            },
        },
        setup(props) {
            const color =
                [
                    'bg-green-100 text-green-800',
                    'bg-yellow-100 text-yellow-800',
                    'bg-blue-100 text-blue-800',
                    'bg-indigo-100 text-indigo-800',
                    'bg-purple-100 text-purple-800',
                    'bg-pink-100 text-pink-800',
                    'bg-red-100 text-red-800',
                ][props.index - 1] || 'bg-gray-100 text-gray-800';

            return {
                color,
            };
        },
    };
</script>

