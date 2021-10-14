<template>
    <div>
        <div class="sm:hidden">
            <select
                class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                v-model="currentType"
            >
                <option
                    v-for="type in types"
                    :key="type"
                    :value="type"
                    v-text="type"
                />
            </select>
        </div>
        <div class="hidden sm:block">
            <div class="flex items-center border-b border-gray-200">
                <div class="flex flex-1 -mb-px space-x-6 xl:space-x-8">
                    <button
                        v-for="type in types"
                        :key="type"
                        type="button"
                        :value="type"
                        class="px-1 py-4 text-sm font-medium border-b-2 whitespace-nowrap"
                        :class="[
                            currentType === type
                                ? 'border-blue-500 text-blue-600'
                                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                        ]"
                        @click="currentType = type"
                        v-text="$t(`media.type.${type}`)"
                        disabled
                    />
                </div>

                <!-- View controls -->
                <div class="hidden ml-6 p-0.5 items-center sm:flex space-x-1">
                    <button
                        type="button"
                        v-for="(view, index) in views"
                        :key="index"
                        class="p-1.5 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 rounded-md"
                        @click="changeView(view.id)"
                        :class="[
                            currentView === view.id
                                ? 'bg-blue-500 text-blue-50 shadow-sm'
                                : 'text-gray-400 hover:bg-blue-400 hover:text-blue-50 hover:shadow-sm',
                        ]"
                        disabled
                    >
                        <icon :name="view.icon" class="w-5 h-5" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { ref, watch } from 'vue';
    export default {
        name: 'MediaManagerControls',
        props: {
            types: {
                type: Array,
                default: () => [],
            },
            currentType: {
                type: String,
                default: 'images',
                validator: (type) => ['images', 'files'].includes(type),
            },
            views: {
                type: Array,
                default: () => [
                    { id: 'list', icon: 'Editor/list-check-2' },
                    { id: 'grid', icon: 'Design/layout-grid-fill' },
                ],
            },
            currentView: {
                type: String,
                default: 'grid',
                validator: (view) => ['list', 'grid'].includes(view),
            },
        },
        emits: ['change-type', 'change-view'],
        setup(props, { emit }) {
            const currentType = ref(props.currentType);

            watch(currentType, (type) => {
                if (type === props.currentType) {
                    return;
                }

                emit('change-type', type);
            });

            const changeView = (view) => {
                if (view === props.currentView) {
                    return;
                }

                emit('change-view', view);
            };

            return {
                currentType,
                changeView,
            };
        },
    };
</script>
