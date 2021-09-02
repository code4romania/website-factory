<template>
    <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow sm:p-6">
        <div class="relative">
            <div
                class="absolute z-20 flex items-center justify-center font-medium text-center  inset-4"
                v-text="label"
            />
            <svg
                class="w-full h-64 text-gray-200 bg-white border-2 border-gray-300 border-dashed rounded "
                preserveAspectRatio="none"
                stroke="currentColor"
                fill="none"
                viewBox="0 0 200 200"
                aria-hidden="true"
            >
                <path
                    vector-effect="non-scaling-stroke"
                    stroke-width="2"
                    d="M0 0l200 200M0 200L200 0"
                />
            </svg>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'PanelPlaceholder',
        props: ['label'],
    };
</script>
