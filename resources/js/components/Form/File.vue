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
        <div class="w-full px-4 py-2 border border-inherit">
            <input
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:shadow-sm file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700"
                type="file"
                :name="name"
                :id="id"
                :required="required"
                :disabled="disabled"
                :autofocus="autofocus"
                :accept="accept.join(',')"
                :multiple="multiple"
                v-bind="$attrs"
                ref="input"
                @change="files = $event.target.files"
            />
        </div>
    </form-field>
</template>

<script>
    import { ref, watch } from 'vue';
    import { defineInput } from '@/helpers';

    export default defineInput({
        name: 'FormFile',
        props: {
            accept: {
                type: Array,
                default: () => [],
            },
            multiple: {
                type: Boolean,
                default: false,
            },
        },
        setup(props, { emit }) {
            const files = ref([]);
            const input = ref(null);

            const openFilePicker = () => {
                input.value.click();
            };

            watch(
                files,
                () =>
                    emit(
                        'update:modelValue',
                        props.multiple ? files.value : files.value[0] || null
                    ),
                {
                    immediate: true,
                }
            );

            return {
                files,
                input,
                openFilePicker,
            };
        },
    });
</script>

