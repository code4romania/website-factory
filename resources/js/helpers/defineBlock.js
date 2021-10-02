import camelCase from 'lodash/camelCase';
import upperFirst from 'lodash/upperFirst';

export default function (block) {
    return {
        name: 'BlockType' + upperFirst(camelCase(block.type)),
        props: {
            content: {
                type: Object,
                default: () => ({}),
            },
            ...block?.props,
        },
        emits: ['update:content'],
        setup(props) {
            const fields = [].concat(block?.fields);

            fields.forEach((field) => {
                if (!props.content.hasOwnProperty(field)) {
                    props.content[field] = {};
                }
            });
        },
    };
}
