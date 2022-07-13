<template>
    <settings-section>
        <template #fields="{ form }">
            <panel title="General">
                <form-select
                    :label="$t('setting.donations.page.thanks')"
                    name="settings.page.thanks"
                    v-model="form.settings.page.thanks"
                    :options="data.pages.data"
                    option-value-key="id"
                    option-label-key="title"
                    required
                />

                <form-draggable
                    :label="$t('setting.donations.amounts.default')"
                    name="settings.amounts"
                    type="number"
                    v-model="form.settings.amounts"
                />
            </panel>

            <panel title="EuPlătesc">
                <form-checkbox
                    :label="$t('field.enabled')"
                    v-model="form.settings.euplatesc_enabled"
                />

                <form-input
                    field="text"
                    :label="$t('setting.donations.euplatesc.mid')"
                    name="settings.euplatesc.mid"
                    v-model="form.settings.euplatesc_mid"
                />

                <form-input
                    field="text"
                    :label="$t('setting.donations.euplatesc.key')"
                    name="settings.euplatesc.key"
                    v-model="form.settings.euplatesc_key"
                />
            </panel>

            <panel title="Netopia">
                <form-checkbox
                    :label="$t('field.enabled')"
                    v-model="form.settings.mobilpay_enabled"
                />

                <form-input
                    field="text"
                    :label="$t('setting.donations.mobilpay.signature')"
                    name="settings.mobilpay.signature"
                    placeholder="XXXX-XXXX-XXXX-XXXX-XXXX"
                    v-model="form.settings.mobilpay_signature"
                />

                <form-file
                    :label="$t('setting.donations.mobilpay.certificate')"
                    name="settings.mobilpay.certificate"
                    v-model="form.settings.mobilpay_certificate"
                    :accept="['.cer']"
                />

                <form-file
                    :label="$t('setting.donations.mobilpay.private_key')"
                    name="settings.mobilpay.private_key"
                    v-model="form.settings.mobilpay_private_key"
                    :accept="['.key']"
                />
            </panel>
        </template>
    </settings-section>
</template>


<script>
    export default {
        props: {
            data: {
                type: Object,
                default: () => ({}),
            },
        },
    };
</script>
