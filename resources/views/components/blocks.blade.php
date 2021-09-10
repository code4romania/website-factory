<div class="grid grid-cols-1 gap-4 mx-auto my-8 md:grid-cols-2 max-w-7xl">
    @foreach ($blocks as $block)
        <div @class([ 'border' , 'md:col-span-2'=> $block->checkbox('fullwidth') ])>
            @include($block->view_name, ['block' => $block])
        </div>
    @endforeach
</div>
