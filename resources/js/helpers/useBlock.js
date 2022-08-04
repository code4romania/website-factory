import { defaultValue, typeOf } from '@/helpers';

export default function () {
    const initializeFields = (block, props) => {
        if (block.hasOwnProperty('fields')) {
            for (const [field, type] of Object.entries(block.fields)) {
                // Skip if already has value and value type matches prop definition
                if (
                    props.content.hasOwnProperty(field) &&
                    typeOf(props.content[field]) === type
                ) {
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
