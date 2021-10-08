export default function () {
    const defaultValue = (type) => {
        const match = type.toString().match(/^\s*function (\w+)/);
        type = match ? match[1] : '';

        return (
            {
                Array: [],
                Boolean: false,
                Date: new Date(),
                Number: 0,
                Object: {},
                String: null,
            }[type] || null
        );
    };

    const initializeFields = (block, props) => {
        // Nothing to initialize
        if (!block.hasOwnProperty('fields')) {
            return;
        }

        for (const [field, type] of Object.entries(block.fields)) {
            // Skip if already has value
            if (props.content.hasOwnProperty(field)) {
                continue;
            }

            props.content[field] = defaultValue(type);
        }
    };

    return {
        defaultValue,
        initializeFields,
    };
}
