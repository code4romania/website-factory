<template>
    <layout
        :title="resource.title"
        :description="resource.description"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
            {
                label: $tChoice('form.label', 2),
                url: route('admin.forms.index'),
            },
        ]"
    >
        <template #actions>
            <a
                v-if="collection.data.length"
                class="relative inline-flex items-center justify-center px-4 py-2 text-sm font-semibold tracking-wider text-white transition duration-150 ease-in-out bg-gray-800 border border-transparent focus:outline-none focus:ring-2 focus:ring-offset-2 hover:bg-gray-700 active:bg-gray-900 focus:border-gray-900"
                :href="route('admin.forms.export', { form: resource.id })"
                download
            >
                <icon
                    name="Document/file-excel-2-fill"
                    class="w-4 h-4 mr-2 -ml-1"
                />

                <span v-text="$t('app.action.export')" />
            </a>

            <inertia-link
                class="relative inline-flex items-center justify-center px-4 py-2 text-sm font-semibold tracking-wider text-white transition duration-150 ease-in-out bg-gray-800 border border-transparent focus:outline-none focus:ring-2 focus:ring-offset-2 hover:bg-gray-700 active:bg-gray-900 focus:border-gray-900"
                :href="route('admin.forms.edit', { form: resource.id })"
                v-text="$t('app.action.edit')"
            />
        </template>

        <inertia-table :collection="collection" disable-create disable-filters>
            <template #id="{ row }">
                {{ $t('form_submission.id', { id: row.id }) }}
            </template>
        </inertia-table>
    </layout>
</template>

<script>
    export default {
        props: {
            collection: Object,
            resource: Object,
            model: Object,
        },
    };
</script>
