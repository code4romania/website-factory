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
            ...block.props,
        },
        emits: ['update:content'],
        setup(props) {
            // Initialize translatable fields
            [].concat(block?.translatableFields).forEach((field) => {
                if (!props.content.hasOwnProperty(field)) {
                    props.content[field] = {};
                }
            });

            // Initialize untranslatable fields
            [].concat(block?.fields).forEach((field) => {
                if (!props.content.hasOwnProperty(field)) {
                    props.content[field] = null;
                }
            });
        },
    };
}
