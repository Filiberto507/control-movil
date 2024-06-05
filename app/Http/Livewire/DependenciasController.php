<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dependencia;
use App\Models\Vehiculos;
use DB;

class DependenciasController extends Component
{
    use WithPagination;

    public $nombre,
           $search,$selected_id,$pageTitle,$componentName;
    private $pagination=6;

    function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    function mount()
    {
        $this->pageTitle ='Listado';
        $this->componentName = 'Dependencias';
        
    }

    public function render()
    {
        if(strlen($this->search) > 0 )
            $Data = Dependencia::where('dependencias.nombre', 'like', '%' .strtoupper($this->search) . '%')
            ->orderBy('dependencias.id','desc')
            ->paginate($this->pagination);
        else
            $Data= Dependencia::orderBy('id', 'desc')->paginate($this->pagination);

        


        return view('livewire.dependencias.component',['Dependencias'=>$Data])
        ->extends('layouts.theme.app')
        ->section('content');
        
    }
    

    /*public function Edit($id)
    {
        $Dependencias = Dependencia::find($id);
        $this->selected_id = $Dependencias->id;
        $this->nombre = $Dependencias->nombre;

        $this->emit('show-modal', 'show modal');
        
    }*/
    public function Edit(Dependencia $Dependencias)
    {
       //dd($Dependencias);
        $this->selected_id = $Dependencias->id;
        $this->nombre = $Dependencias->nombre;
        $this->emit('show-modal', 'SHOW MODAL');
    }
    public function Store()
    {
        
        $rules = [
            'nombre' => 'required|min:3|unique:dependencias,nombre',
        ];

        $messages =[
            'nombre.required' => 'ingrese el nombre',
            'nombre.unique'=> 'ya existe el nombre de la dependencia',
            'nombre.min' => 'El nombre tiene que tener al menos 3 caracteres',     
            
        ];

        $this->validate($rules, $messages);

        $Dependencias=Dependencia::create(['nombre' => $this->nombre]);
       // dd($Dependencias);
        $this->resetUI();
        $this->emit('dependencia-added', 'Se registro la dependencia con exito');
        
        
    }
    public function Update()
    {
        $rules = [
            'nombre' => 'required|min:3|unique:dependencias,nombre'
        ];

        $messages =[
            'nombre.required' => 'ingrese el nombre',
            'nombre.unique'=> 'ya existe el nombre de la dependencia',
            'nombre.min' => 'El nombre tiene que tener al menos 3 caracteres',     
            
        ];

        $this->validate($rules, $messages);
        $Dependencias =Dependencia::find($this->selected_id);
        $Dependencias ->update(['nombre' => $this->nombre]);                        
       // dd($Dependencias);
        $this->resetUI();
        $this->emit('dependencia-updated', 'Se actualizo la dependencia con exito');
    }
    public function resetUI()
    {
        $this->nombre ='';
        $this->search ='';
        $this->selected_id =0;
        $this->resetValidation();
        //para regresar a la pagina principal
        $this->resetPage();
        $this->emit('dependencia-close', 'dependencia cerrar');
    }
    protected $listeners=['deleteRow'=>'Destroy'];
    public function Destroy(Dependencia $Dependencias)
    {
        if($Dependencias){
            $data = Vehiculos::where('dependencias_id', $Dependencias->id)->count();
            //validar si tiene vehiculos asignados
            if($data > 0 ) {
                $this->emit('dependencia-deleted','No es posible eliminar la dependencia por que tiene vehiculos asignados');
            } else {
                $Dependencias->delete();
                $this->resetUI();
                $this->emit('dependencia-deleted', 'Usuario Eliminado');
            }
        }
    }
}
