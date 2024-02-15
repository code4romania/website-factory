<template>
    <form-container
        :resource="resource"
        :model="model"
        :fields="['code', 'name', 'enabled', 'lines']"
        :field-types="{
            enabled: Boolean,
            lines: Array,
        }"
        :breadcrumbs="[
            {
                label: $t('app.dashboard'),
                url: route('admin.dashboard'),
            },
            {
                label: $tChoice('language.label', 2),
                url: route('admin.languages.index'),
            },
        ]"
        hide-language-switcher
    >
        <template #panel="{ form }">
            <form-select
                :label="$tChoice('language.label', 1)"
                name="code"
                v-model="form.code"
                :options="languages"
                option-value-key="code"
                option-label-key="name"
                required
            />

            <form-switch :label="$t('field.enabled')" v-model="form.enabled" />
        </template>

        <template #content="{ form }">
            <table v-if="resource" class="min-w-full divide-y divide-gray-300">
                <thead>
                    <tr>
                        <th
                            scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0"
                        >
                            Key
                        </th>

                        <th
                            scope="col"
                            class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900"
                        >
                            Translation
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr v-for="(line, key) in source" :key="key">
                        <td
                            class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6 md:pl-0"
                            v-text="key"
                        />

                        <td class="px-3 py-4">
                            <form-input
                                type="text"
                                v-model="form.lines[key]"
                                :dir="resource.direction"
                            />

                            <p
                                class="mt-1 text-sm text-gray-500"
                                v-text="line"
                            />
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
    </form-container>
</template>

<script>
    export default {
        props: {
            resource: Object,
            source: Object,
            model: Object,
            languages: Array,
        },
    };
</script>
