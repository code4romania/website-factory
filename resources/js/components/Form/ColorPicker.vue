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

            <sketch
                v-if="open"
                v-click-away="() => (open = false)"
                class="!absolute top-full z-50"
                v-model="color"
                :disable-alpha="disableAlpha"
            />
        </div>
    </form-field>
</template>

<script>
    import { Sketch } from '@ckpack/vue-color';
    import { ref, computed } from 'vue';
    import { defineInput } from '@/helpers';

    export default defineInput({
        name: 'FormColorPicker',
        components: {
            Sketch,
        },
        props: {
            modelValue: {
                type: String,
                default: null,
            },
            disableAlpha: {
                type: Boolean,
                default: false,
            },
        },
        setup(props, { emit }) {
            const open = ref(false);

            const color = computed({
                get: () => props.modelValue || '#000000',
                set: (color) => {
                    emit(
                        'update:modelValue',
                        !props.disableAlpha && color.a < 1 ? color.hex8 : color.hex
                    );
                },
            });

            return {
                color,
                open,
            };
        },
    });
</script>

