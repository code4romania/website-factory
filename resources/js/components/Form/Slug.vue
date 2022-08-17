<template>
    <div
        class="flex items-center max-w-full gap-2 py-px"
        v-if="modelValue && !isEditing"
    >
        <a
            :href="fullUrl"
            target="wf-preview"
            class="py-1 text-sm text-gray-600 hover:underline focus:underline"
            v-text="fullUrl"
        />

        <button
            type="button"
            class="px-1 hover:text-gray-500 focus:ring-gray-50 shrink-0"
            :title="$t('app.action.edit')"
            @click="isEditing = !isEditing"
        >
            <icon name="Design/edit-2-fill" class="w-4 h-4" />
        </button>
    </div>

    <div v-else-if="isEditing" class="flex items-center py-0.5">
        <span class="text-sm text-gray-600" v-text="origin" />

        <input
            type="text"
            :name="name"
            :id="id"
            :disabled="disabled"
            class="flex-1 px-2 py-0.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 border-gray-400 text-gray-600"
            :value="modelValue"
            @input="update($event.target.value)"
            @blur="isEditing = false"
            @keydown.enter="isEditing = false"
        />
    </div>
</template>

<script>
    import slug from 'slug';
    import { computed, ref } from 'vue';
    import { defineInput, route } from '@/helpers';

    export default defineInput({
        name: 'FormSlug',
        props: {
            routeName: {
                type: String,
                required: true,
            },
            routeKey: {
                type: String,
                required: true,
            },
            translatable: {
                type: Boolean,
                default: false,
            },
        },
        setup(props, { emit }) {
            const isEditing = ref(false);

            const fullUrl = computed(() => {
                if (!props.modelValue) {
                    return null;
                }

                return route(props.routeName, {
                    locale: props.locale,
                    [props.routeKey]: props.modelValue,
                });
            });

            const origin = computed(
                () =>
                    route(props.routeName, {
                        locale: props.locale,
                        [props.routeKey]: '',
                    }) + '/'
            );

            const update = (value) => {
                emit('update:modelValue', value ? slug(value) : null);
            };

            return {
                origin,
                fullUrl,
                isEditing,
                update,
            };
        },
    });
</script>

