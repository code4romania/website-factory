<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <localized-field
        field="form-editor"
        :label="$t('field.text')"
        v-model="content.text"
    />

    <div class="space-y-1">
        <form-input
            type="text"
            :label="$t('field.paypal_button_id')"
            v-model="content.button_id"
            required
        />

        <a
            href="https://www.paypal.com/donate/buttons/manage"
            target="_blank"
            rel="noopener noreferer"
            class="flex items-center gap-1 text-sm text-gray-500 underline"
        >
            {{ $t('field_help.paypal_button_id') }}

            <icon name="System/external-link-line" class="w-4 h-4" />
        </a>
    </div>
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'donation-paypal',
        icon: 'Logos/paypal-line',
        fields: {
            title: Object,
            text: Object,
            button_id: String,
        },
        feature: 'donations',
    });
</script>
