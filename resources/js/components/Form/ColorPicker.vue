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
        <div class="relative">
            <button
                type="button"
                class="w-10 h-6 border"
                :style="{ backgroundColor: modelValue }"
                @click="open = !open"
            />

            <twitter
                v-if="open"
                v-click-away="() => (open = false)"
                class="!absolute top-full z-50"
                v-model="color"
            />
        </div>
    </form-field>
</template>

<script>
    import { Twitter } from '@ckpack/vue-color';

    import { ref, watch } from 'vue';
    import { defineInput } from '@/helpers';

    export default defineInput({
        name: 'FormColorPicker',
        components: {
            Twitter,
        },
        props: {
            modelValue: {
                type: String,
                default: '#000',
            },
        },
        setup(props, { emit }) {
            const open = ref(false);

            const color = ref(props.modelValue);

            watch(color, (color) => emit('update:modelValue', color.hex));

            return {
                color,
                open,
            };
        },
    });
</script>

