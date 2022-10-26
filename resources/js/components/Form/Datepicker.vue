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
        <flat-pickr
            class="block w-full border-inherit"
            :name="name"
            :id="id"
            :required="required"
            :disabled="disabled"
            :autofocus="autofocus"
            v-bind="$attrs"
            :model-value="modelValue"
            :config="config"
            @input="$emit('update:modelValue', $event.target.value)"
        />
    </form-field>
</template>

<script>
    import flatPickr from 'vue-flatpickr-component';
    import { Romanian } from 'flatpickr/dist/l10n/ro.js';
    import 'flatpickr/dist/themes/airbnb.css';
    import { computed } from 'vue';
    import { defineInput, useLocale } from '@/helpers';

    export default defineInput({
        name: 'FormDatePicker',
        components: {
            flatPickr,
        },
        props: {
            enableTime: {
                type: Boolean,
                default: false,
            },
            minDate: {
                type: [Date, String],
                default: null,
            },
            maxDate: {
                type: [Date, String],
                default: null,
            },
            defaultDate: {
                type: Date,
                default: null,
            },
        },
        setup(props) {
            const { isCurrentLocale } = useLocale();

            const config = computed(() => ({
                allowInput: true,
                enableTime: props.enableTime,
                enableSeconds: true,
                time_24hr: true,
                altInput: true,
                altFormat: 'd.m.Y' + (props.enableTime ? ' H:i:S' : ''),
                dateFormat: 'Y-m-d' + (props.enableTime ? ' H:i:S' : ''),
                defaultDate: props.defaultDate,
                locale: isCurrentLocale('ro') ? Romanian : { firstDayOfWeek: 1 },
            }));

            return {
                config,
            };
        },
    });
</script>

