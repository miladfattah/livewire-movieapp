<div>
    <input wire:model="queryTag" type="text" class="rounded w-full" placeholder="Serach Tag" >
    @if (!empty($queryTag))
        <div class="w-full">
            @if (!empty($tags))
                @foreach ($tags as $tag)
                <div 
                    wire:click="addTag({{$tag->id}})"
                    class="w-full p-2 m-2 bg-green-200 hover:bg-green-300  cursor-pointer"
                >
                    {{$tag->tag_name}}
                </div>
                @endforeach
            @endif
        </div>
    @endif
</div>
