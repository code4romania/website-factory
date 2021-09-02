<template>
    <layout slim>
        <template #title>{{ this.$tc('user.label', 2) }}</template>

        <inertia-table
            id="user"
            route-name="admin.users.edit"
            :route-args="{ user: 'id' }"
            empty-action="admin.users.create"
            :collection="users"
        >
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
            users: Object,
        },
    };
</script>
