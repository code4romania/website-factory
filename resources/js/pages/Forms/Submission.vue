<template>
    <layout
        :title="$t('form.label', 2)"
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
        <dl class="space-y-8">
            <div v-for="(row, index) in data" :key="index">
                <dt
                    class="text-lg font-semibold text-gray-900"
                    v-text="row.label"
                />
                <dd class="text-gray-500" v-text="row.value" />
            </div>
        </dl>
    </layout>
</template>

<script>
    import { computed } from 'vue';

    export default {
        props: {
            resource: Object,
        },
        setup(props) {
            const data = computed(() => [
                {
                    label: 'field.uuid',
                    value: props.resource.uuid,
                },
                {
                    label: 'field.created_at',
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
