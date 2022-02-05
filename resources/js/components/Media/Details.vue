<template>
    <aside class="px-6 py-8 pb-16 space-y-6 overflow-y-auto bg-white">
        <p
            v-if="!items.length"
            class="text-sm text-gray-500"
            v-text="$tChoice('media.selected', 0)"
        />

        <div v-else-if="items.length > 1" class="">
            <div class="flex items-center justify-between space-x-6 text-sm">
                <p
                    class="text-gray-900"
                    v-text="$tChoice('media.selected', items.length)"
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
                <div class="flex items-center">
                    <h2
                        class="flex-1 font-semibold leading-tight text-gray-900"
                    >
                        {{ item.filename }}.{{ item.extension }}
                    </h2>

                    <button
                        v-if="isSupported"
                        class="inline-flex items-center shrink-0 p-2 ml-2 transition-colors duration-75 bg-white border border-gray-300 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50"
                        @click="copy(item.sizes.original.url)"
                    >
                        <icon
                            v-if="!copied"
                            name="Document/clipboard-line"
                            class="w-4 h-4 text-gray-600"
                        />
                        <icon
                            v-else
                            name="System/check-line"
                            class="w-4 h-4 text-green-600"
                        />
                    </button>
                </div>
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
    import { useClipboard } from '@vueuse/core';

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
            const { isSupported, copy, copied } = useClipboard();

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

                isSupported,
                copy,
                copied,
            };
        },
    };
</script>
