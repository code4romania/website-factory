<template>
    <form-field
        :name="name"
        :required="required"
        :disabled="disabled"
        :locale="locale"
    >
        <button
            @click.prevent="$emit('update:modelValue', !modelValue)"
            type="button"
            :aria-pressed="modelValue"
            class="relative inline-flex h-6 transition-colors duration-200 ease-in-out border-2 border-transparent rounded-full cursor-pointer shrink-0 w-11 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600"
            :class="modelValue ? 'bg-blue-600' : 'bg-gray-200'"
        >
            <span
                aria-hidden="true"
                :class="
                    modelValue
                        ? 'ltr:translate-x-5 rtl:-translate-x-5'
                        : 'translate-x-0'
                "
                class="inline-block w-5 h-5 transition duration-200 ease-in-out transform bg-white rounded-full shadow ring-0"
            />
        </button>

        <div v-if="label" class="flex items-center">
            <div
                class="flex my-1 ml-2 text-xs leading-tight text-gray-700"
                v-text="label"
            />
        </div>
    </form-field>
</template>

<script>
    import { defineInput } from '@/helpers';

    export default defineInput({
        name: 'FormToggle',
        props: {
            modelValue: {
                type: Boolean,
                default: false,
            },
        },
    });
</script>
