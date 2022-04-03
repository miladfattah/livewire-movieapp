<div>
    <input wire:model="queryCast" type="text" class="rounded w-full" placeholder="Serach Cast" >
    @if (!empty($queryCast))
        <div class="w-full">
            @if (!empty($casts))
                @foreach ($casts as $cast)
                <div 
                    wire:click="addCast({{$cast->id}})"
                    class="w-full p-2 m-2 bg-green-200 hover:bg-green-300  cursor-pointer"
                >
                    {{$cast->name}}
                </div>
                @endforeach
            @endif
        </div>
    @endif
</div>
