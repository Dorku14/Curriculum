@push('scripts')
<script src="{{ mix('js/app.js') }}" defer></script>
@endpush
<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="items-center flex justify-center content-center text-center">
        <h1 class="mt-8 text-7xl border-b-4  border-t-4 w-6/12  items-center mb-16 text-center font-medium text-gray-900" style="border-color: rgba(220,1,97,255);">
            <p> Habilidades</p>
        </h1>

    </div>
    <div class="grid grid-cols-12 gap-4">
        @foreach($habilidades as $habilidad)
        <div class="col-span-2 image-container">
            <img class="rounded-full w-32 h-32 " src="data:image/png;base64,{{ $habilidad->imagen }}" alt="Imagen">
        </div>
        <div class="col-span-9">
            <div wire:poll.1000ms>
                <div class="flow-root"><span class="float-left text-2xl" >{{$habilidad->descripcion}}</span><span class="float-right text-2xl">{{$habilidad->puntaje}}%</span></div>
                <div class="bg-gray-200 h-14 rounded ">
                    <div class="  h-14 rounded progress-bar"  style="width: {{$habilidad->puntaje}}%; background-color: {{$colores[$habilidad->id]['codigoHex']}}">

                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class=" mt-4">
        {{$habilidades->links()}}
    </div>
</div>