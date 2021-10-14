<template>
    <aside class="p-8 pb-16 space-y-6 overflow-y-auto bg-white">
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
                    type="b=utton"
                    class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    @click="$emit('delete-selected')"
                    v-text="$t('app.action.delete')"
                />
            </div>
        </div>

        <template v-else>
            <div
                class="block w-full overflow-hidden border border-gray-200 group aspect-w-1 aspect-h-1"
            >
                <img
                    :src="item.urls.thumb"
                    class="object-cover object-center"
                    alt=""
                />
            </div>

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
                </dl>
            </div>

            <div>
                <h3 class="font-medium text-gray-900">Description</h3>
                <div class="flex items-center justify-between mt-2">
                    <p class="text-sm italic text-gray-500">
                        Add a description to this image.
                    </p>
                    <button
                        type="button"
                        class="flex items-center justify-center w-8 h-8 text-gray-400 bg-white rounded-full hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        title="Add description"
                    >
                        <icon name="Design/pencil-fill" class="w-5 h-5" />
                    </button>
                </div>
            </div>

            <div class="flex">
                <a
                    :href="item.urls.original"
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
    import { computed } from 'vue';

    export default {
        name: 'MediaDetails',
        props: {
            items: {
                type: Array,
                default: () => [],
            },
        },
        emits: ['clear-selected', 'delete-selected'],
        setup(props, { emit }) {
            const item = computed(() => {
                if (props.items.length !== 1) {
                    return null;
                }

                return props.items[0];
            });

            return {
                item,
            };
        },
    };
</script>
