<template>
    <div class="px-4 py-6">
        <button
            type="button"
            class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            @click="attach"
            v-text="$t('app.action.insert')"
        />
    </div>
</template>

<script>
    import { inject } from 'vue';

    export default {
        name: 'MediaAttach',
        props: {
            selectedItems: {
                type: Array,
                required: true,
            },
            to: {
                type: String,
                required: true,
            },
        },
        setup(props) {
            const bus = inject('bus');

            const attach = () => {
                bus.emit('media-library:attach', {
                    id: props.to,
                    items: props.selectedItems,
                });

                bus.emit('media-library:close');
            };

            return {
                attach,
            };
        },
    };
</script>
