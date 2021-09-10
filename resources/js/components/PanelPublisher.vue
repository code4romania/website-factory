<template>
    <div
        class="relative flex flex-col h-full overflow-hidden bg-white shadow w-80"
    >
        <div class="flex-1 px-4 py-5 sm:p-6">
            <slot />
        </div>

        <div class="div">
            <slot name="save" />
        </div>
    </div>
</template>

<script>
    export default {
        name: 'PanelPublisher',
        setup(props) {
            return {};
        },
    };
</script>

