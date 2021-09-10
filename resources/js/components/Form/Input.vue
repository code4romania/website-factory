<template>
    <form-field
        :name="name"
        :label="label"
        :label-for="name"
        :help-text="null"
        :required="required"
        :disabled="disabled"
        :locale="locale"
    >
        <input
            class="block w-full border-gray-400"
            :type="type"
            :name="name"
            :id="name"
            :required="required"
            :disabled="disabled"
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
        props: {
            type: {
                type: String,
                default: 'text',
            },
        },
    };
</script>

