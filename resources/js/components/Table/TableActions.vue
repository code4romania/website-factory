<template>
    <dropdown
        v-if="itemActions.length"
        origin="top-right"
        trigger-class="px-1 py-1 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-full hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        with-arrow
    >
        <template #content>
            <dropdown-item
                v-for="(action, index) in itemActions"
                :key="index"
                @click="action.click"
                v-bind="action"
            >
                <span v-text="$t(action.label)" />
            </dropdown-item>
        </template>
    </dropdown>

    <!-- Duplicate confirmation modal -->
    <confirmation-modal
        v-if="confirmAction === 'duplicate'"
        @close="confirmAction = null"
        @submit="actionDuplicate"
        color="blue"
    >
        <template #title>{{ $t('app.action.duplicate') }}</template>

        <template #content>
            {{ $t('app.action.duplicateConfirm') }}
        </template>

        <template #footer>
            <form-button
                type="button"
                @click.prevent="confirmAction = null"
                :label="$t('app.action.cancel')"
                :disabled="form.processing"
                color="white"
            />

            <form-button
                type="submit"
                :label="$t('app.action.duplicate')"
                :disabled="form.processing"
                color="blue"
            />
        </template>
    </confirmation-modal>

    <!-- Delete confirmation modal -->
    <confirmation-modal
        v-if="confirmAction === 'delete'"
        @close="confirmAction = null"
        @submit="actionDelete"
        color="red"
    >
        <template #title>{{ $t('app.action.delete') }}</template>

        <template #content>
            {{ $t('app.action.deleteConfirm') }}
        </template>

        <template #footer>
            <form-button
                type="button"
                @click.prevent="confirmAction = null"
                :label="$t('app.action.cancel')"
                :disabled="form.processing"
                color="white"
            />

            <form-button
                type="submit"
                :label="$t('app.action.delete')"
                :disabled="form.processing"
                color="red"
            />
        </template>
    </confirmation-modal>

    <!-- Force delete confirmation modal -->
    <confirmation-modal
        v-if="confirmAction === 'forceDelete'"
        @close="confirmAction = null"
        @submit="actionForceDelete"
        color="red"
    >
        <template #title>{{ $t('app.action.forceDelete') }}</template>

        <template #content>
            {{ $t('app.action.forceDeleteConfirm') }}
        </template>

        <template #footer>
            <form-button
                type="button"
                @click.prevent="confirmAction = null"
                :label="$t('app.action.cancel')"
                :disabled="form.processing"
                color="white"
            />

            <form-button
                type="submit"
                :label="$t('app.action.delete')"
                :disabled="form.processing"
                color="red"
            />
        </template>
    </confirmation-modal>

    <!-- Restore confirmation modal -->
    <confirmation-modal
        v-if="confirmAction === 'restore'"
        @close="confirmAction = null"
        @submit="actionRestore"
        color="blue"
    >
        <template #title>{{ $t('app.action.restore') }}</template>

        <template #content>
            {{ $t('app.action.restoreConfirm') }}
        </template>

        <template #footer>
            <form-button
                type="button"
                @click.prevent="confirmAction = null"
                :label="$t('app.action.cancel')"
                :disabled="form.processing"
                color="white"
            />

            <form-button
                type="submit"
                :label="$t('app.action.restore')"
                :disabled="form.processing"
                color="blue"
            />
        </template>
    </confirmation-modal>
</template>

<script>
    import { useTableActions } from '@/helpers';
    import { useForm } from '@inertiajs/inertia-vue3';

    export default {
        name: 'TableActions',
        props: {
            row: {
                type: Object,
                required: true,
            },
            properties: {
                type: Object,
                required: true,
            },
        },
        setup(props) {
            const form = useForm();

            const {
                confirmAction,
                itemActions,

                actionDuplicate,
                actionDelete,
                actionForceDelete,
                actionRestore,
            } = useTableActions(props, form);

            return {
                confirmAction,
                itemActions,

                //
                form,
                actionDuplicate,
                actionDelete,
                actionForceDelete,
                actionRestore,
            };
        },
    };
</script>
