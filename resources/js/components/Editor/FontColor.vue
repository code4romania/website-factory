<template>
    <div class="relative overflow-hidden">
        <span
            class="relative inline-flex px-1 py-1 rounded-sm hover:bg-gray-300 focus:bg-gray-300"
        >
            <icon :name="icon" class="w-5 h-5" />

            <icon
                :name="icon"
                class="absolute inset-0 w-5 h-5 m-auto"
                style="clip: rect(0.95rem, 1.25rem, 1.25rem, 0)"
                :style="{
                    color: getColor(),
                }"
            />
        </span>

        <input
            type="color"
            @input="setColor($event.target.value)"
            :value="getColor()"
            class="absolute inset-0 opacity-0"
        />
    </div>
</template>

<script>
    export default {
        name: 'EditorFontColor',
        props: {
            icon: {
                type: String,
                default: null,
            },
            getColor: {
                type: Function,
                required: true,
            },
            setColor: {
                type: Function,
                required: true,
            },
        },
    };
</script>
