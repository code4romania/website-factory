<template>
    <div
        class="relative flex flex-col w-full text-sm bg-white divide-y divide-gray-200 shadow md:w-64 lg:w-80"
    >
        <div class="flex items-center justify-between flex-1 px-5 py-4">
            {{ $t('field.publish') }}

            <form-toggle v-model="proxyPublished" />
        </div>

        <div v-if="proxyPublished" class="flex-1">
            <accordion>
                <template #title>{{ $t('field.published_at') }}</template>
                <template #value>{{ form.published_at }}</template>

                <form-datepicker v-model="form.published_at" />
            </accordion>
        </div>

        <div class="px-3 py-3">
            <form-button
                class="w-full"
                type="submit"
                :disabled="form.processing"
                :label="$t(`app.action.${action}`)"
            />
        </div>
    </div>
</template>

<script>
    import { computed } from 'vue';

    export default {
        name: 'PanelPublisher',
        props: {
            action: {
                type: String,
                required: true,
            },
            form: {
                type: Object,
                required: true,
            },
        },
        setup(props) {
            const proxyPublished = computed({
                get: () => props.form.published_at !== null,
                set: (published) => {
                    props.form.published_at = published
                        ? new Date().toISOString().slice(0, 19).replace('T', ' ')
                        : null;
                },
            });

            return {
                proxyPublished,
            };
        },
    };
</script>
