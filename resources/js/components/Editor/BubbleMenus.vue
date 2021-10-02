<template>
    <bubble-menu
        :class="bubbleMenuClass"
        :editor="editor"
        :should-show="isLinkActive"
    >
        <div>link editing controls</div>
    </bubble-menu>
</template>

<script>
    import { BubbleMenu } from '@tiptap/vue-3';
    import { computed } from 'vue';

    export default {
        name: 'EditorBubbleMenus',
        components: {
            BubbleMenu,
        },
        props: {
            editor: {
                type: Object,
                required: true,
            },
        },

        setup(props) {
            const bubbleMenuClass = computed(
                () => 'px-2 py-1 text-xs bg-white border'
            );

            const isLinkActive = ({ editor }) => editor.isActive('link');

            return {
                bubbleMenuClass,
                isLinkActive,
            };
        },
    };
</script>
