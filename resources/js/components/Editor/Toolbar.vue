<template>
    <div
        v-if="editor"
        class="flex flex-wrap -mt-px border-b divide-x divide-gray-300 bg-gray-50"
    >
        <div
            class="px-2 py-1 space-x-1 border-t"
            v-for="(buttons, index) in items"
            :key="`toolbar-${index}`"
        >
            <component
                v-for="button in buttons"
                :is="button.component || 'editor-button'"
                :key="`toolbar-${index}-${button.name}`"
                v-bind="button"
                class="inline-flex"
            />
        </div>
    </div>
</template>

<script>
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
                    props.editor
                        .chain()
                        .focus()
                        .extendMarkRange('link')
                        .unsetLink()
                        .run();
                    return;
                }
                // update link
                props.editor
                    .chain()
                    .focus()
                    .extendMarkRange('link')
                    .setLink({ href: url })
                    .run();
            };

            const items = [
                [
                    {
                        icon: 'System/arrow-go-back-line',
                        action: () => props.editor.chain().focus().undo().run(),
                        isDisabled: () => !props.editor.can().undo(),
                    },
                    {
                        icon: 'System/arrow-go-forward-line',
                        action: () => props.editor.chain().focus().redo().run(),
                        isDisabled: () => !props.editor.can().redo(),
                    },
                ],
                [
                    {
                        icon: 'Editor/bold',
                        action: () =>
                            props.editor.chain().focus().toggleBold().run(),
                        isActive: () => props.editor.isActive('bold'),
                    },
                    {
                        icon: 'Editor/italic',
                        action: () =>
                            props.editor.chain().focus().toggleItalic().run(),
                        isActive: () => props.editor.isActive('italic'),
                    },
                    {
                        icon: 'Editor/underline',
                        action: () =>
                            props.editor.chain().focus().toggleUnderline().run(),
                        isActive: () => props.editor.isActive('underline'),
                    },
                    {
                        icon: 'Editor/strikethrough',
                        action: () =>
                            props.editor.chain().focus().toggleStrike().run(),
                        isActive: () => props.editor.isActive('strike'),
                    },
                ],
                [
                    {
                        icon: 'Editor/align-left',
                        action: () =>
                            props.editor.chain().focus().setTextAlign('left').run(),
                        isActive: () =>
                            props.editor.isActive({ textAlign: 'left' }),
                    },
                    {
                        icon: 'Editor/align-center',
                        action: () =>
                            props.editor
                                .chain()
                                .focus()
                                .setTextAlign('center')
                                .run(),
                        isActive: () =>
                            props.editor.isActive({ textAlign: 'center' }),
                    },
                    {
                        icon: 'Editor/align-right',
                        action: () =>
                            props.editor
                                .chain()
                                .focus()
                                .setTextAlign('right')
                                .run(),
                        isActive: () =>
                            props.editor.isActive({ textAlign: 'right' }),
                    },
                    {
                        icon: 'Editor/align-justify',
                        action: () =>
                            props.editor
                                .chain()
                                .focus()
                                .setTextAlign('justify')
                                .run(),
                        isActive: () =>
                            props.editor.isActive({ textAlign: 'justify' }),
                    },
                ],
                [
                    {
                        icon: 'Editor/font-color',
                        component: 'editor-font-color',
                        getColor: () =>
                            props.editor.getAttributes('textStyle').color,
                        setColor: (value) =>
                            props.editor.chain().focus().setColor(value).run(),
                    },
                    {
                        icon: 'Design/mark-pen-fill',
                        action: () =>
                            props.editor.chain().focus().toggleHighlight().run(),
                        isActive: () => props.editor.isActive('highlight'),
                    },
                    {
                        icon: 'Editor/format-clear',
                        action: () =>
                            props.editor
                                .chain()
                                .focus()
                                .clearNodes()
                                .unsetAllMarks()
                                .run(),
                    },
                ],
                [
                    {
                        icon: 'Editor/list-unordered',
                        action: () =>
                            props.editor.chain().focus().toggleBulletList().run(),
                        isActive: () => props.editor.isActive('bulletList'),
                    },
                    {
                        icon: 'Editor/list-ordered',
                        action: () =>
                            props.editor.chain().focus().toggleOrderedList().run(),
                        isActive: () => props.editor.isActive('orderedList'),
                    },
                    {
                        icon: 'Editor/double-quotes-l',
                        action: () =>
                            props.editor.chain().focus().toggleBlockquote().run(),
                        isActive: () => props.editor.isActive('blockquote'),
                    },
                    {
                        icon: 'Editor/separator',
                        action: () =>
                            props.editor.chain().focus().setHorizontalRule().run(),
                    },
                    {
                        icon: 'Editor/link',
                        action: () => {
                            const previousUrl = props.editor.getAttributes('link')
                                .href;
                            const url = window.prompt('URL', previousUrl);
                            // cancelled
                            if (url === null) {
                                return;
                            }
                            // empty
                            if (url === '') {
                                props.editor
                                    .chain()
                                    .focus()
                                    .extendMarkRange('link')
                                    .unsetLink()
                                    .run();
                                return;
                            }
                            // update link
                            return props.editor
                                .chain()
                                .focus()
                                .extendMarkRange('link')
                                .setLink({ href: url })
                                .run();
                        },
                        // isVisible: () =>
                    },
                    {
                        icon: 'Editor/link-unlink',
                        action: () =>
                            props.editor
                                .chain()
                                .focus()
                                .extendMarkRange('link')
                                .unsetLink()
                                .run(),
                        isVisible: () => props.editor.isActive('link'),
                    },
                ],
                [
                    {
                        icon: 'Editor/h-1',
                        action: () =>
                            props.editor
                                .chain()
                                .focus()
                                .toggleHeading({ level: 1 })
                                .run(),
                        isActive: () =>
                            props.editor.isActive('heading', { level: 1 }),
                    },
                    {
                        icon: 'Editor/h-2',
                        action: () =>
                            props.editor
                                .chain()
                                .focus()
                                .toggleHeading({ level: 2 })
                                .run(),
                        isActive: () =>
                            props.editor.isActive('heading', { level: 2 }),
                    },
                    {
                        icon: 'Editor/h-3',
                        action: () =>
                            props.editor
                                .chain()
                                .focus()
                                .toggleHeading({ level: 3 })
                                .run(),
                        isActive: () =>
                            props.editor.isActive('heading', { level: 3 }),
                    },
                    {
                        icon: 'Editor/h-4',
                        action: () =>
                            props.editor
                                .chain()
                                .focus()
                                .toggleHeading({ level: 4 })
                                .run(),
                        isActive: () =>
                            props.editor.isActive('heading', { level: 4 }),
                    },
                    {
                        icon: 'Editor/paragraph',
                        action: () =>
                            props.editor.chain().focus().setParagraph().run(),
                        isActive: () => props.editor.isActive('paragraph'),
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
