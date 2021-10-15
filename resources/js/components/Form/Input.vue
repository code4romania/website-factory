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
        <input
            class="block w-full border-inherit"
            :type="type"
            :name="name"
            :id="id"
            :required="required"
            :disabled="disabled"
            :autofocus="autofocus"
            v-bind="$attrs"
            :value="modelValue"
            @input="emit"
        />
    </form-field>
</template>

<script>
    import InputMixin from '@/mixins/input';

    export default {
        name: 'FormInput',
        mixins: [InputMixin],
        inheritAttrs: false,
        props: {
            type: {
                type: String,
                default: 'text',
            },
        },
    };
</script>

