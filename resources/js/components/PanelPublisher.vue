<template>
    <div class="relative flex flex-col w-full bg-white shadow md:w-64 lg:w-80">
        <div class="flex-1">
            <accordion>
                <template #title> Publish </template>

                <form-datepicker v-model="form.published_at" />
            </accordion>
        </div>

        <div class="px-3 py-3">
            <div class="relative z-0 flex shadow-sm">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="relative inline-flex items-center justify-center flex-1 px-4 py-2 text-sm font-semibold tracking-wider text-white transition duration-150 ease-in-out bg-green-600 border border-transparent focus:outline-none focus:ring-2 focus:ring-offset-2 hover:bg-green-700 focus:ring-green-500 disabled:opacity-50 disabled:cursor-default"
                    v-text="label"
                />

                <dropdown
                    trigger-class="flex items-center justify-center w-full h-full px-2 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent divide-x divide-green-300 hover:bg-green-700 focus:ring-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2"
                    origin="top-right"
                    with-arrow
                >
                    <template #content> other options </template>
                </dropdown>
            </div>
        </div>
    </div>
</template>

<script>
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
        computed: {
            label() {
                return this.$t(`app.action.${this.action}`);
            },
        },
    };
</script>
