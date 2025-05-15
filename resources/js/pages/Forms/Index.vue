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

                        <span
                            v-if="
                                row.store_submissions ||
                                row.submissions_count > 0
                            "
                            class="whitespace-nowrap"
                        >
                            (<inertia-link
                                :href="route('admin.forms.show', row.id)"
                                class="inline-block text-blue-800 hover:underline"
                                v-text="
                                    $tChoice(
                                        'form_submission.count',
                                        row.submissions_count
                                    )
                                "
                            />)
                        </span>
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
