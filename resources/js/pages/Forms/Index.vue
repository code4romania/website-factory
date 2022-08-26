<template>
    <layout
        :title="$tChoice('form.label', 2)"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
        ]"
    >
        <inertia-table :collection="collection">
            <template #submissions="{ row }">
                <div class="flex">
                    <icon
                        v-if="row.store_submissions"
                        name="System/check-line"
                        class="w-6 h-6 text-green-600 shrink-0"
                    />
                    <icon
                        v-else
                        name="System/close-line"
                        class="w-6 h-6 text-red-600 shrink-0"
                    />

                    <div class="flex-1 ml-1">
                        <span v-text="$t('field.store_submissions')" />

                        <template
                            v-if="
                                row.store_submissions ||
                                row.submissions_count > 0
                            "
                        >
                            (<inertia-link
                                :href="route('admin.forms.show', row.id)"
                                class="text-blue-800 hover:underline whitespace-nowrap"
                                v-text="
                                    $tChoice(
                                        '{0} 0 răspunsuri|{1} :count răspuns|[2,*] :count răspunsuri',
                                        row.submissions_count
                                    )
                                "
                            />)
                        </template>
                    </div>
                </div>

                <div class="flex items-center mt-1">
                    <icon
                        v-if="row.send_submissions"
                        name="System/check-line"
                        class="w-6 h-6 text-green-600 shrink-0"
                    />
                    <icon
                        v-else
                        name="System/close-line"
                        class="w-6 h-6 text-red-600 shrink-0"
                    />

                    <span
                        class="flex-1 ml-1"
                        v-text="$t('field.send_submissions')"
                    />
                </div>
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
