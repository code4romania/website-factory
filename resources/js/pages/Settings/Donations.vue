<template>
    <settings-section>
        <template #settings="{ form }">
            <form-checkbox
                :label="$t('setting.donations.mobilpay.enabled')"
                v-model="form.settings.mobilpay_enabled"
            />

            <form-input
                field="text"
                :label="$t('setting.donations.mobilpay.signature')"
                name="settings.mobilpay.signature"
                v-model="form.settings.mobilpay_signature"
            />

            <form-file
                :label="$t('setting.donations.mobilpay.public_key')"
                name="settings.mobilpay.public_key"
                v-model="form.settings.mobilpay_public_key"
                :accept="['.cer']"
            />

            <form-file
                :label="$t('setting.donations.mobilpay.private_key')"
                name="settings.mobilpay.private_key"
                v-model="form.settings.mobilpay_private_key"
                :accept="['.key']"
            />
        </template>
    </settings-section>
</template>

