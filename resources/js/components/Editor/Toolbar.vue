<template>
    <div v-if="editor" class="flex flex-wrap -mt-px border-b divide-x divide-gray-300 bg-gray-50">
        <div class="px-2 py-1 space-x-1 border-t" v-for="(buttons, index) in items" :key="`toolbar-${index}`">
            <editor-button v-for="button in buttons" :key="`toolbar-${index}-${button.name}`" v-bind="button" />
        </div>
    </div>
</template>

<script>
    import IconAlignLeft from 'remixicon/icons/Editor/align-left.svg';
    import IconAlignCenter from 'remixicon/icons/Editor/align-center.svg';
    import IconAlignRight from 'remixicon/icons/Editor/align-right.svg';
    import IconAlignJustify from 'remixicon/icons/Editor/align-justify.svg';
    import IconBlockquote from 'remixicon/icons/Editor/double-quotes-l.svg';
    import IconBold from 'remixicon/icons/Editor/bold.svg';
    import IconBulletList from 'remixicon/icons/Editor/list-unordered.svg';
    import IconFormatClear from 'remixicon/icons/Editor/format-clear.svg';
    import IconHeading1 from 'remixicon/icons/Editor/h-1.svg';
    import IconHeading2 from 'remixicon/icons/Editor/h-2.svg';
    import IconHeading3 from 'remixicon/icons/Editor/h-3.svg';
    import IconHeading4 from 'remixicon/icons/Editor/h-4.svg';
    import IconItalic from 'remixicon/icons/Editor/italic.svg';
    import IconLink from 'remixicon/icons/Editor/link.svg';
    import IconOrderedList from 'remixicon/icons/Editor/list-ordered.svg';
    import IconParagraph from 'remixicon/icons/Editor/paragraph.svg';
    import IconRedo from 'remixicon/icons/System/arrow-go-forward-line.svg';
    import IconSeparator from 'remixicon/icons/Editor/separator.svg';
    import IconStrike from 'remixicon/icons/Editor/strikethrough.svg';
    import IconUnderline from 'remixicon/icons/Editor/underline.svg';
    import IconUndo from 'remixicon/icons/System/arrow-go-back-line.svg';
    import IconUnlink from 'remixicon/icons/Editor/link-unlink.svg';

    export default {
        name: 'EditorToolbar',
        props: {
            editor: {
                type: Object,
                required: true,
            },
        },
        setup(props) {
            const setLink = () => {
                const previousUrl = props.editor.getAttributes('link').href;
                const url = window.prompt('URL', previousUrl);
                // cancelled
                if (url === null) {
                    return;
                }
                // empty
                if (url === '') {
                    props.editor.chain().focus().extendMarkRange('link').unsetLink().run();
                    return;
                }
                // update link
                props.editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
            };

            const items = [
                [
                    {
                        icon: IconUndo,
                        action: () => props.editor.chain().focus().undo().run(),
                        isDisabled: () => !props.editor.can().undo(),
                    },
                    {
                        icon: IconRedo,
                        action: () => props.editor.chain().focus().redo().run(),
                        isDisabled: () => !props.editor.can().redo(),
                    },
                ],
                [
                    {
                        icon: IconBold,
                        action: () => props.editor.chain().focus().toggleBold().run(),
                        isActive: () => props.editor.isActive('bold'),
                    },
                    {
                        icon: IconItalic,
                        action: () => props.editor.chain().focus().toggleItalic().run(),
                        isActive: () => props.editor.isActive('italic'),
                    },
                    {
                        icon: IconUnderline,
                        action: () => props.editor.chain().focus().toggleUnderline().run(),
                        isActive: () => props.editor.isActive('underline'),
                    },
                    {
                        icon: IconStrike,
                        action: () => props.editor.chain().focus().toggleStrike().run(),
                        isActive: () => props.editor.isActive('strike'),
                    },
                ],
                [
                    {
                        icon: IconAlignLeft,
                        action: () => props.editor.chain().focus().setTextAlign('left').run(),
                        isActive: () => props.editor.isActive({ textAlign: 'left' }),
                    },
                    {
                        icon: IconAlignCenter,
                        action: () => props.editor.chain().focus().setTextAlign('center').run(),
                        isActive: () => props.editor.isActive({ textAlign: 'center' }),
                    },
                    {
                        icon: IconAlignRight,
                        action: () => props.editor.chain().focus().setTextAlign('right').run(),
                        isActive: () => props.editor.isActive({ textAlign: 'right' }),
                    },
                    {
                        icon: IconAlignJustify,
                        action: () => props.editor.chain().focus().setTextAlign('justify').run(),
                        isActive: () => props.editor.isActive({ textAlign: 'justify' }),
                    },
                ],
                [
                    {
                        icon: IconBulletList,
                        action: () => props.editor.chain().focus().toggleBulletList().run(),
                        isActive: () => props.editor.isActive('bulletList'),
                    },
                    {
                        icon: IconOrderedList,
                        action: () => props.editor.chain().focus().toggleOrderedList().run(),
                        isActive: () => props.editor.isActive('orderedList'),
                    },
                    {
                        icon: IconBlockquote,
                        action: () => props.editor.chain().focus().toggleBlockquote().run(),
                        isActive: () => props.editor.isActive('blockquote'),
                    },
                    {
                        icon: IconSeparator,
                        action: () => props.editor.chain().focus().setHorizontalRule().run(),
                    },
                    {
                        icon: IconLink,
                        action: () => {
                            const previousUrl = props.editor.getAttributes('link').href;
                            const url = window.prompt('URL', previousUrl);
                            // cancelled
                            if (url === null) {
                                return;
                            }
                            // empty
                            if (url === '') {
                                props.editor.chain().focus().extendMarkRange('link').unsetLink().run();
                                return;
                            }
                            // update link
                            return props.editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
                        },
                        // isVisible: () =>
                    },
                    {
                        icon: IconUnlink,
                        action: () => props.editor.chain().focus().extendMarkRange('link').unsetLink().run(),
                        isVisible: () => props.editor.isActive('link'),
                    },
                ],
                [
                    {
                        icon: IconHeading1,
                        action: () => props.editor.chain().focus().toggleHeading({ level: 1 }).run(),
                        isActive: () => props.editor.isActive('heading', { level: 1 }),
                    },
                    {
                        icon: IconHeading2,
                        action: () => props.editor.chain().focus().toggleHeading({ level: 2 }).run(),
                        isActive: () => props.editor.isActive('heading', { level: 2 }),
                    },
                    {
                        icon: IconHeading3,
                        action: () => props.editor.chain().focus().toggleHeading({ level: 3 }).run(),
                        isActive: () => props.editor.isActive('heading', { level: 3 }),
                    },
                    {
                        icon: IconHeading4,
                        action: () => props.editor.chain().focus().toggleHeading({ level: 4 }).run(),
                        isActive: () => props.editor.isActive('heading', { level: 4 }),
                    },
                    {
                        icon: IconParagraph,
                        action: () => props.editor.chain().focus().setParagraph().run(),
                        isActive: () => props.editor.isActive('paragraph'),
                    },
                    {
                        icon: IconFormatClear,
                        action: () => props.editor.chain().focus().clearNodes().unsetAllMarks().run(),
                    },
                ],
            ];

            return {
                items,
                setLink,
            };
        },
    };
</script>
