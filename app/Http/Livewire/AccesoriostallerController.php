<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\accesoriostaller;
use App\Models\tallerdetalle;
use Livewire\WithPagination;
use DB;

class AccesoriostallerController extends Component
{
    use WithPagination;

    public $acctallerName, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    //traer el paginacion de bootstrap
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    //agregar las propiedades del componente
    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Accesorios Taller';
    }

    public function render()
    {
        //validar si el usuario ingreso informacion
        if (strlen($this->search) > 0)
            $acctaller = accesoriostaller::where('name', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $acctaller = accesoriostaller::orderBy('id', 'asc')->paginate($this->pagination);

        return view('livewire.accesoriostaller.component', [
            'acctaller' => $acctaller
        ])
            //extender de layouts
            ->extends('layouts.theme.app')
            //renderizarse
            ->section('content');
    }

    public function Edit(accesoriostaller $accesorio)
    {
        //dd($accesorio);
        $this->selected_id = $accesorio->id;
        $this->acctallerName = $accesorio->name;
        $this->emit('show-modal', 'SHOW MODAL');
    }
    public function CreateAccesorio()
    {

        $rules = [
            'acctallerName' => 'required|min:3|unique:accesoriostallers,name',
        ];

        $messages = [
            'acctallerName.required' => 'ingrese el Accesorio',
            'acctallerName.unique' => 'ya existe el Accesorio',
            'acctallerName.min' => 'El Accesorio tiene que tener al menos 3 caracteres',

        ];

        $this->validate($rules, $messages);

        $accesorio = accesoriostaller::create(['name' => $this->acctallerName]);
        // dd($Dependencias);
        $this->resetUI();
        $this->emit('accesorio-added', 'Se registro El Accesorio con exito');
    }
    public function Update()
    {
        $rules = [
            'acctallerName' => 'required|min:3|unique:accesoriostallers,name'
        ];

        $messages = [
            'acctallerName.required' => 'ingrese el Accesorio',
            'acctallerName.unique' => 'ya existe el Accesorio',
            'acctallerName.min' => 'El Accesorio tiene que tener al menos 3 caracteres',

        ];

        $this->validate($rules, $messages);
        $accesorio = accesoriostaller::find($this->selected_id);
        $accesorio->update(['name' => $this->acctallerName]);
        // dd($Dependencias);
        $this->resetUI();
        $this->emit('accesorio-updated', 'Se actualizo El Accesorio con exito');
    }
    public function resetUI()
    {
        $this->acctallerName = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
        //para regresar a la pagina principal
        $this->resetPage();
        $this->emit('accesorio-close', 'Accesorio cerrar');
    }
    protected $listeners = ['deleteRow' => 'Destroy'];
    public function Destroy(accesoriostaller $accesorio)
    {   
        if($accesorio){
            $data = tallerdetalle::where('acctaller_id', $accesorio->id)->count();
            //validar si tiene vehiculos asignados
            if($data > 0 ) {
                $this->emit('accesorio-nodeleted','No es posible eliminar el accesorio por que se uso ');
            } else {
                $accesorio->delete();
                $this->resetUI();
                $this->emit('accesorio-deleted', 'Accesorio Eliminado');
            }
        }

    }
}
