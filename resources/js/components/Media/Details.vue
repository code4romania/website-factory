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

            <div class="flex mt-4">
                <button
                    type="button"
                    class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    @click="$emit('delete-selected')"
                    v-text="$t('app.action.delete')"
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

            <div class="flex">
                <a
                    :href="item.sizes.original.url"
                    class="flex-1 px-4 py-2 text-sm font-medium text-center text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    download
                    v-text="$t('app.action.download')"
                />

                <button
                    type="button"
                    class="flex-1 px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    @click="$emit('delete-selected')"
                    v-text="$t('app.action.delete')"
                />
            </div>
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
        emits: ['clear-selected', 'delete-selected'],
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
