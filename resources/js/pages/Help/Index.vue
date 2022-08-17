<template>
    <layout
        :title="$tChoice('help.label', 2)"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
        ]"
    >
        <template #subnav>
            <ask-for-help />
        </template>

        <div class="divide-y divide-gray-200">
            <help-chapter
                v-for="(chapter, key) in help"
                :key="key"
                :chapter-key="key"
                :chapter="chapter"
            />
        </div>
    </layout>
</template>

<script>
    export default {
        props: {
            help: Object,
        },
    };
</script>
