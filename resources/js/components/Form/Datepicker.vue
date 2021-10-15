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
            @input="$emit('update:modelValue', $event)"
        />
    </form-field>
</template>

<script>
    import flatPickr from 'vue-flatpickr-component';
    import 'flatpickr/dist/flatpickr.css';
    import { computed } from 'vue';
    import { defineInput } from '@/helpers';

    export default defineInput({
        name: 'FormDatepicker',
        components: {
            flatPickr,
        },
        setup(props) {
            const config = computed(() => ({
                allowInput: true,
                enableTime: true,
                enableSeconds: true,
                time_24hr: true,
                defaultDate: new Date(),
            }));

            return {
                config,
            };
        },
    });
</script>

