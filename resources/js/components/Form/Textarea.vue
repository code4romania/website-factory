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
        <textarea
            class="block w-full overflow-hidden resize-none border-inherit"
            :id="name"
            :name="name"
            :required="required"
            :disabled="disabled"
            v-bind="$attrs"
            :value="modelValue"
            @input="emit"
            rows="3"
            ref="textarea"
        />
    </form-field>
</template>

<script>
    import InputMixin from '@/mixins/input';
    import { ref, computed, nextTick, onMounted, watch } from 'vue';

    export default {
        name: 'FormTextarea',
        mixins: [InputMixin],
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
                computed(() => [props.modelValue, props.minHeight, props.maxHeight]),
                resize
            );

            return {
                textarea,
                resize,
            };
        },
    };
</script>

