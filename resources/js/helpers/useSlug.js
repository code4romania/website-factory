import { watch } from 'vue';
import slug from 'slug';
export default function (data, source, options = {}) {
    watch(
        source,
        (source) => {
            for (const locale in source) {
                data[locale] = slug(source[locale]);
            }
        },
        { deep: true }
    );

    return data;
}
