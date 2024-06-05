<?php

namespace App\Http\Livewire;

use App\Models\Conductor;
use Livewire\WithPagination;

use Livewire\Component;

class ConductorController extends Component
{
    public $componentName, $pageTitle, $search, $selected_id, $name,$ci, $telefono, $status;
    public $filas = [], $filas2 = [];

    use WithPagination;

    private $pagination = 5;

    public function PaginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Conductores';
    }

    public function render()
    {
        //validar datos
        if (strlen($this->search) > 0)
            $conductor = Conductor::where('name', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $conductor = Conductor::orderby('name', 'asc')->paginate($this->pagination);

        return view('livewire.conductor.component', [
            'conductor' => $conductor
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function Store()
    {
        //dd($this->filas);
        //validaciones
        $rules = [
            'name' => 'required|min:2|unique:conductors,name',
            'ci' => 'required|min:5',
            'telefono' => 'required|min:7',
            'status' => 'required|not_in:Elegir'
                ];

        //mensajes
        $messages = [
            'name.required' => 'El nombre del conductor es requerido',
            'name.unique' => 'El role ya existe',
            'name.min' => 'el nombre del conductor debe tener al menos 2 catacteres',
            'ci.required' => 'Agregar CI',
            'ci.min' => 'mayor a 5 caracteres',
            'telefono.required' => 'Agregar telefono',
            'telefono.min' => 'mayor a 7 caracteres',
            'ci' => 'debe ser diferente a elegir',
        ];
        //validar si estan bien 
        $this->validate($rules, $messages);
        //dd($this->ci,$this->status);
        
        //crear el rol
        $conductor = Conductor::create([
            'name' => $this->name,
            'ci' => $this->ci,
            'telefono' => $this->telefono,
            'status' => $this->status,

        ]);

        $this->emit('conductor-added', 'Se registro el conductor con exito');
        $this->resetUI();
    }

    //metodo editar

    public function Edit(Conductor $conductor)
    {
        //buscar el rol con el metodo antiguo
        //$conductor = con$conductor::find($id);
        //mandar los datos a los propiedades
        $this->selected_id = $conductor->id;
        $this->name = $conductor->name;
        $this->ci = $conductor->ci;
        $this->telefono = $conductor->telefono;
        $this->status = $conductor->status;

        //emitir un evento a una ventada modal
        $this->emit('show-modal', ' Show modal');
    }

    public function algo()
    {

        $this->emit('show-modal', ' Show modal');
    }

    //actualizar datos
    public function Update()
    {
        //validaciones
        $rules = [
                    'name' => "required|min:2|unique:roles,name, {$this->selected_id}",
                    'ci' => 'required|min:5',
                    'telefono' => 'required|min:7',
                    'status' => 'required|not_in:Elegir'
    ];

        //mensajes
        $messages = [
            'name.required' => 'El nombre del conductor es requerido',
            'name.unique' => 'El conductor ya existe',
            'name.min' => 'el nombre del conductor debe tener al menos 2 catacteres',
            'ci.required' => 'Agregar CI',
            'ci.min' => 'mayor a 5 caracteres',
            'telefono.required' => 'Agregar telefono',
            'telefono.min' => 'mayor a 7 caracteres',
            'ci' => 'debe ser diferente a elegir',
        ];

        $this->validate($rules, $messages);

        //busqueda del rol
        $Conductor = Conductor::find($this->selected_id);
        $Conductor->Update([
            'name' => $this->name,
            'ci' => $this->ci,
            'telefono' => $this->telefono,
            'status' => $this->status
        ]);
        //guardar rol 
        $Conductor->save();

        $this->emit('conductor-updated', 'Se actualizo el conductor con exito');
        $this->resetUI();
    }

    //limpiar los inputs
    public function resetUI()
    {
        $this->name = '';
        $this->ci = '';
        $this->telefono = '';
        $this->status = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
        $this->emit('conductor-close', 'conductor cerrar');
    }

    protected $listeners = [
        'deleteRow' => 'Destroy',
        'resetUI' => 'resetUi'
    ];
    //metodo eliminar
    public function Destroy(Conductor $conductor)
    {
        
                $conductor->delete();
                $this->resetUI();
                $this->emit('user-deleted', 'Usuario Eliminado');
        
    }
}
