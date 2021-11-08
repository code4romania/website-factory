<template>
    <div class="flex px-4 py-6 space-x-3">
        <button
            v-if="attachTo"
            type="button"
            class="flex-1 px-4 py-2 text-sm font-medium text-center text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            @click="attach"
            v-text="$t('app.action.attach')"
        />

        <button
            type="button"
            class="flex-1 px-4 py-2 text-sm font-semibold text-center text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
            @click="$emit('delete-selected')"
            v-text="$t('app.action.delete')"
        />
    </div>
</template>

<script>
    import { inject } from 'vue';

    export default {
        name: 'MediaActions',
        props: {
            items: {
                type: Array,
                required: true,
            },
            attachTo: {
                type: String,
                default: null,
            },
        },
        emits: ['delete-selected'],
        setup(props) {
            const bus = inject('bus');

            const attach = () => {
                bus.emit('media-library:attach', {
                    id: props.to,
                    items: props.items,
                });

                bus.emit('media-library:close');
            };

            return {
                attach,
            };
        },
    };
</script>
