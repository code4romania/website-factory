<template>
    <layout slim>
        <template #title>{{ this.$tc('form.label', 2) }}</template>

        <inertia-table
            id="form"
            route-name="admin.forms.edit"
            :route-args="{ form: 'id' }"
            empty-action="admin.forms.create"
            :collection="forms"
        >
            <template #title="{ title }">
                {{ title }}
            </template>
        </inertia-table>
    </layout>
</template>

<script>
    export default {
        props: {
            forms: Object,
        },
    };
</script>
