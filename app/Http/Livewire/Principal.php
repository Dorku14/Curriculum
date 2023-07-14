<?php

namespace App\Http\Livewire;
use App\Models\habilidades;
use App\Models\Colores;
use Livewire\Component;

class Principal extends Component
{
    public $progreso = 80;
    public function render()
    {
        $habilidades = habilidades::where('user_id', auth()->user()->id)->where('activo', 1)->orderBy('created_at', 'desc')->paginate(5);
        $todosLoColores =  Colores::all();
        $colores =  $this->getColor(habilidades::where('user_id', auth()->user()->id)->get(), $todosLoColores);
        return view('livewire.Principal',['habilidades' => $habilidades,'colores' => $colores]);
    }

    public function getColor($habilidades, $colores)
    {
        $coloresMap = [];
        foreach ($habilidades as $habilidad) {
            foreach ($colores as $color) {
                if ($habilidad->colores_id === $color->id) {
                    $coloresMap[$habilidad->id] = [
                        'id' => $color->id,
                        'codigoHex' => $color->codigoHex
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
}
