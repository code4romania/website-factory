<template>
    <div class="flex items-center gap-x-3">
        <div
            class="flex px-1 py-4 text-sm whitespace-nowrap"
            v-text="$tChoice('app.table_bulk.selected', selected.length)"
        />

        <select class="block text-xs">
            <option value v-text="$t('app.table_bulk.action')" />
        </select>

        <form-button
            type="button"
            @click.prevent="apply"
            :label="$t('app.action.apply')"
            color="blue"
            size="xs"
        />

        <form-button
            type="button"
            @click.prevent="clear"
            :label="$t('app.action.clear')"
            color="white"
            size="xs"
        />
    </div>
</template>

<script>
    export default {
        name: 'TableBulkActions',
        props: {
            selected: {
                type: Array,
                default: () => [],
            },
            items: {
                type: Array,
                default: () => [],
            },
        },
        emits: ['clear'],
        setup(props, { emit }) {
            const actions = () => ({
                //
            });

            const clear = () => emit('clear');

            const apply = () => {
                clear();
            };

            return {
                apply,
                clear,
            };
        },
    };
</script>
