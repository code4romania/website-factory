<template>
    <layout :breadcrumbs="breadcrumbs" :title="pageTitle">
        <form @submit.prevent="form.post(route('admin.forms.store'))" class="grid gap-y-8">
            <panel-model action="save" :form="form">
                <localized-field
                    type="form-input"
                    :label="$t('field.title')"
                    name="title"
                    v-model="form.title"
                    required
                />
            </panel-model>

            <block-list v-model:blocks="form.blocks" />
        </form>
    </layout>
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3';

    export default {
        setup(props) {
            const form = useForm('create.form', {});
        },

        data() {
            return {
                form: this.$inertia.form({
                    //
                }),
            };
        },
        computed: {
            pageTitle() {
                return this.$t('form.action.create');
            },
            breadcrumbs() {
                return [
                    {
                        label: this.$t('form.label', 2),
                        href: this.route('admin.forms.index'),
                    },
                ];
            },
        },
    };
</script>
