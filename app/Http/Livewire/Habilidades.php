<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\habilidades as Modelohabilidades;
use App\Models\Colores;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Habilidades extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $descripcion;
    public $puntaje = 0;
    public $imagen;
    public $colores_id;
    public $activo = false;
    public $idRow = "";
    
    public $mostrarAgregarModal = false;
    public $mostrarEditarModal = false;
    protected $rules = [
        'descripcion' => 'required',
        'colores_id' => 'required',
    ];
    public function render()
    {
        $habilidades = Modelohabilidades::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
        $colores =  Colores::all();
        $coloresMap =  $this->getColor(Modelohabilidades::where('user_id', auth()->user()->id)->get(), $colores);
        return view('livewire.habilidades', ['habilidades' => $habilidades, 'colores' => $colores, 'coloresMap' => $coloresMap]);
    }

    public function submitForm()
    {
        $this->validate();
        $contenidoImagen = file_get_contents($this->imagen->getRealPath());
        $userId = Auth::id();
        $nuevaHabilidad = new Modelohabilidades();
        $nuevaHabilidad->descripcion = $this->descripcion;
        $nuevaHabilidad->puntaje = $this->puntaje;
        $nuevaHabilidad->imagen =  base64_encode($contenidoImagen);
        $nuevaHabilidad->colores_id = $this->colores_id;
        $nuevaHabilidad->activo = $this->activo;
        $nuevaHabilidad->user_id = $userId;
        $nuevaHabilidad->save();
        $this->resetPage();
        $this->limpiarCampos();
        $this->mostrarAgregarModal = false;
    }

    public function getHabilidad($id)
    {
        $this->setIdRow($id);
        $Habilidad = Modelohabilidades::findOrFail($this->idRow);
        $this->descripcion = $Habilidad->descripcion;
        $this->puntaje = $Habilidad->puntaje;
        $this->imagen = $Habilidad->imagen;
        $this->colores_id = $Habilidad->colores_id;
        $this->activo = $Habilidad->activo;
    }

    public function editarHabilidad()
    {
        $this->validate();
        $userId = Auth::id();
        $Habilidad = Modelohabilidades::findOrFail($this->idRow);
        $Habilidad->descripcion = $this->descripcion;
        $Habilidad->puntaje = $this->puntaje;
        $Habilidad->imagen = $this->convertToBase64($this->imagen);
        $Habilidad->colores_id = $this->colores_id;
        $Habilidad->activo = $this->activo;
        $Habilidad->user_id = $userId; 
        $Habilidad->save();
        $this->resetPage();
        $this->limpiarCampos();
        $this->mostrarEditarModal = false;

    }

    public function eliminarHabilidad()
    {
        Modelohabilidades::find($this->idRow)->delete();
        $this->resetPage();
        $this->limpiarCampos();
    }
    public function setIdRow($id)
    {
        $this->idRow = $id;
    }
    public function limpiarCampos()
    {
        $this->descripcion = "";
        $this->puntaje = 0;
        $this->imagen = "";
        $this->colores_id = "";
        $this->activo = false;
    }
    public function reacargaPagina(){
        $this->resetPage();
    }
    public function getColor($habilidades, $colores)
    {
        $coloresMap = [];
        foreach ($habilidades as $habilidad) {
            foreach ($colores as $color) {
                if ($habilidad->colores_id === $color->id) {
                    $coloresMap[$habilidad->id] = [
                        'id' => $color->id,
                        'descripcion' => $color->descripcion
                    ];
                }
            }
        }
        // var_dump($coloresMap);
        return $coloresMap;
    }

    public function convertToBase64($base64){
        if(str_contains($base64,'C:\\')){
            return  base64_encode(file_get_contents($base64->getRealPath()));
        }else{
            return $base64;
        }
    }

    public function abrirModalAgregar(){
        $this->mostrarAgregarModal = true;
    }
    public function cerrarModalAgregar(){
        $this->mostrarAgregarModal = false;
        $this->limpiarCampos();
    }
    public function abrirModalEditar(){
        $this->mostrarEditarModal = true;
    }
    public function cerrarModaEditar(){
        $this->mostrarEditarModal = false;
        $this->limpiarCampos();
    }
}
