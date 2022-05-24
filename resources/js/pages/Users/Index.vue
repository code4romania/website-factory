<template>
    <layout
        :title="$tChoice('user.label', 2)"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
        ]"
    >
        <inertia-table :collection="collection">
            <template #title="{ title }">
                {{ title }}
            </template>

            <template #role="{ role }">
                <span v-if="role" v-text="$t(`user.role.${role}`)" />
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
