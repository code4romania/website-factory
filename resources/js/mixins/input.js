import uniqid from 'uniqid';
export default {
    inheritAttrs: false,
    props: {
        name: {
            type: String,
            default: () => uniqid('field-'),
        },
        modelValue: {
            default: null,
        },
        placeholder: {
            type: String,
            default: null,
        },
        required: {
            type: Boolean,
            default: false,
        },
        readonly: {
            type: Boolean,
            default: false,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        autofocus: {
            type: Boolean,
            default: false,
        },
        label: {
            type: String,
            default: null,
        },
        locale: {
            type: String,
            default: null,
        },
    },

    emits: ['update:modelValue'],

    methods: {
        emit(arg) {
            this.$emit('update:modelValue', arg instanceof InputEvent ? arg.target.value : arg);
        },
    },
};
