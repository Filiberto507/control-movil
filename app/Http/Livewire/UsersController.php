<?php

namespace App\Http\Livewire;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use App\Models\Sale;

class UsersController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name, $username, $phone, $email, $status, $image, $password, $selected_id, $fileLoaded, $profile;
    public $pageTitle, $componentName, $search;
    private $pagination = 3;

    function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    function mount()
    {
        $this->pageTitle ='Listado';
        $this->componentName = 'Usuarios';
        $this->status ='Elegir';
    }

  public function render()
    {
        if(strlen($this->search) > 0 )
            $data = User::where('name', 'like', '%' . $this->search . '%')
            ->select('*')->orderBy('name', 'asc')->paginate($this->pagination);
        else
            $data = User::select('*')->orderBy('name', 'asc')->paginate($this->pagination);

        return view('livewire.users.component',[
            'data' => $data,
            'roles' => Role::orderBy('name','asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function resetUI()
    {
        $this->name ='';
        $this->username ='';
        $this->email ='';
        $this->password ='';
        $this->phone ='';
        $this->image ='';
        $this->search ='';
        $this->status ='';
        $this->selected_id =0;
        $this->resetValidation();
        //para regresar a la pagina principal
        $this->resetPage();
        $this->emit('user-close', 'usuario cerrado');
    }

    public function Edit(User $user)
    {
        $this->selected_id = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->phone = $user->phone;
        $this->profile = $user->profile;
        $this->status = $user->status;
        $this->email = $user->email;
        $this->password = '';


        $this->emit('show-modal', 'open!');
    }

    protected $listeners =[
        'deleteRow' => 'Destroy',
        'resetUI' => 'resetUi'
    ];

    //metodo d agregar usuarios
    public function Store()
    {
        $rules = [
            'name' => 'required|min:3',
            'username' => 'required|min:3|unique:users,username',
            'email' => 'required|unique:users,email',
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:3'
        ];

        $messages =[
            'name.required' => 'ingrese el nombre',
            'name.min' => 'El nombre tiene que tener al menos 3 caracteres',
            'username.required' => 'ingrese el nombre usuario',
            'username.min' => 'El nombre usuario tiene que tener al menos 3 caracteres',
            'username.unique' => 'El nombre usuario ya existe en el sistema',
            'email.required' => 'Ingrese el corre',
            'email.email' => 'Ingrese un correo valido',
            'email.unique' => 'El email ya existe en el sistema',
            'status.required' => 'Seleccione el estatus del usuario',
            'status.not_in' => 'Selecciona el estatus',
            'profile.required' => 'Selecciona el perfil/role del usuario',
            'profile.not_in' => 'Selecciona un perfil/role distinto a Elegir',
            'password.required' => 'Ingresa el password',
            'password.min' => 'El password debe tener al menos 3 catacteres'
        ];
        //validar los datos
        $this->validate($rules, $messages);
        //crear el usuario
        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'profile' => $this->profile,
            'password' => bcrypt($this->password)
        ]);

        //para el rol
        $user->syncRoles($this->profile);
        //validar img
        if($this->image)
        {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $user->image = $customFileName;
            $user->save();   
        }

        $this->resetUI();
        $this->emit('user-added', 'Usuario Registrado');
    }

    //metodo actualizar
    public function Update()
    {
        $rules = [
            //validar para que no exista el mismo correo
            'email' => "required|email|unique:users,email,{$this->selected_id}",
            'name' => 'required|min:3',
            'username' => "required|min:3|unique:users,username,{$this->selected_id}",
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:3'
        ];

        $messages =[
            'name.required' => 'ingrese el nombre',
            'name.min' => 'El binvre dek usuarios tiene que tener al menos 3 caracteres',
            'username.required' => 'ingrese el nombre usuario',
            'username.min' => 'El nombre usuario tiene que tener al menos 3 caracteres',
            'username.unique' => 'El nombre usuario ya existe en el sistema',
            'email.required' => 'Ingrese el corre',
            'email.email' => 'Ingrese un correo valido',
            'email.unique' => 'El email ya existe en el sistema',
            'status.required' => 'Seleccione el estatus del usuario',
            'status.not_in' => 'Selecciona el estatus',
            'profile.required' => 'Selecciona el perfil/role del usuario',
            'profile.not_in' => 'Selecciona un perfil/role distinto a Elegir',
            'password.required' => 'Ingresa el password',
            'password.min' => 'El password debe tener al menos 3 catacteres'
        ];

        //validamos 
        $this->validate($rules, $messages);
        $user = User::find($this->selected_id);
        $user->Update([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'profile' => $this->profile,
            'password' => bcrypt($this->password)
        ]);

        //para el rol
        $user->syncRoles($this->profile);
         //validar img
         if($this->image)
         {
             $customFileName = uniqid() . '_.' . $this->image->extension();
             $this->image->storeAs('public/users', $customFileName);
             $imageTemp = $user->image;
             $user->image = $customFileName;
             $user->save();   
            // validar si existe una imagen
             if($imageTemp !=null)
             {
                //buscar la imagen existente
                if(file_exists('storage/users/' . $imageTemp))
                {
                    unlink('storage/users/' . $imageTemp);
                }
             }

         }
 
         $this->resetUI();
         $this->emit('user-updated', 'Usuario Actualizado');
    }

    //metodo eliminar
    public function Destroy(User $user)
    {
        
                $user->delete();
                $this->resetUI();
                $this->emit('user-deleted', 'Usuario Eliminado');
            
        
    }
}