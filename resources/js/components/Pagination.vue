<template>
    <nav
        v-if="hasPages"
        class="flex items-center justify-between px-4 border-t border-gray-200 sm:px-0"
    >
        <div class="flex flex-1 w-0 -mt-px">
            <inertia-link
                v-if="prevPage"
                :href="prevPage"
                class="inline-flex items-center pt-4 pr-1 space-x-3 text-sm font-medium text-gray-500 border-t-2 border-transparent hover:text-gray-700 hover:border-gray-300"
            >
                <img
                    src="remixicon/icons/System/arrow-left-line.svg"
                    class="w-5 h-5 text-gray-400 fill-current"
                    svg-inline
                />

                <span v-text="$t('pagination.previous')" />
            </inertia-link>
        </div>

        <div class="hidden md:-mt-px md:flex">
            <template v-for="(page, index) in pages">
                <inertia-link
                    v-if="!page.active && page.url"
                    :key="`link-${index}`"
                    class="inline-flex items-center px-4 pt-4 text-sm font-medium text-gray-500 border-t-2 border-transparent hover:text-gray-700 hover:border-gray-300"
                    :href="page.url"
                    v-text="page.label"
                />

                <span
                    v-if="!page.active && !page.url"
                    :key="`ellipsis-${index}`"
                    class="inline-flex items-center px-4 pt-4 text-sm font-medium text-gray-500 border-t-2 border-transparent"
                    v-text="page.label"
                />

                <span
                    v-if="page.active"
                    :key="`span-${index}`"
                    aria-current="page"
                    class="inline-flex items-center px-4 pt-4 text-sm font-medium text-blue-600 border-t-2 border-blue-500"
                    v-text="page.label"
                />
            </template>
        </div>

        <div class="flex justify-end flex-1 w-0 -mt-px">
            <inertia-link
                v-if="nextPage"
                :href="nextPage"
                class="inline-flex items-center pt-4 pl-1 space-x-3 text-sm font-medium text-gray-500 border-t-2 border-transparent hover:text-gray-700 hover:border-gray-300"
            >
                <span v-text="$t('pagination.next')" />

                <img
                    src="remixicon/icons/System/arrow-right-line.svg"
                    class="w-5 h-5 text-gray-400 fill-current"
                    svg-inline
                />
            </inertia-link>
        </div>
    </nav>
</template>

<script>
    export default {
        name: 'Pagination',
        props: {
            meta: {
                type: Object,
                required: true,
            },
            maxVisibleButtons: {
                type: Number,
                required: false,
                default: 3,
            },
        },
        computed: {
            baseStyle() {
                return 'relative inline-flex items-center justify-center w-10 h-10 p-2 text-sm font-semibold leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300';
            },
            hoverStyle() {
                return 'hover:bg-gray-50 focus:outline-none focus:bg-blue-50 hover:text-blue-500 focus:text-blue-500';
            },
            pageStyle() {
                return '-ml-px';
            },
            hasPages() {
                if (this.meta.total === 0) {
                    return false;
                }

                if (this.meta.total <= this.meta.per_page) {
                    return false;
                }

                return true;
            },
            pages() {
                return this.pagination(
                    this.meta.current_page,
                    this.meta.last_page
                ).map((page) => {
                    if (page === '...') {
                        return {
                            url: null,
                            label: page,
                            active: false,
                        };
                    } else {
                        return {
                            url: this.pageUrl(page),
                            label: page,
                            active: page === this.meta.current_page,
                        };
                    }
                });
            },
            prevPage() {
                if (this.meta.current_page - 1 >= 1) {
                    return this.pageUrl(this.meta.current_page - 1);
                }

                return false;
            },
            nextPage() {
                if (this.meta.current_page + 1 <= this.meta.last_page) {
                    return this.pageUrl(this.meta.current_page + 1);
                }

                return false;
            },
        },
        methods: {
            pageUrl(page) {
                let params = new URLSearchParams(location.search);

                params.set('page', page);

                return this.meta.path + '?' + params.toString();
            },
            separate(a, b) {
                return [
                    a,
                    ...({
                        0: [],
                        1: [b],
                    }[b - a] || ['...', b]),
                ];
            },
            pagination(currentPage, pageCount) {
                return Array(this.maxVisibleButtons * 2 + 1)
                    .fill()
                    .map((_, index) => currentPage - this.maxVisibleButtons + index)
                    .filter((page) => 0 < page && page <= pageCount)
                    .flatMap((page, index, { length }) => {
                        if (!index) {
                            return this.separate(1, page);
                        }

                        if (index === length - 1) {
                            return this.separate(page, pageCount);
                        }

                        return [page];
                    });
            },
        },
    };
</script>
