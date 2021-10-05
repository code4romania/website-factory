<template>
    <td class="p-5 pl-2.5 flex justify-end">
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
                    :href="action.href"
                    :target="action.target"
                    :method="action.method"
                    :as="action.method !== 'get' ? 'button' : 'a'"
                >
                    <span v-text="action.label" />
                </dropdown-item>
            </template>
        </dropdown>
    </td>
</template>

<script>
    import { usePage } from '@inertiajs/inertia-vue3';

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
        computed: {
            actions() {
                const actions = [];

                if (this.row.hasOwnProperty('slug')) {
                    actions.push({
                        href: this.route('front.pages.show', {
                            locale: usePage().props.value.locales.current,
                            page: this.row.slug,
                        }),
                        label: this.$t('app.action.view'),
                        target: '_blank',
                    });
                }

                if (this.row.can.update && !this.row.trashed) {
                    actions.push({
                        href: this.adminRoute('edit', this.row.id),
                        label: this.$t('app.action.edit'),
                    });
                }

                if (this.row.can.delete && !this.row.trashed) {
                    actions.push({
                        href: this.adminRoute('destroy', this.row.id),
                        label: this.$t('app.action.delete'),
                        method: 'delete',
                    });
                }

                if (this.row.can.delete && this.row.trashed) {
                    actions.push({
                        href: this.adminRoute('restore', this.row.id),
                        label: this.$t('app.action.restore'),
                        method: 'put',
                    });

                    actions.push({
                        href: this.adminRoute('forceDelete', this.row.id),
                        label: this.$t('app.action.forceDelete'),
                        method: 'delete',
                    });
                }

                return actions.map((action) => {
                    if (!action.hasOwnProperty('method')) {
                        action.method = 'get';
                    }

                    if (!action.hasOwnProperty('target')) {
                        action.target = null;
                    }

                    return action;
                });
            },
        },
        methods: {
            adminRoute(suffix, args) {
                return this.route(
                    this.properties.route_prefix + '.' + suffix,
                    args
                );
            },
        },
    };
</script>
