<template>
    <form-container
        :resource="resource"
        :model="model"
        :fields="['title']"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
            {
                label: $t('page.subnav.pages'),
                url: route('admin.pages.index'),
            },
            {
                label: $t('page.subnav.groups'),
                url: route('admin.page_groups.index'),
            },
        ]"
    >
        <template #subnav>
            <menu-item
                v-for="(item, index) in subnav"
                :key="index"
                :href="route(item.route)"
                class="text-sm"
                class-active="bg-gray-50 text-gray-900"
                class-inactive="text-gray-900 hover:bg-gray-100 hover:text-gray-900"
            >
                {{ $t(item.label) }}
            </menu-item>
        </template>

        <template #panel="{ form }">
            <localized-field
                field="form-input"
                :label="$t('field.title')"
                name="title"
                v-model="form.title"
                required
            />
        </template>
    </form-container>
</template>

<script>
    export default {
        props: {
            resource: Object,
            model: Object,
            subnav: Array,
        },
    };
</script>
