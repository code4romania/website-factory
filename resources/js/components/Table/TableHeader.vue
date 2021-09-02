<template>
    <thead class="border-b border-gray-200">
        <tr>
            <table-head
                v-for="column in columns"
                :key="`column-${column.field}`"
                :column="column"
                :current-sort-field="sort.column"
                :current-sort-direction="sort.direction"
            />
        </tr>
    </thead>
</template>

<script>
    export default {
        name: 'TableHeader',
        inheritAttrs: false,
        props: {
            columns: {
                type: Array,
                default: () => [],
            },
            sort: {
                type: Object,
                default: () => ({
                    column: null,
                    direction: null,
                }),
                // validator(sort) {
                //     return (
                //         sort !== null &&
                //         sort.hasOwnProperty('column') &&
                //         sort.column !== null &&
                //         sort.hasOwnProperty('direction') &&
                //         sort.direction !== null
                //     );
                // },
            },
            selectedAll: {
                type: Boolean,
                default: false,
            },
        },
    };
</script>

