import { usePage } from '@inertiajs/inertia-vue3';

export default function () {
    const hasFeature = (feature) => {
        return (usePage().props.value.app.features || []).includes(feature);
    };

    return {
        hasFeature,
    };
}
