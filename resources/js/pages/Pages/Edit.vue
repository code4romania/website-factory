<template>
    <layout :breadcrumbs="breadcrumbs" :title="pageTitle">
        <form
            @submit.prevent="form.put(route('admin.pages.update', page))"
            class="grid gap-y-8"
        >
            <div class="flex flex-col gap-8 md:flex-row-reverse">
                <panel-publisher action="save" :form="form" />

                <panel class="md:flex-1">
                    <div class="space-y-8">
                        <localized-field
                            type="form-input"
                            label="Title"
                            name="title"
                            v-model="form.title"
                            required
                        />
                    </div>
                </panel>
            </div>

            <block-list v-model:blocks="form.blocks" />
        </form>
    </layout>
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3';
    import LocaleMixin from '@/mixins/locale';
    import cloneDeep from 'lodash/cloneDeep';

    export default {
        mixins: [LocaleMixin],
        props: {
            page: Object,
        },
        setup(props) {
            const form = useForm(
                /* `EditPage:${props.page.id}`, */ {
                    title: cloneDeep(props.page.title),
                    blocks: cloneDeep(props.page.blocks),
                }
            );

            return {
                form,
            };
        },

        computed: {
            pageTitle() {
                return this.$t('page.action.edit');
            },
            breadcrumbs() {
                return [
                    {
                        label: this.$tc('page.label', 2),
                        href: this.route('admin.pages.index'),
                    },
                ];
            },
        },
    };
</script>
