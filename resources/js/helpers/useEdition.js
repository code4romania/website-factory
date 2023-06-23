import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

export default function () {
    const edition = computed(() => usePage().props.app.edition);

    const isNgoSite = computed(() =>
        ['ong', 'internal', 'develop'].includes(edition.value)
    );

    return {
        edition,
        isNgoSite,
    };
}
