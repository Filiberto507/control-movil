<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use DB;


class PermisosController extends Component
{
    use WithPagination;

    public $permissionName, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 10;

    //traer el paginacion de bootstrap
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    //agregar las propiedades del componente
    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Permisos';
    }

    public function render()
    {
        //validar si el usuario ingreso informacion
        if(strlen($this->search) > 0)
            //buscar el dato
            $permisos = Permission::where('name', 'like', '%' . $this->search . '&')->paginate($this->pagination);
      
        else
            $permisos = Permission::orderBy('name', 'asc')->paginate($this->pagination);
        
            


        return view('livewire.permisos.component',[
            'permisos' => $permisos
        ])
        //extender de layouts
        ->extends('layouts.theme.app')
        //renderizarse
        ->section('content');
    }

    //crear role
    public function CreatePermission()
    {
        //validaciones
        $rules = ['permissionName' => 'required|min:2|unique:permissions,name'];

        //mensajes
        $messages = [
            'permissionName.required' => 'El nombre del permiso es requerido',
            'permissionName.unique' => 'El permiso ya existe',
            'permissionName.min' => 'el nombre del permiso debe tener al menos 2 catacteres'
        ];

        //validar si estan bien 
        $this->validate($rules, $messages);
        //crear el rol
        Permission::create(['name' => $this->permissionName]);
        

        $this->emit('permiso-added', 'Se registro el permiso con exito');
        $this->resetUI();
    }

    //metodo editar

    public function Edit(Permission $permiso)
    {
        //buscar el rol antiguo
        //$role = Role::find($id);
        //mandar los datos a los propiedades
        $this->selected_id = $permiso->id;
        $this->permissionName = $permiso->name;

        //emitir un evento a una ventada modal
        $this->emit('show-modal', ' Show modal');
    }

    //actualizar datos
    public function UpdatePermission()
    {
        //validaciones
        $rules = ['permissionName' => "required|min:2|unique:permissions,name, {$this->selected_id}"];

        //mensajes
        $messages = [
            'permissionName.required' => 'El nombre del permiso es requerido',
            'permissionName.unique' => 'El permiso ya existe',
            'permissionName.min' => 'el nombre del permiso debe tener al menos 2 catacteres'
        ];

        $this->validate($rules, $messages);

        //busqueda del rol
        $permiso = Permission::find($this->selected_id);
        $permiso->name = $this->permissionName;
        //guardar rol 
       $permiso->save();

       $this->emit('permiso-updated', 'Se actualizo el permiso con exito');
       $this->resetUI();
    }

    //lesteners

    protected $listeners = ['destroy' => 'Destroy'];

    public function Destroy($id)
    {
        
        //defininar permisos 
        //cantidad de permisos que tiene
        $RolesCount = Permission::find($id)->getRoleNames()->count();
        //dd($RolesCount);
        //si es mayor a 0, tenemos roles asociados a nuestro permiso
        if($RolesCount > 0)
        {
            dd('hola');
            $this->emit('permiso-error', 'No se puede eliminar el permiso por que tiene permisos asociados');
            //para detener el flujo de procesos
            return;
        }
        //si no tiene nada asociado, se elimina el permiso
        Permission::find($id)->delete();
        $this->emit('permiso-deleted', 'Se elimino el permiso con exito');
        
    }

    //asignar roles
    /*public function AsignarRoles($rolesList)
    {
        if($this->userSelected > 0)
        {
            //buscar usuario
            $user = User::find($this->userSelected);
            //validacion si es vacio o no
            if($user){
                $user->syncRoles($rolesList);
                $this->emit('msg-ok', 'Roles asginados correctamente');
                $this->resetinput();
            }
        }
    }*/

    public function resetUI()
    {
        $this->permissionName ='';
        $this->search ='';
        $this->selected_id =0;
        $this->resetValidation();
        $this->emit('permiso-close', 'permiso cerrado');
    }
}
