<template>
    <form-field
        :name="name"
        :label="$t('field.icon')"
        :label-for="id"
        :help="help"
        :required="required"
        :disabled="disabled"
        :locale="locale"
    >
        <select
            class="block w-full border-inherit"
            :id="id"
            :required="required"
            :disabled="disabled"
            :autofocus="autofocus"
            v-bind="$attrs"
            v-model="proxySelected"
        >
            <option :value="null">&mdash;</option>

            <optgroup
                v-for="({ group, icons }, groupIndex) in iconGroups"
                :key="groupIndex"
                :label="group"
            >
                <option
                    v-for="icon in icons"
                    :key="icon"
                    :value="icon"
                    v-text="icon"
                />
            </optgroup>
        </select>
    </form-field>
</template>

<script>
    import { computed } from 'vue';
    import { defineInput } from '@/helpers';
    import icons from '@/icons';

    export default defineInput({
        name: 'FormIconPicker',
        setup(props, { emit }) {
            const iconGroups = computed(() => icons);

            const proxySelected = computed({
                get: () => props.modelValue,
                set: (selected) => emit('update:modelValue', selected),
            });

            return {
                iconGroups,
                proxySelected,
            };
        },
    });
</script>

