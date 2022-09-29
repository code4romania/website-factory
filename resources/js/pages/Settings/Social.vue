<template>
    <settings-section>
        <template #fields="{ form }">
            <panel title="Social Media">
                <form-input
                    v-for="(platform, id) in data.platforms"
                    :key="id"
                    :label="platform.label"
                    :name="`settings.profiles.${id}`"
                    v-model="form.settings.profiles[id]"
                />
            </panel>
        </template>
    </settings-section>
</template>

<script>
    export default {
        props: {
            data: {
                type: Object,
                default: () => ({}),
            },
        },
    };
</script>
