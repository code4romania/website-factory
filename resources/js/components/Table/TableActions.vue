<template>
    <dropdown
        v-if="actions.length"
        origin="top-right"
        trigger-class="px-1 py-1 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-full hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        with-arrow
    >
        <template #content>
            <dropdown-item
                v-for="(action, index) in actions"
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
    import { ref, computed } from 'vue';
    import { useLocale } from '@/helpers';
    import { useForm } from '@inertiajs/inertia-vue3';
    import { route } from '@/helpers';

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

            const { currentLocale } = useLocale();

            const confirmAction = ref(null);

            const adminRoute = (suffix, args) =>
                route(props.properties.admin_route_prefix + '.' + suffix, {
                    id: props.row.id,
                    ...args,
                });

            const actions = computed(() => {
                const actions = [];

                if (props.row.hasOwnProperty('slug')) {
                    actions.push({
                        href: route(props.properties.front_route_prefix + '.show', {
                            locale: currentLocale.value,
                            [props.properties.model]:
                                props.row.slug || props.row.id,
                        }),
                        label: 'app.action.view',
                        target: '_blank',
                        type: 'link',
                    });
                }

                if (props.row.can.update && !props.row.trashed) {
                    actions.push({
                        href: adminRoute('edit'),
                        label: 'app.action.edit',
                        type: 'link',
                    });

                    if (
                        route().has(
                            props.properties.admin_route_prefix + '.duplicate'
                        )
                    ) {
                        actions.push({
                            click: () => (confirmAction.value = 'duplicate'),
                            label: 'app.action.duplicate',
                            type: 'button',
                        });
                    }
                }

                if (props.row.can.delete && !props.row.trashed) {
                    actions.push({
                        click: () => (confirmAction.value = 'delete'),
                        label: 'app.action.delete',
                        type: 'button',
                    });
                }

                if (props.row.trashed) {
                    if (props.row.can.restore) {
                        actions.push({
                            click: () => (confirmAction.value = 'restore'),
                            label: 'app.action.restore',
                            type: 'button',
                        });
                    }

                    if (props.row.can.forceDelete) {
                        actions.push({
                            click: () => (confirmAction.value = 'forceDelete'),
                            label: 'app.action.forceDelete',
                            type: 'button',
                        });
                    }
                }

                return actions;
            });

            const actionDuplicate = () => {
                return form.post(adminRoute('duplicate'), {
                    onSuccess: () => (confirmAction.value = null),
                });
            };

            const actionDelete = () => {
                return form.delete(adminRoute('destroy'), {
                    onSuccess: () => (confirmAction.value = null),
                });
            };
            const actionForceDelete = () => {
                return form.delete(adminRoute('forceDelete'), {
                    onSuccess: () => (confirmAction.value = null),
                });
            };

            const actionRestore = () => {
                return form.put(adminRoute('restore'), {
                    onSuccess: () => (confirmAction.value = null),
                });
            };

            return {
                confirmAction,
                actions,

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
