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
        <input
            class="block w-full border-inherit"
            :type="type"
            :name="name"
            :id="id"
            :required="required"
            :disabled="disabled"
            :autofocus="autofocus"
            :placeholder="placeholder"
            v-bind="$attrs"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
        />
    </form-field>
</template>

<script>
    import { defineInput } from '@/helpers';

    export default defineInput({
        name: 'FormInput',
        props: {
            type: {
                type: String,
                default: 'text',
            },
        },
    });
</script>

