import { ref, computed } from 'vue';
import { route, useLocale } from '@/helpers';

export default function (props, form) {
    const { currentLocale } = useLocale();

    const adminRoute = (suffix) =>
        route(props.properties.admin_route_prefix + '.' + suffix, {
            id: props.row.id,
        });

    const frontRoute = (item) =>
        route(props.properties.front_route_prefix + '.show', {
            locale: currentLocale.value,
            [props.properties.model]: item.slug || item.id,
        });

    const confirmAction = ref(null);

    const itemActions = computed(() => {
        const actions = [];

        if (!props.hasOwnProperty('row')) {
            return actions;
        }

        if (props.row.hasOwnProperty('slug') && !props.row.trashed) {
            actions.push({
                href: frontRoute(props.row),
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
                route().has(props.properties.admin_route_prefix + '.duplicate')
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

    const actionDuplicate = () =>
        form.post(adminRoute('duplicate'), {
            onSuccess: () => (confirmAction.value = null),
        });

    const actionDelete = () =>
        form.delete(adminRoute('destroy'), {
            onSuccess: () => (confirmAction.value = null),
        });
    const actionForceDelete = () =>
        form.delete(adminRoute('forceDelete'), {
            onSuccess: () => (confirmAction.value = null),
        });

    const actionRestore = () =>
        form.put(adminRoute('restore'), {
            onSuccess: () => (confirmAction.value = null),
        });

    return {
        adminRoute,
        confirmAction,
        itemActions,

        actionDuplicate,
        actionDelete,
        actionForceDelete,
        actionRestore,
    };
}
