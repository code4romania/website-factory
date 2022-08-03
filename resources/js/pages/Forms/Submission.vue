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
        <div class="bg-white shadow shrink-0">
            <div class="relative sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-100">
                    <div
                        v-for="(row, index) in data"
                        :key="index"
                        class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4"
                        :class="{
                            'bg-gray-50': index % 2 !== 0,
                        }"
                    >
                        <dt
                            class="text-sm font-medium text-gray-500"
                            v-text="row.label"
                        />
                        <dd
                            class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            v-text="row.value"
                        />
                    </div>
                </dl>
            </div>
        </div>
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
