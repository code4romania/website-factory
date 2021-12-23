import uniqid from 'uniqid';

export default function (field) {
    return {
        ...field,
        inheritAttrs: false,
        props: {
            id: {
                type: String,
                default: () => uniqid('field-id-'),
            },
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
            help: {
                type: String,
                default: null,
            },
            locale: {
                type: String,
                default: null,
            },
            ...field.props,
        },
        emits: [
            'update:modelValue',
            ...(field.emits || [])
        ],
    };
}
