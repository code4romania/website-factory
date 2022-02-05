<template>
    <layout :title="$tChoice('person.label', 2)">
        <inertia-table :collection="collection">
            <template #name="{ name, row }">
                <span class="block" v-text="name" />
                <span
                    class="block font-normal text-gray-900"
                    v-text="row.title"
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
