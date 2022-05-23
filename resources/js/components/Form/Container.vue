<template>
    <layout :title="$t(`${model.name}.action.${action}`)">
        <template #subnav>
            <slot name="subnav" />
        </template>

        <form @submit.prevent="form.submit(method, url)" class="grid gap-y-8">
            <div class="flex flex-col items-start gap-8 md:flex-row-reverse">
                <div
                    class="relative flex flex-col w-full text-sm bg-white divide-y divide-gray-200 shadow md:w-64 lg:w-80"
                >
                    <template v-if="publishable">
                        <div
                            class="flex items-center justify-between flex-1 px-5 py-4"
                        >
                            {{ $t('field.publish') }}

                            <form-toggle v-model="proxyPublished" />
                        </div>

                        <div v-if="proxyPublished" class="flex-1">
                            <accordion>
                                <template #title>
                                    {{ $t('field.published_at') }}
                                </template>

                                <template #value>
                                    {{ form.published_at }}
                                </template>

                                <form-date-picker
                                    v-model="form.published_at"
                                    :default-date="new Date()"
                                    enable-time
                                />
                            </accordion>
                        </div>
                    </template>

                    <div class="px-3 py-3">
                        <form-button
                            class="w-full"
                            type="submit"
                            :disabled="form.processing"
                            :label="$t('app.action.save')"
                        />
                    </div>
                </div>

                <div class="w-full space-y-8 md:flex-1">
                    <panel>
                        <slot name="panel" :form="form" />
                    </panel>

                    <slot name="extra" :form="form" />
                </div>
            </div>

            <slot name="content" :form="form" />
        </form>
    </layout>
</template>

<script>
    import { computed } from 'vue';
    import { useForm, route } from '@/helpers';

    export default {
        name: 'FormContainer',
        props: {
            resource: {
                type: Object,
                required: false,
            },
            model: {
                type: Object,
                required: true,
            },
            fields: {
                type: Array,
                default: () => [],
            },
            fieldTypes: {
                type: Object,
                default: () => ({}),
            },
        },
        setup(props) {
            const action = computed(() =>
                props.resource === undefined ? 'create' : 'edit'
            );

            const form = useForm(
                `${action.value}.${props.model.name}`,
                props.resource,
                props.fields,
                props.fieldTypes
            );

            const method = computed(() =>
                action.value === 'edit' ? 'put' : 'post'
            );

            const adminRoute = (suffix, params) =>
                route(`${props.model.admin_route_prefix}.${suffix}`, params);

            const url = computed(() =>
                action.value === 'edit'
                    ? adminRoute('update', props.resource)
                    : adminRoute('store')
            );

            const publishable = computed(() => form.hasOwnProperty('published_at'));

            const proxyPublished = computed({
                get: () => publishable.value && form.published_at !== null,
                set: (published) => {
                    if (!publishable.value) {
                        return;
                    }

                    form.published_at = published
                        ? new Date().toISOString().slice(0, 19).replace('T', ' ')
                        : null;
                },
            });

            return {
                action,
                form,
                method,
                url,

                publishable,
                proxyPublished,
            };
        },
    };
</script>
