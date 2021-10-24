import camelCase from 'lodash/camelCase';
import upperFirst from 'lodash/upperFirst';
import { useBlock } from '@/helpers';
import { ref } from 'vue';

export default function (block) {
    return {
        name: 'BlockItem' + upperFirst(camelCase(block.type)),
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
        emits: ['update:content', 'update:children', 'update:*'],
        setup(props) {
            const { initializeFields } = useBlock();

            initializeFields(block, props);

            const children = ref(props.children);

            return {
                children,
            };
        },
    };
}
