export default function () {
    const defaultValue = (type) => {
        const match = type.toString().match(/^\s*function (\w+)/);
        type = match ? match[1] : '';

        try {
            return {
                Array: [],
                Boolean: false,
                Date: new Date(),
                Number: 0,
                Object: {},
                String: null,
            }[type];
        } catch (e) {
            return null;
        }
    };

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
        defaultValue,
        initializeFields,
    };
}
