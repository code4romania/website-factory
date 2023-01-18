import { usePage } from '@inertiajs/vue3';

export default function () {
    const hasFeature = (feature) => {
        return (usePage().props.app.features || []).includes(feature);
    };

    return {
        hasFeature,
    };
}
