<template>
    <layout
        :title="$t('form_submission.id', resource)"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
            {
                label: $tChoice('form.label', 2),
                url: route('admin.forms.index'),
            },
            {
                label: resource.form.title,
                url: route('admin.forms.show', resource.form.id),
            },
        ]"
    >
        <dl
            class="relative bg-white shadow shrink-0 sm:divide-y sm:divide-gray-100"
        >
            <div
                v-for="(row, index) in data"
                :key="index"
                class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 even:bg-gray-50"
            >
                <dt
                    class="text-sm font-medium text-gray-500"
                    v-text="row.label"
                />
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <span
                        v-if="[null, '&amp;mdash;'].includes(row.value)"
                        class="text-gray-500"
                    >
                        &mdash;
                    </span>

                    <span v-else v-text="row.value" />
                </dd>
            </div>
        </dl>
    </layout>
</template>

<script>
    import { computed } from 'vue';
    import { trans } from 'laravel-vue-i18n';

    export default {
        props: {
            resource: Object,
        },
        setup(props) {
            const data = computed(() => [
                {
                    label: trans('field.uuid'),
                    value: props.resource.uuid,
                },
                {
                    label: trans('field.created_at'),
                    value: props.resource.created_at,
                },
                ...props.resource.data,
            ]);

            return {
                data,
            };
        },
    };
</script>
