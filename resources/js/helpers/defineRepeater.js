import camelCase from 'lodash/camelCase';
import upperFirst from 'lodash/upperFirst';
import { useBlock } from '@/helpers';
export default function (block) {
    return {
        inheritAttrs: false,
        name: 'Repeater' + upperFirst(camelCase(block.type)),
        props: {
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
            ...block.props,
        },
        emits: [
            'update:content',
            'update:children',
            'update:media',
            'update:related',
        ],
        setup(props) {
            const { initializeFields } = useBlock();

            initializeFields(block, props);
        },
    };
}
