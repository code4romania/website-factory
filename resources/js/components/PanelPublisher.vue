<template>
    <div class="relative flex flex-col w-full h-full bg-white shadow md:w-80">
        <div class="flex-1 px-4 py-5 sm:p-6">
            <slot />
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
                    trigger-class="flex items-center justify-center w-full h-full px-2 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent hover:bg-green-700 focus:ring-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2"
                    origin="top-right"
                >
                    <template #trigger>
                        <img
                            src="remixicon/icons/System/arrow-down-s-line.svg"
                            class="w-4 h-4 fill-current"
                            svg-inline
                        />
                    </template>

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
