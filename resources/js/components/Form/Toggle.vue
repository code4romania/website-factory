<template>
    <form-field
        :name="name"
        :required="required"
        :disabled="disabled"
        :locale="locale"
    >
        <button
            @click.prevent="checked = !checked"
            type="button"
            :aria-pressed="checked"
            aria-labelledby="toggleLabel"
            class="relative inline-flex flex-shrink-0 h-6 transition-colors duration-200 ease-in-out bg-gray-200 border-2 border-transparent rounded-full cursor-pointer w-11 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600"
            :class="{
                'bg-gray-200': !checked,
                'bg-green-600': checked,
            }"
        >
            <span
                aria-hidden="true"
                :class="checked ? 'translate-x-5' : 'translate-x-0'"
                class="inline-block w-5 h-5 transition duration-200 ease-in-out transform translate-x-0 bg-white rounded-full shadow ring-0"
            />
        </button>
    </form-field>

    <div>
        <div
            class="flex items-center"
            :class="inverse ? 'flex-row-reverse' : ''"
        >
            <div
                class="flex my-1 text-xs leading-tight text-gray-700"
                :class="inverse ? 'mr-2' : 'ml-2'"
                v-text="computedLabel"
            />
        </div>
    </div>
</template>

<script>
    import InputMixin from '@/mixins/input';

    export default {
        name: 'FormToggle',
        mixins: [InputMixin],
        inheritAttrs: false,
        props: {},
        data() {
            return {
                checked: false,
            };
        },
        methods: {
            toggle() {
                this.checked = !this.checked;
            },
        },
        watch: {
            value: {
                immediate: true,
                handler: function (value) {
                    this.checked = value;
                },
            },
            checked(cv) {
                this.$emit('input', cv);
            },
        },
    };
</script>
