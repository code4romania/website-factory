<template>
    <aside class="px-6 py-8 pb-16 space-y-6 overflow-y-auto bg-white">
        <p
            v-if="!items.length"
            class="text-sm text-gray-500"
            v-text="$t('media.selected', 0)"
        />

        <div v-else-if="items.length > 1" class="">
            <div class="flex items-center justify-between space-x-6 text-sm">
                <p
                    class="text-gray-900"
                    v-text="$t('media.selected', items.length)"
                />

                <button
                    type="button"
                    @click="$emit('clear-selected')"
                    v-text="$t('app.action.clear')"
                    class="text-blue-500 focus:underline hover:underline"
                />
            </div>
        </div>

        <template v-else>
            <img
                :src="item.sizes.thumb.url"
                class="block w-full border border-gray-200"
                :width="item.sizes.thumb.width"
                :height="item.sizes.thumb.height"
                alt=""
            />

            <div>
                <h2 class="font-medium leading-tight text-gray-900">
                    {{ item.filename }}.{{ item.extension }}
                </h2>
                <dl
                    class="mt-2 text-sm font-medium border-t border-b border-gray-200 divide-y divide-gray-200"
                >
                    <div class="flex justify-between py-3">
                        <dt class="text-gray-500">Created</dt>
                        <dd class="text-gray-900" v-text="item.created_at" />
                    </div>

                    <div class="flex justify-between py-3">
                        <dt class="text-gray-500">Last modified</dt>
                        <dd class="text-gray-900" v-text="item.updated_at" />
                    </div>

                    <div class="flex justify-between py-3">
                        <dt class="text-gray-500">File size</dt>
                        <dd class="text-gray-900" v-text="item.size" />
                    </div>

                    <div class="flex justify-between py-3">
                        <dt class="text-gray-500">Dimensions</dt>
                        <dd class="text-gray-900">
                            <span v-text="item.sizes.original.width" />
                            &times;
                            <span v-text="item.sizes.original.height" />
                        </dd>
                    </div>
                </dl>
            </div>

            <localized-field
                field="form-textarea"
                :label="$t('field.description')"
                v-model="item.caption"
                @blur="updateMedia(item.id, item)"
            />
        </template>
    </aside>
</template>

<script>
    import { ref, watch } from 'vue';
    import { useMedia } from '@/helpers';

    export default {
        name: 'MediaDetails',
        props: {
            items: {
                type: Array,
                default: () => [],
            },
        },
        emits: ['clear-selected'],
        setup(props) {
            const { updateMedia } = useMedia();

            const item = ref(null);

            watch(
                () => props.items,
                (items) => {
                    item.value = items.length === 1 ? items[0] : null;
                },
                { deep: true, immediate: true }
            );

            return {
                item,
                updateMedia,
            };
        },
    };
</script>
