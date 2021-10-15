<template>
    <form-field
        :name="name"
        :label="label"
        :label-for="id"
        :help="null"
        :required="required"
        :disabled="disabled"
        :locale="locale"
    >
        <flat-pickr
            class="block w-full border-inherit"
            :name="name"
            :id="id"
            :required="required"
            :disabled="disabled"
            :autofocus="autofocus"
            v-bind="$attrs"
            :value="modelValue"
            :config="config"
            @input="emit"
        />
    </form-field>
</template>

<script>
    import flatPickr from 'vue-flatpickr-component';
    import 'flatpickr/dist/flatpickr.css';
    import InputMixin from '@/mixins/input';

    export default {
        name: 'FormDatepicker',
        mixins: [InputMixin],
        inheritAttrs: false,
        components: {
            flatPickr,
        },
        computed: {
            config() {
                return {
                    allowInput: true,
                    enableTime: true,
                    enableSeconds: true,
                    time_24hr: true,
                    defaultDate: new Date(),
                };
            },
        },
        methods: {
            emit(arg) {
                this.$emit('update:modelValue', arg);
                console.log(arg);
                // this.$emit('update:modelValue', arg instanceof InputEvent ? arg.target.value : arg);
            },
        },
    };
</script>

