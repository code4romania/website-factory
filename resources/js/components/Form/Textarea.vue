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
        <textarea
            class="block w-full overflow-hidden resize-none border-inherit"
            :id="id"
            :name="name"
            :required="required"
            :disabled="disabled"
            :placeholder="placeholder"
            v-bind="$attrs"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            rows="3"
            ref="textarea"
        />
    </form-field>
</template>

<script>
    import { ref, computed, nextTick, onMounted, watch } from 'vue';
    import { defineInput } from '@/helpers';

    export default defineInput({
        name: 'FormTextarea',
        props: {
            minHeight: {
                type: Number,
                default: 90,
            },
            maxHeight: {
                type: Number,
                default: null,
            },
        },
        setup(props) {
            const textarea = ref(null);

            const resize = () => {
                textarea.value.style.height = 'auto';

                nextTick(() => {
                    let contentHeight = textarea.value.scrollHeight - 4;

                    if (props.minHeight && contentHeight < props.minHeight) {
                        contentHeight = props.minHeight;
                    }

                    if (props.maxHeight && contentHeight > props.maxHeight) {
                        contentHeight = props.maxHeight;
                    }

                    textarea.value.style.height = `${contentHeight}px`;
                });
            };

            onMounted(resize);

            watch(
                computed(() => [
                    props.modelValue,
                    props.minHeight,
                    props.maxHeight,
                ]),
                resize
            );

            return {
                textarea,
            };
        },
    });
</script>

