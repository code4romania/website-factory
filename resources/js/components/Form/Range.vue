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
        <div class="flex w-full gap-4">
            <input
                class="flex-1 block w-full min-w-0 my-2 border-none focus:outline-none focus:ring-0"
                type="range"
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

            <input
                type="number"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                class="w-16 text-sm"
            />
        </div>
    </form-field>
</template>

<script>
    import { defineInput } from '@/helpers';

    export default defineInput({
        name: 'FormRange',
    });
</script>

