<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use DB;


class RolesController extends Component
{
    use WithPagination;

    public $roleName, $search, $selected_id, $pageTitle, $componentName;
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
        $this->componentName = 'Roles';
    }

    public function render()
    {
       //validar si el usuario ingreso informacion
        if(strlen($this->search) > 0)
            $roles = Role::where('name', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
        $roles = Role::orderBy('name', 'asc')->paginate($this->pagination);


        return view('livewire.roles.component',[
            'roles' => $roles
        ])
        //extender de layouts
        ->extends('layouts.theme.app')
        //renderizarse
        ->section('content');
    }

    //crear role
    public function CreateRole()
    {
        //validaciones
        $rules = ['roleName' => 'required|min:2|unique:roles,name'];

        //mensajes
        $messages = [
            'roleName.required' => 'El nombre del roles es requerido',
            'roleName.unique' => 'El role ya existe',
            'roleName.min' => 'el nombre del role debe tener al menos 2 catacteres'
        ];

        //validar si estan bien 
        $this->validate($rules, $messages);
        //crear el rol
        Role::create(['name' => $this->roleName]);
        

        $this->emit('role-added', 'Se registro el role con exito');
        $this->resetUI();
    }

    //metodo editar

    public function Edit(Role $role)
    {
        //buscar el rol con el metodo antiguo
        //$role = Role::find($id);
        //mandar los datos a los propiedades
        $this->selected_id = $role->id;
        $this->roleName = $role->name;

        //emitir un evento a una ventada modal
        $this->emit('show-modal', ' Show modal');
    }

    public function algo()
    {
        
        $this->emit('show-modal', ' Show modal');
    }

    //actualizar datos
    public function UpdateRole()
    {
        //validaciones
        $rules = ['roleName' => "required|min:2|unique:roles,name, {$this->selected_id}"];

        //mensajes
        $messages = [
            'roleName.required' => 'El nombre del role es requerido',
            'roleName.unique' => 'El role ya existe',
            'roleName.min' => 'el nombre del role debe tener al menos 2 catacteres'
        ];

        $this->validate($rules, $messages);

        //busqueda del rol
        $role = Role::find($this->selected_id);
        $role->name = $this->roleName;
        //guardar rol 
       $role->save();

       $this->emit('role-updated', 'Se actualizo el role con exito');
       $this->resetUI();
    }

    //lesteners

    protected $listeners = ['destroy' => 'Destroy'];

    public function Destroy($id)
    {
        //defininar permisos 
        //cantidad de permisos que tiene
        $permissionsCount = Role::find($id)->permissions->count();
        //dd($permissionsCount);
        if($permissionsCount > 0)
        {
            $this->emit('role-error', 'No se puede eliminar el rol por que tiene permisos asociados');
            //para detener el flujo de procesos
            return;
        }

        Role::find($id)->delete();
        $this->emit('role-deleted', 'Se elimino el role con exito');
        
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
        $this->roleName ='';
        $this->search ='';
        $this->selected_id =0;
        $this->resetValidation();
        $this->emit('roles-close', 'roles cerrar');
    }
}
