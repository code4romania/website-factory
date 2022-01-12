<template>
    <form-field
        :name="name"
        :label="label"
        :label-for="id"
        :help="help"
        :required="required"
        :disabled="disabled"
        :locale="locale"
    >
        <color-picker
            v-model:pureColor="color"
            disable-history
            disable-alpha
            lang="en"
            @pureColorChange="$emit('update:modelValue', $event)"
        />
    </form-field>
</template>

<script>
    import { ColorPicker } from 'vue3-colorpicker';
    import 'vue3-colorpicker/style.css';

    import { ref } from 'vue';
    import { defineInput } from '@/helpers';

    export default defineInput({
        name: 'FormColorPicker',
        components: {
            ColorPicker,
        },
        props: {
            modelValue: {
                type: String,
                default: '#000',
            },
        },
        setup(props) {
            const color = ref(props.modelValue);

            return { color };
        },
    });
</script>

