@push('scripts')
<script src="{{ mix('js/app.js') }}" defer></script>
@endpush

<div x-data="{ isOpen: @entangle('mostrarAgregarModal') }">
    <div x-data="{ isOpenEditar:  @entangle('mostrarEditarModal') }">
        <div x-data="{ isOpenEliminar: false }">
            <div :class="{'opacity-50 pointer-events-none': isOpen}">
                <div :class="{'opacity-50 pointer-events-none': isOpenEditar}">
                    <div :class="{'opacity-50 pointer-events-none': isOpenEliminar}">
                        <div class="p-2 lg:p-8 bg-white border-b border-gray-200">
                            <h1 class="mt-4 text-2xl font-medium text-gray-900">
                                <div>Habilidades</div>
                            </h1>
                            <!-- Botón para abrir el modal -->
                            <button @click="isOpen = true" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Agregar Habilidad</button>

                            <div class="mt-3">
                                <table class="table-auto w-full">
                                    <thead>
                                        <tr>
                                          
                                            <th class="px-4 py-2">
                                                <div class="flex item-center">Descripcion</div>
                                            </th>
                                            <th class="px-1 py-2">
                                                <div class="flex item-center">Porcentaje</div>
                                            </th>
                                            <th class="px-1 py-2">
                                                <div class="flex item-center">Imagen</div>
                                            </th>
                                            <th class="px-4 py-2">
                                                <div class="flex item-center">¿Es público?</div>
                                            </th>
                                            <th class="px-4 py-2">
                                                <div class="flex item-center">Color</div>
                                            </th>
                                            <th class="px-4 py-2">
                                                <div class="flex item-center">Acción</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($habilidades as $habilidad)
                                        <tr>
                                        
                                            <td class="rounded border px-4 py-2">{{$habilidad->descripcion}}</td>
                                            <td class="rounded border px-1 py-2">{{ number_format($habilidad->puntaje)}}</td>
                                            <td class="rounded border px-1 py-2"><img class="w-20 h-20" src="data:image/png;base64,{{ $habilidad->imagen }}"></td>
                                            <td class="rounded border px-4 py-2">{{ $habilidad->activo ? 'Si' : 'No'}}</td>
                                            <td class="rounded border px-4 py-2">{{ $coloresMap[$habilidad->id]['descripcion'] }}</td>
                                            <td class="rounded border px-4 py-2">
                                                <button @click="isOpenEditar = true" wire:click="getHabilidad({{ $habilidad->id }})" value={{$habilidad->id}} class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"">Editar</button> 
                                
                                <button  @click=" isOpenEliminar=true" wire:click="getHabilidad({{ $habilidad->id }})" value={{$habilidad->id}} class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"">Eliminar</button> 
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class=" mt-4">
                                                    {{$habilidades->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->



        <!-- Contenido del modal -->
        <div x-show="isOpen"  class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-white p-6 max-w-md mx-auto rounded shadow-lg">
                <!-- Botón para cerrar el modal -->
                <div class="flex justify-end">
                    <button @click="isOpen = false" wire:click="cerrarModalAgregar()" class="text-gray-500 ml-1 flex w-fulll justify-items-end  text-right hover:text-gray-600 text-4xl p-0">&times;</button>
                </div>

                <!-- Encabezado del modal -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Agregar una nueva habilidad</h2>
                </div>

                <!-- Contenido del modal -->
                <form wire:submit.prevent="submitForm">
                    <div class="mb-4">
                        <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripcion:</label>
                        <input wire:model="descripcion" maxlength="100" type="text" id="descripcion" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-500" required>
                    </div>

                    <div class="mb-4" x-data="{ sliderValue:   @entangle('puntaje')}">
                        <label for="puntaje" class="block text-gray-700 font-bold mb-2">Puntaje:</label>
                        <input wire:model="puntaje" x-model="sliderValue" type="range" id="puntaje" class="w-full  border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-500"><span x-text="sliderValue" class="ml-2" ></span>
                    </div>

                    <div class="mb-4">
                        <div x-data="{ imagenPreview: @entangle('imagen') }">
                            <label for="imagen" class="block text-gray-700 font-bold mb-2">imagen:</label>
                            <input wire:model="imagen" type="file" accept="image/gif, image/jpeg" max="5242880" id="imagen" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-500" >

                            <div class="mt-2" x-show="imagenPreview">
                                <img src="{{str_contains($imagen, 'C:\\') ? 'data:image/png;base64,'. base64_encode(file_get_contents($imagen->getRealPath())): 'data:image/png;base64,'. $imagen}}"  alt="Vista previa de la imagen" class="w-32 h-32 object-cover">
                            </div>

                        </div>

                    </div>

                    <div class="mb-4" x-data="{ sliderValue:   @entangle('puntaje')}">
                        <label for="activo" class="block text-gray-700 font-bold mb-2">¿Colocarlo en modo público?</label>
                        <input wire:model="activo" type="checkbox" id="activo" class=" px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-500" >
                        {{$activo ? 'Si' :' No'}}
                    </div>

                    <div class="mb-4">
                        <label for="color" class="block text-gray-700 font-bold mb-2">Color para esta habilidad</label>
                        <select wire:model="colores_id" id="colores_id" required>
                            <option value="">Seleccionar opción</option>
                            @foreach ($colores as $elemento)
                            <option value="{{ $elemento->id }}">{{ $elemento->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button @click="imagenPreview = ''" type="submit" class="bg-blue-500 mr-1 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Agregar</button>
                        <button @click="imagenPreview = ''" wire:click="cerrarModalAgregar()" type="button" class="bg-gray-500  hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Contenido del modal update-->
        <div x-show="isOpenEditar" class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-white p-6 max-w-md mx-auto rounded shadow-lg">
                <div class="flex justify-end">
                    <button @click="isOpenEditar = false;imagenPreview = ''" wire:click="cerrarModaEditar()" class="text-gray-500 ml-1 flex w-fulll justify-items-end  text-right hover:text-gray-600 text-4xl p-0">&times;</button>
                </div>


                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Editar una nueva habilidad</h2>
                </div>

                <form wire:submit.prevent="editarHabilidad">
                    <div class="mb-4">
                        <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripcion:</label>
                        <input wire:model="descripcion" maxlength="100" id="description" type="text" id="descripcion" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-500" required>
                    </div>
                    <div class="mb-4" x-data="{ sliderValue: @entangle('puntaje') }">
                        <label for="puntaje" class="block text-gray-700 font-bold mb-2">Puntaje:</label>
                        <input wire:model="puntaje" x-model="sliderValue" type="range" type="number" id="puntaje" class="w-full  border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-500"><span x-text="sliderValue" class="ml-2"></span>
                    </div>
                    <div class="mb-4" x-data="{ imagenEditPreview: @entangle('imagen') }">

                            <label for="imagen" class="block text-gray-700 font-bold mb-2">imagen:</label>
                            <input wire:model="imagen" type="file" accept="image/gif, image/jpeg" max="5242880" id="imagen" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-500">

                            <div class="mt-2" x-show="imagenEditPreview">
                                <img  src="{{str_contains($imagen, 'C:\\') ? 'data:image/png;base64,'. base64_encode(file_get_contents($imagen->getRealPath())): 'data:image/png;base64,'. $imagen}}"  alt="Vista previa de la imagen" class="w-32 h-32 object-cover">
                            </div>

                    </div>

                    <div class="mb-4">
                        <label for="activo" class="block text-gray-700 font-bold mb-2">¿Colocarlo en modo público?</label>
                        <input wire:model="activo" type="checkbox" id="activo" class=" px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                        {{$activo ? 'Si' :' No'}}
                    </div>

                    <div class="mb-4">
                        <label for="color" class="block text-gray-700 font-bold mb-2">Color para esta habilidad</label>
                        <select wire:model="colores_id" id="colores_id" required>
                            <option value="">Seleccionar opción</option>
                            @foreach ($colores as $elemento)
                            <option value="{{ $elemento->id }}">{{ $elemento->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button @click="imagenPreview = ''"  type="submit" class="bg-blue-500 mr-1 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Guardar cambios</button>
                        <button @click="imagenPreview = ''" wire:click="cerrarModaEditar()" type="button" class="bg-gray-500  hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Cerrar</button>

                    </div>
                </form>
            </div>
        </div>

        <div x-show="isOpenEliminar" class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-white p-6 max-w-md mx-auto rounded shadow-lg">

                <div class="flex justify-end">
                    <button @click="isOpenEliminar = false" wire:click="limpiarCampos()" class="text-gray-500 ml-1 flex w-fulll justify-items-end  text-right hover:text-gray-600 text-4xl p-0">&times;</button>
                </div>


                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">¿Seguro que deseas eliminar esta habilidad?</h2>
                </div>


                <form wire:submit.prevent="eliminarHabilidad">

                    <div class="mt-6 flex justify-end">
                        <button @click="isOpenEliminar = false;imagenPreview = ''" wire:click="limpiarCampos()" type="submit" class="bg-red-500 mr-1 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Si</button>
                        <button @click="isOpenEliminar = false;imagenPreview = ''" wire:click="limpiarCampos()" type="button" class="bg-gray-500  hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">No</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>