<template>
    <div class="flex flex-col items-start gap-8 md:flex-row-reverse">
        <div
            class="relative flex flex-col w-full text-sm bg-white divide-y divide-gray-200 shadow md:w-64 lg:w-80"
        >
            <template v-if="!noPublisher">
                <div class="flex items-center justify-between flex-1 px-5 py-4">
                    {{ $t('field.publish') }}

                    <form-toggle v-model="proxyPublished" />
                </div>

                <div v-if="proxyPublished" class="flex-1">
                    <accordion>
                        <template #title>{{
                            $t('field.published_at')
                        }}</template>
                        <template #value>{{ form.published_at }}</template>

                        <form-date-picker v-model="form.published_at" />
                    </accordion>
                </div>
            </template>

            <div class="px-3 py-3">
                <form-button
                    class="w-full"
                    type="submit"
                    :disabled="form.processing"
                    :label="$t(`app.action.${action}`)"
                />
            </div>
        </div>

        <panel class="w-full md:flex-1">
            <div class="space-y-8">
                <slot />
            </div>
        </panel>
    </div>
</template>

<script>
    import { computed } from 'vue';

    export default {
        name: 'PanelModel',
        props: {
            action: {
                type: String,
                required: true,
            },
            form: {
                type: Object,
                required: true,
            },
            noPublisher: {
                type: Boolean,
                default: false,
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
