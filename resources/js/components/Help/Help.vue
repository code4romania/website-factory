<template>
    <div class="container relative flex justify-end">
        <button
            @click="open = true"
            type="button"
            class="flex items-center justify-center px-4 py-2 text-xs font-medium text-gray-700 border border-t-0 border-gray-300 shadow-sm md:text-sm bg-gray-50 hover:bg-white focus:outline-none focus:ring-inset focus:ring-2 focus:ring-blue-500"
        >
            <span v-text="$t('help.label')" />

            <!-- <icon
                name="System/question-line"
                class="w-4 h-4 shrink-0 ml-1 -mr-1.5 text-gray-500"
            /> -->
        </button>
    </div>

    <transition
        enter-active-class="duration-500 ease-in-out"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="duration-500 ease-in-out"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="open"
            class="fixed inset-0 z-40 transition-opacity bg-gray-500/75"
        />
    </transition>

    <div
        class="fixed inset-0 z-50 flex justify-end max-w-full overflow-hidden pointer-events-none ps-10"
    >
        <transition
            enter-active-class="transition duration-500 ease-in-out transform"
            enter-from-class="translate-x-full"
            enter-to-class="translate-x-0"
            leave-active-class="transition duration-500 ease-in-out transform"
            leave-from-class="translate-x-0"
            leave-to-class="translate-x-full"
        >
            <aside
                v-if="open"
                class="relative z-50 flex flex-col justify-end w-screen h-full max-w-lg bg-white shadow-xl pointer-events-auto"
                ref="panel"
            >
                <button
                    type="button"
                    class="text-gray-300 absolute top-3.5 ltr:-left-8 rtl:-right-8 hover:text-white focus:outline-none focus:ring-2 focus:ring-white"
                    @click="open = false"
                    :title="$t('app.action.close')"
                >
                    <icon name="System/close-line" class="w-5 h-5" />
                </button>

                <div
                    v-if="loading"
                    class="flex items-center justify-center flex-1"
                >
                    <icon
                        name="System/loader-5-line"
                        class="w-20 h-20 text-blue-600 animate-spin"
                        alt="Loading..."
                    />
                </div>

                <template v-if="sections.length">
                    <div class="flex flex-col h-full" v-show="topic === null">
                        <help-list
                            :sections="sections"
                            @topic:open="topic = $event"
                        />
                    </div>

                    <help-topic
                        v-if="topic !== null"
                        :topic="topic"
                        @topic:close="topic = null"
                    />
                </template>
            </aside>
        </transition>
    </div>
</template>

<script>
    import axios from 'axios';
    import { ref, watch } from 'vue';
    import { onClickOutside, onKeyStroke } from '@vueuse/core';
    import { route } from '@/helpers';

    export default {
        name: 'Help',
        setup() {
            const panel = ref(null);
            const open = ref(false);
            const loading = ref(true);
            const sections = ref([]);
            const topic = ref(null);

            const fetchHelp = () => {
                axios.get(route('admin.help')).then((response) => {
                    sections.value = response.data;

                    loading.value = false;
                });
            };

            onClickOutside(panel, () => (open.value = false));
            onKeyStroke('Escape', () => (open.value = false));

            watch(open, (open) => {
                document.body.classList.toggle('overflow-hidden', open);

                if (open && !sections.value.length) {
                    fetchHelp();
                }
            });

            return {
                loading,
                open,
                panel,
                sections,
                topic,
            };
        },
    };
</script>
