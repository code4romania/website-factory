<template>
    <div
        v-if="hasMultipleLocales"
        class="relative inline-flex overflow-visible leading-none border border-gray-300 divide-x divide-gray-300 shadow-sm"
    >
        <button
            type="button"
            v-for="({ name }, locale) in locales"
            :key="locale"
            @click="changeLocale(locale)"
            class="relative flex items-center px-4 py-3 text-xs font-medium leading-none uppercase transition-colors duration-75 focus:z-10 focus:outline-none"
            :class="[
                isCurrentLocale(locale)
                    ? 'bg-gray-100'
                    : 'bg-white hover:bg-gray-50 focus:bg-gray-200',
            ]"
            :title="name"
        >
            <svg
                viewBox="0 0 8 8"
                class="-ml-1 mr-1.5 h-2 w-2"
                :class="[
                    isActiveLocale(locale) ? 'fill-green-600' : 'fill-gray-400',
                ]"
            >
                <circle cx="4" cy="4" r="3" />
            </svg>

            <span
                v-text="locale"
                :class="[
                    isActiveLocale(locale) ? 'text-gray-800' : 'text-gray-400',
                ]"
            />
        </button>
    </div>
</template>

<script>
    import { useLocale } from '@/helpers';

    export default {
        name: 'LanguageSwitcher',
        setup(props) {
            const {
                hasMultipleLocales,
                locales,
                isActiveLocale,
                isCurrentLocale,
                changeLocale,
            } = useLocale(props);

            return {
                hasMultipleLocales,
                locales,
                isActiveLocale,
                isCurrentLocale,
                changeLocale,
            };
        },
    };
</script>

