@props(['block'])

@php
    $accept = collect($block->input('accepts'));
    
    if ($accept->contains('other')) {
        $accept = collect();
    } else {
        $accept = $accept->flatMap(fn(string $type) => config("mediable.aggregate_types.{$type}.extensions"))->filter();
    }
    
@endphp

<x-blocks.form._field
    :block="$block"
    tag="div"
>
    <div
        class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded"
        x-data="fileupload({
            maxFiles: @js($block->input('max_files')),
        })"
    >
        <div
            class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer focus-within:bg-gray-50 focus-within:ring-2 ring-blue-600 hover:bg-gray-50"
            x-ref="zone"
        >
            <input
                {{ $attributes->class(['absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer'])->merge([
                        'type' => 'file',
                        'name' => $block->name,
                        'accept' => $accept->map(fn(string $ext) => ".{$ext}")->implode(','),
                        'required' => $block->checkbox('required'),
                        'multiple' => $block->checkbox('multiple'),
                        'x-ref' => 'input',
                        'x-init' => 'initializeField()',
                        '@change' => 'addFiles($event, form, "' . $block->name . '")',
                        '@dragover' => 'dragover',
                        '@dragleave' => 'dragleave',
                        '@drop' => 'dragleave',
                        'title' => '',
                    ]) }}
            />

            <div class="flex flex-col items-center justify-center py-10 text-center">
                <x-ri-upload-2-line class="w-12 h-12 text-current opacity-50" />

                <div class="flex flex-wrap justify-center gap-1 mt-4 text-sm leading-6 text-gray-600">
                    <span
                        class="relative font-semibold rounded-md cursor-pointer text-primary focus-within:outline-none focus-within:ring-2 focus-within:ring-primary focus-within:ring-offset-2 hover:text-primary"
                    >
                        @if ($block->checkbox('multiple') && $block->input('max_files'))
                            @lang('media.upload.files', ['count' => $block->input('max_files')])
                        @else
                            @lang('media.upload.file')
                        @endif
                    </span>
                    <span>
                        @lang('media.upload.drag')
                    </span>
                </div>
            </div>

            <div
                class="flex flex-wrap justify-between gap-4 px-2 py-1 text-xs text-gray-500 bg-gray-100 border-t border-gray-200">

                <span>
                    @lang('media.upload.allowed_extensions', [
                        'extensions' => $accept->implode(', '),
                    ])
                </span>

                <span>
                    @lang('media.upload.max_file_size', [
                        'size' => format_bytes(config('mediable.max_size')),
                    ])
                </span>
            </div>
        </div>

        <template x-if="files.length > 0">
            <div class="grid gap-2 mt-4">
                <template x-for="(_, index) in Array.from({ length: files.length })">
                    <div
                        class="relative flex flex-col overflow-hidden bg-gray-100 border rounded"
                        :data-index="index"
                    >
                        <div class="flex items-stretch justify-between">
                            <div class="p-2 text-gray-400 shrink-0">
                                <template x-if="files[index].type.includes('audio/')">
                                    <x-ri-file-music-line class="w-8 h-8" />
                                </template>
                                <template x-if="files[index].type.includes('image/')">
                                    <x-ri-image-line class="w-8 h-8" />
                                </template>
                                <template x-if="files[index].type.includes('video/')">
                                    <x-ri-movie-line class="w-8 h-8" />
                                </template>
                                <template
                                    x-if="
                                        ! files[index].type.includes('audio/') &&
                                        ! files[index].type.includes('image/') &&
                                        ! files[index].type.includes('video/')
                                    "
                                >
                                    <x-ri-file-line class="w-8 h-8" />
                                </template>
                            </div>

                            <div class="flex flex-col flex-1 p-2 text-xs truncate">
                                <span
                                    class="w-full font-bold text-gray-900 truncate"
                                    x-text="files[index].name"
                                >Loading</span>
                                <span
                                    class="text-xs text-gray-900"
                                    x-text="humanFileSize(files[index].size)"
                                >...</span>
                            </div>

                            <button
                                class="p-2 focus:outline-none"
                                type="button"
                                @click="remove(index)"
                            >
                                <x-ri-delete-bin-line class="w-4 h-4 text-red-600" />
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </template>
    </div>
</x-blocks.form._field>
