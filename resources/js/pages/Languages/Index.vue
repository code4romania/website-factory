<template>
    <layout
        :title="$tChoice('language.label', 2)"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
        ]"
    >
        <template #actions>
            <language-restore />
        </template>

        <inertia-table :collection="collection">
            <template #enabled="{ row }">
                <icon
                    v-if="row.enabled"
                    name="System/check-line"
                    class="w-6 h-6 text-green-600"
                />
                <icon
                    v-else
                    name="System/close-line"
                    class="w-6 h-6 text-red-600"
                />
            </template>
        </inertia-table>
    </layout>
</template>

<script>
    export default {
        props: {
            collection: Object,
        },
    };
</script>
