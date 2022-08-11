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
        <!-- Help content -->
    </layout>
</template>
