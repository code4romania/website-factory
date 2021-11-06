<template>
    <div class="flex flex-col items-start gap-8 md:flex-row-reverse">
        <panel-publisher :action="action" :form="form" />

        <panel class="w-full md:flex-1">
            <div class="space-y-8">
                <slot />
            </div>
        </panel>
    </div>
</template>

<script>
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
        },
        computed: {
            label() {
                return this.$t(`app.action.${this.action}`);
            },
        },
    };
</script>
