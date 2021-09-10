<template>
    <layout :breadcrumbs="breadcrumbs" :title="pageTitle">
        <form
            @submit.prevent="form.put(route('admin.pages.update', page))"
            class="grid gap-y-8"
        >
            <div class="flex flex-col gap-8 md:flex-row-reverse">
                <panel-publisher>
                    <template #save>
                        <form-button type="submit" :disabled="form.processing">
                            Save
                        </form-button>
                    </template>
                </panel-publisher>

                <panel class="flex-1">
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

            <div class="relative flex items-center mt-8" aria-hidden="true">
                <span class="pr-3 text-lg font-medium text-gray-900">
                    Content
                </span>

                <div class="flex-1 border-t border-gray-300" />
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
