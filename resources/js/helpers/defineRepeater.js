import camelCase from 'lodash-es/camelCase';
import upperFirst from 'lodash-es/upperFirst';
import { useBlock } from '@/helpers';
export default function (block) {
    return {
        inheritAttrs: false,
        name: 'Repeater' + upperFirst(camelCase(block.type)),
        props: {
            id: {
                type: [String, Number],
                required: true,
            },
            content: {
                type: Object,
                default: () => ({}),
            },
            children: {
                type: Array,
                default: () => [],
            },
            media: {
                type: Array,
                default: () => [],
            },
            parameters: {
                type: Array,
                default: () => [],
            },
            ...block.props,
        },
        emits: [
            'update:content',
            'update:children',
            'update:media',
            'update:related',
        ],
        setup(props, context) {
            const { initializeFields } = useBlock();

            initializeFields(block, props);

            if (
                block.hasOwnProperty('setup') &&
                block.setup instanceof Function
            ) {
                return block.setup(props, context);
            }
        },
    };
}
