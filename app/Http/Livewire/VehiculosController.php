<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Vehiculos;
use App\Models\Dependencia;
use App\Models\Conductor;
use App\Models\Diagnostico;
use App\Models\Taller;
use DB;

class VehiculosController extends Component
{
    use WithPagination;

    public $placa,$clase,$tipo_vehiculo,$combustible_capacidad,$modelo,$marca,$color,$cilindrada,$chasis,$motor,$estado,$dependencias_id,
           $search,$selected_id,$pageTitle,$componentName;
    private $pagination=5;

    function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    function mount()
    {
        $this->pageTitle ='Listado';
        $this->componentName = 'Vehiculos';
        //$this->conductors_id='Elegir';
    }

    public function render()
    {
        if(strlen($this->search) > 0 )

        $Vehiculos=Vehiculos::where('vehiculos.placa','like','%'.$this->search.'%')
        ->orderBy('vehiculos.id','desc')
        ->paginate($this->pagination);
        else
        $Vehiculos=Vehiculos::orderBy('vehiculos.id','desc')
        ->paginate($this->pagination);

        return view('livewire.vehiculos.component',[
            'vehiculos'=>$Vehiculos
            //'Conductor'=> Conductor::orderBy('name','asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
        
    }
    public function Edit(Vehiculos $Vehiculos)
    {
       //dd($Dependencias);
        $this->selected_id = $Vehiculos->id;
        $this->placa = $Vehiculos->placa;
        $this->clase = $Vehiculos->clase;
        $this->modelo=$Vehiculos->modelo;
        $this->marca=$Vehiculos->marca;
        $this->tipo_vehiculo = $Vehiculos->tipo_vehiculo;
        $this->color=$Vehiculos->color;
        $this->combustible_capacidad = $Vehiculos->combustible_capacidad;
        $this->cilindrada=$Vehiculos->cilindrada;
        $this->chasis=$Vehiculos->chasis;
        $this->motor=$Vehiculos->motor;
        $this->estado = $Vehiculos->estado;
        $this->emit('show-modal', 'SHOW MODAL');
    }
    public function Store()
    {
      //dd($this->placa);
        $rules = [
            'placa' => 'required|min:3|unique:vehiculos,placa',
            'clase' => 'required|min:3',
            'marca' => 'required|min:3',
            'tipo_vehiculo' => 'required|min:3',
            'color' => '',
            'combustible_capacidad' => '',
            'motor' => '',
            'chasis' => '',
            'modelo' => 'required|min:3',
            'cilindrada' => '',
            'estado' => 'required|min:3'
            //'conductors_id' => 'required',
        ];

        $messages =[   
            'placa.required' => 'ingrese el nombre',
            'placa.min' => 'El nombre tiene que tener al menos 3 caracteres',  
            'placa.unique' => 'La PLACA ya existe en el sistema'
        ];
        
        $this->validate($rules, $messages);
        //dd($this->placa);
        $Vehiculos=Vehiculos::create(['placa' => strtoupper( $this->placa),
                                      'clase' => $this->clase,
                                      'marca'=>$this->marca,
                                      'tipo_vehiculo'=>$this->tipo_vehiculo,
                                      'color'=>$this->color,
                                      'combustible_capacidad' => $this->combustible_capacidad,
                                      'motor'=>$this->motor,
                                      'chasis'=>$this->chasis,
                                      'modelo'=>$this->modelo,
                                      'cilindrada'=>$this->cilindrada,
                                      'estado'=>$this->estado
                                    ]);
                                      //'conductors_id' => $this->conductors_id]);
                                      
       // dd($Dependencias);
        $this->resetUI();
        $this->emit('vehiculo-added', 'Se registro el vehiculo con exito');
        
        
    }
    public function resetUI()
    {
        $this->placa ='';
        $this->clase ='';
        $this->marca ='';
        $this->tipo_vehiculo ='';
        $this->color ='';
        $this->combustible_capacidad ='';
        $this->motor ='';
        $this->chasis ='';
        $this->modelo ='';
        $this->cilindrada ='';
        $this->estado ='';
        $this->search ='';
        $this->selected_id =0;
        $this->resetValidation();
        $this->resetPage();
        $this->emit('vehiculo-close', 'vehiculo cerrar');
    }
    public function Update()
    {
        $rules = [
            'placa' => "required|min:3|unique:vehiculos,placa,{$this->selected_id},id",
            'clase' => 'required|min:3',
            'marca' => 'required|min:3',
            'tipo_vehiculo' => 'required|min:3',
            'color' => '',
            'combustible_capacidad' => '',
            'motor' => '',
            'chasis' => '',
            'modelo' => 'required|min:3',
            'cilindrada' => '',
            'estado' => 'required|min:3'
            //'conductors_id' => 'required',
        ];

        $messages =[
            'placa.required' => 'ingrese el nombre',
            'placa.min' => 'El nombre tiene que tener al menos 3 caracteres',  
            'placa.unique' => 'La PLACA ya existe en el sistema'
            
        ];

        $this->validate($rules, $messages);
        $Vehiculos =Vehiculos::find($this->selected_id);
        $Vehiculos ->update(['placa' => strtoupper($this->placa),
                                'clase' => $this->clase,
                                'marca'=>$this->marca,
                                'tipo_vehiculo'=>$this->tipo_vehiculo,
                                'color'=>$this->color,
                                'combustible_capacidad' => $this->combustible_capacidad,
                                'motor'=>$this->motor,
                                'chasis'=>$this->chasis,
                                'modelo'=>$this->modelo,
                                'cilindrada'=>$this->cilindrada,
                                'estado'=>$this->estado
                            ]);
                                      //'conductors_id' => $this->conductors_id]);
                                      
       // dd($Dependencias);
        $this->resetUI();
        $this->emit('vehiculo-updated', 'Se actualizo el vehiculo con exito');
    }
    protected $listeners = [
        'destroy' => 'Destroy',
        'resetUI' => 'resetUi'
    ];

    public function Destroy(Vehiculos $Vehiculos)
    {
        if($Vehiculos){
            $data = Taller::where('vehiculo_id', $Vehiculos->id)->count();
            //validar si tiene vehiculos asignados
            if($data > 0 ) {
                $this->emit('vehiculo-nodeleted','No es posible eliminar el vehiculo por que se uso ');
            } else {
                $Vehiculos->delete();
                $this->resetUI();
                $this->emit('vehiculo-deleted', 'Vehiculo Eliminado');
            }
        }
    
    }
    
}
