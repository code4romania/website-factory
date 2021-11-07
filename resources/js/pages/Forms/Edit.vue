<template>
    <layout :breadcrumbs="breadcrumbs" :title="pageTitle">
        <form
            @submit.prevent="form.put(route('admin.forms.update', resource))"
            class="grid gap-y-8"
        >
            <panel-model action="save" :form="form">
                <localized-field
                    field="form-input"
                    :label="$t('field.title')"
                    name="title"
                    v-model="form.title"
                    required
                />
            </panel-model>
        </form>
    </layout>
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3';

    export default {
        props: {
            resource: Object,
        },
        setup(props) {
            const form = useForm(
                /* `edit.form.${props.resource.id}`, */ {
                    title: props.resource.title,
                    blocks: props.resource.blocks,
                }
            );

            return {
                form,
            };
        },
        computed: {
            pageTitle() {
                return this.$t('form.action.edit');
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
