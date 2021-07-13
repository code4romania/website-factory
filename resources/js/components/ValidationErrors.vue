<template>
    <div v-if="hasErrors">
        <div class="font-medium text-red-600">
            Whoops! Something went wrong.
        </div>

        <ul class="mt-3 text-sm text-red-600 list-disc list-inside">
            <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'ValidationErrors',
        computed: {
            errors() {
                return this.$page.props.errors;
            },

            hasErrors() {
                return Object.keys(this.errors).length > 0;
            },
        },
    };
</script>
