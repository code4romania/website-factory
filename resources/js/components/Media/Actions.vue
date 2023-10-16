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
            @click="confirmDelete = true"
            v-text="$t('app.action.delete')"
        />

        <confirmation-modal
            v-if="confirmDelete"
            @close="confirmDelete = false"
            @submit="$emit('delete-selected')"
            color="red"
        >
            <template #title>{{ $t('app.action.delete') }}</template>

            <template #content>
                {{ $t('app.action.deleteConfirm') }}
            </template>

            <template #footer>
                <form-button
                    type="button"
                    @click.prevent="confirmDelete = false"
                    :label="$t('app.action.cancel')"
                    color="white"
                />

                <form-button
                    type="submit"
                    :label="$t('app.action.delete')"
                    color="red"
                />
            </template>
        </confirmation-modal>
    </div>
</template>

<script>
    import { inject, ref } from 'vue';

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
                    id: props.attachTo,
                    items: props.items,
                });

                bus.emit('media-library:close');
            };

            const confirmDelete = ref(false);

            return {
                attach,

                confirmDelete,
            };
        },
    };
</script>
