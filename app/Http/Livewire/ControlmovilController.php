<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Taller;
use App\Models\accesoriostaller;
use App\Models\Conductor;
use App\Models\Vehiculos;
use App\Models\tallerdetalle;
use App\Models\Dependencia;
use App\Models\Diagnostico;
use App\Models\Controlmovil;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Estadovehiculo;
use App\Models\TrabajoRealizadoTaller;
use Database\Seeders\TallerDetallerSeeder;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;    

class ControlmovilController extends Component
{
    use WithPagination;

    public $TallerName, $search, $selected_id, $pageTitle, $componentName, $check = [];
    public $ingreso, $fecha, $hora_salida, $hora_retorno, $conductorname, $vehiculo, $color,
        $dependencia, $placa, $kilometraje_salida, $kilometraje_regreso, $combustible, $tipo_actividad, $firma;
    //vehiculo
    public $clase, $tipo_vehiculo, $conductor, $vehiculos_id;
    //select2
    public $vehiculoselectedId, $vehiculoselectedName, $vehiculodatos;
    //vehiculocontrol
    public $vehiculocontrol, $vehiculomes;
    //estado de vehiculo img
    public $estadovehiculo = [];
    //responsable
    public $responsable, $responsableu;


    //numero de filas por pagina
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
        $this->componentName = 'Control Movil';
        $this->vehiculoselectedName = 'Elegir';
        $this->conductorname = 'Elegir';
        $this->dependencia = 'Elegir';
        $this->vehiculocontrol = 'Elegir';
        $this->vehiculomes = 'Elegir';

        //dd($this->ingreso, $this->fecha_ingreso);
        //     $this->check=[
        //         "12, Estuche de Herramientas",
        // "18, Luz de Placa"
        //     ];
    }
    public function render()
    {
        //validar si el usuario ingreso informacion
        if (strlen($this->search) > 0)
            $Control = Controlmovil::where('placa', 'like', '%' . $this->search . '%')
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);
        else
            $Control = Controlmovil::orderBy('id', 'desc')->paginate($this->pagination);

        //dd($Control);
        $this->vehiculodatos = Vehiculos::orderby('id', 'desc')
            ->get();

        $this->responsableu= User::where('profile','like','%'.'Tecnico-Mecanico'.'%')
        ->orderby('name', 'asc')
        ->get();

        $this->conductor = Conductor::orderby('name', 'asc')
        ->get();
        //dd($this->vehiculodatos);

        //dd($this->vehiculoselectedName);

        return view('livewire.controlmovil.component', [
            'control' => $Control,
            'vehiculodatos' => $this->vehiculodatos,
            'conductor' => $this->conductor,
            'responsableu'=> $this->responsableu,
            'dependencias' => Dependencia::orderby('nombre', 'asc')->get()
        ])
            //extender de layouts
            ->extends('layouts.theme.app')
            //renderizarse
            ->section('content');
    }

    protected $listeners = [
        'destroy' => 'Destroy',
        'resetUI' => 'resetUI',
    ];
    public function resetUI()
    {
        //dd($this->check);
        $this->TallerName = '';
        $this->fecha = '';
        $this->hora_salida = '';
        $this->hora_retorno = '';
        $this->conductorname = '';
        $this->vehiculo = '';
        $this->color = '';
        $this->dependencia = '';
        $this->placa = '';
        $this->kilometraje_salida = '';
        $this->kilometraje_regreso = '';
        $this->combustible = '';
        $this->tipo_actividad = '';
        $this->firma = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->vehiculoselectedName = null;
        $this->estadovehiculo = [];
        $this->clase = '';
        $this->tipo_vehiculo = '';
        $this->responsable='';

        $this->resetValidation();
        $this->resetPage();

        $this->emit('control-close', 'control cerrar');
        //dd($this->check);
    }

    public function checks()
    {
        dd($this->check);
    }

    public function Store(Request $request)
    {
        // dd($this->vehiculoselectedId);
        // para eliminar casillas que esten vacias
        // dd($this->estadovehiculo);
 
        //dd($this->estadovehiculo);
        //dd($this->acctaller);
        //dd($this->check);
        
        //dd($request);
        $rules = [
            'conductorname' => 'required|not_in:Elegir',
            'dependencia' => 'required|min:3|not_in:Elegir',
  
            'responsable' => 'required|not_in:Elegir'
        ];

        $messages = [
            'conductorname.required' => 'ingrese el nombre',
            'conductorname.not_in' => 'Seleccione el conductor',
            'dependencia.required' => 'Ingrese la dependencia',
            'dependencia.min' => 'Dependencia debe tener al menos 3 caracteres',
            'dependencia.not_in' => 'Seleccione la dependencia',

            'responsable.required' => 'Ingrese el responsable',
            'responsable.not_in' => 'Seleccione el responsable'
        ];
        //validar los datos
        $this->validate($rules, $messages);
        
       
        //dd($this->vehiculoselectedId, $this->responsable);
        try {
            //guardar
            $talleres = Controlmovil::create([
                'conductor' => $this->conductorname,
                'vehiculo' => $this->vehiculo,
                'color' => $this->color,
                'dependencia' => $this->dependencia,
                'placa' => strtoupper($this->placa),
                'hora_salida' => $this->hora_salida,
                'km_salida' => $this->kilometraje_salida,     
                'km_regreso' => $this->kilometraje_regreso,           
                'combustible' => $this->combustible,
                'tipo_destino' => $this->tipo_actividad,
                'vehiculo_id' => $this->vehiculoselectedId,
                'clase' => $this->clase,
                'tipo_vehiculo' => $this->tipo_vehiculo,
                'responsable'=>$this->responsable,

                //'user_id' => Auth()->user()->id
            ]);
            //dd($talleres);
            //validar si se guardo
            
            //confirma la transaccion
            DB::commit();

            //limpiar el carrito y reinicar las variables


            $this->emit('control-ok', 'recepcion registrada con exito');
            //$this->emit('print-ticket', $talleres->id);
            $this->resetUI();
        } catch (Exception $e) {
            //borrar las acciones incompletas
            DB::rollback();
            $this->emit('control-error', $e->getMessage());
        }
    }



    public function Edit(Controlmovil $taller)
    {
        //dd($this->check);
        //dd($taller);

        $this->selected_id = $taller->id;
        $this->fecha = $taller->created_at;
        $this->hora_salida = $taller->hora_salida;
        $this->hora_retorno = $taller->hora_retorno;
        $this->conductorname = $taller->conductor;
        $this->vehiculo = $taller->vehiculo;
        $this->color = $taller->color;
        $this->dependencia = $taller->dependencia;
        //dd($this->dependencia);
        $this->placa = $taller->placa;
        $this->kilometraje_salida = $taller->km_salida;
        $this->kilometraje_regreso = $taller->km_regreso;
        $this->tipo_actividad = $taller->tipo_destino;
        $this->clase = $taller->clase;
        $this->combustible= $taller->combustible;
        $this->tipo_vehiculo = $taller->tipo_vehiculo;
        $this->responsable=$taller->responsable;
        $this->vehiculos_id = $taller->vehiculo_id;
        
        //dd($this->estadovehiculo);
        $this->emit('show-modal', 'open!');
    }

    public function Update()
    {
        //dd($this->fecha_salida, $this->salida);
        //eliminar casillas vacias que tengamos
        
        $rules = [
            'conductorname' => 'required|not_in:Elegir',
            'dependencia' => 'required|min:3|not_in:Elegir',
            'responsable' => 'required|not_in:Elegir'
        ];

        $messages = [
            'conductorname.required' => 'ingrese el nombre',
            'conductorname.not_in' => 'Seleccione el conductor',
            'dependencia.required' => 'Ingrese la dependencia',
            'dependencia.min' => 'Dependencia debe tener al menos 3 caracteres',
            'dependencia.not_in' => 'Seleccione la dependencia',

            'responsable.required' => 'Ingrese el responsable',
            'responsable.not_in' => 'Seleccione el responsable'
        ];
        //validar los datos
        $this->validate($rules, $messages);
        //dd($this->vehiculoselectedId);
        //buscar por el id
        $talleres = Controlmovil::find($this->selected_id);
        
        try {
            //guardar
            $talleres->update([

                'conductor' => $this->conductorname,
                'vehiculo' => $this->vehiculo,
                'color' => $this->color,
                'dependencia' => $this->dependencia,
                'placa' => strtoupper($this->placa),
                'hora_salida' => $this->hora_salida,
                'km_salida' => $this->kilometraje_salida,     
                'km_regreso' => $this->kilometraje_regreso,           
                'combustible' => $this->combustible,
                'tipo_destino' => $this->tipo_actividad,
                'vehiculo_id' => $this->vehiculos_id,
                'clase' => $this->clase,
                'tipo_vehiculo' => $this->tipo_vehiculo,
                'responsable'=>$this->responsable,

                //'user_id' => Auth()->user()->id
            ]);
            //dd($talleres->id);
            //validar si se guardo

            //confirma la transaccion
            DB::commit();

            //limpiar el carrito y reinicar las variables


            $this->emit('control-ok', 'recepcion actualizada con exito');
            //$this->emit('print-ticket', $talleres->id);


            $this->resetUI();
        } catch (Exception $e) {
            //borrar las acciones incompletas
            DB::rollback();
            $this->emit('control-error', $e->getMessage());
        }
    }

    public function Destroy($id)
    {
        // dd($id);
        //defininar permisos 
        //cantidad de permisos que tiene
        $diagtaller_id = Diagnostico::where('taller_id', $id)->count();
        $trabajotaller_id = TrabajoRealizadoTaller::where('taller_id', $id)->count();
        if (($diagtaller_id > 0) || ($trabajotaller_id > 0)) {
            $this->emit('control-nodeleted', 'No se puede eliminar, por que se esta usando');
            //dd($diagtaller_id, $trabajotaller_id);
        } else {
            //dd($diagtaller_id, $trabajotaller_id);  
            tallerdetalle::where('taller_id', $id)->delete();
            Estadovehiculo::where('taller_id', $id)->delete();
            Taller::find($id)->delete();

            $this->emit('control-deleted', 'Se elimino la RECEPCION DE VEHICULO con exito');
        }

        //dd('hola');


    }

    public function showDatos()
    {


        $this->fecha = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->hora_salida = Carbon::parse(Carbon::now())->format('H:i');
        
        //dd($this->vehiculoselectedId);
        //dd($this->vehiculoselectedName, $this->vehiculoselectedId);
        $findvehiculo = Vehiculos::where('vehiculos.id', $this->vehiculoselectedId)
            ->first();
        //dd($findvehiculo);
        $this->placa = $findvehiculo->placa;
        $this->vehiculo = $findvehiculo->marca;
        $this->color = $findvehiculo->color;
        $this->clase = $findvehiculo->clase;
        $this->tipo_vehiculo = $findvehiculo->tipo_vehiculo;

        $this->vehiculos_id = $findvehiculo->id;
        //obtencion de los accesorios que tiene el vehiculo
        //para traer el id del ultimo taller del vehiculo que se tiene el id
        $ultivehiculo = Taller::where('vehiculo_id', $this->vehiculoselectedId)
            ->orderBy('id', 'desc')
            ->first();
       
        $this->emit('show-modal', 'open!');
    }

    

    public function salida($id)
    {
        $talleres = Taller::find($id);
        $f_salida = Carbon::parse(Carbon::now())->format('Y-m-d');
        $h_salida = Carbon::parse(Carbon::now())->format('H:i');
        //guardar
        $talleres->update([

            'salida' => $h_salida,
            'fecha_salida' => $f_salida,
        ]);
        //dd('hola');
        //return view('home');
        return redirect('trabajorealizadotaller');
    }
}
