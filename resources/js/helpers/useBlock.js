import { defaultValue } from '@/helpers';

export default function () {
    const initializeFields = (block, props) => {
        if (block.hasOwnProperty('fields')) {
            for (const [field, type] of Object.entries(block.fields)) {
                // Skip if already has value
                if (props.content.hasOwnProperty(field)) {
                    continue;
                }

                props.content[field] = defaultValue(type);
            }
        }

        return props;
    };

    return {
        initializeFields,
    };
}
