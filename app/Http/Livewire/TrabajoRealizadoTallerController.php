<?php

namespace App\Http\Livewire;

use App\Models\TrabajoRealizadoTaller;
use App\Models\Taller;
use App\Models\accesoriostaller;
use App\Models\Conductor;
use App\Models\User;
use App\Models\Vehiculos;
use App\Models\tallerdetalle;
use App\Models\Diagnostico;
use App\Models\DiagnosticoItem;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class TrabajoRealizadoTallerController extends Component
{
    use WithPagination;

    public $TrabajoName, $fechataller, $search, $selected_id, $pageTitle, $componentName, $checkdiagnostico = []
    , $diagnostico_item;

    public $fecha_ingreso, $fecha_salida, $name, $vehiculo, $responsable,$responsableu, $taller_id,
        $dependencia, $placa, $km_ingreso, $km_salida, $descripcion, $observacion;

    //vehiculo
    public $clase, $tipo_vehiculo;

    //select2
    public $vehiculoselectedId, $vehiculoselectedName, $vehiculodatos;

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
        $this->componentName = 'Trabajo Realizado';
        $this->vehiculoselectedName = 'Elegir';

    }

    public function render()
    {
         //validar si el usuario ingreso informacion
         if (strlen($this->search) > 0)
         $trabajo = TrabajoRealizadoTaller::where('placa', 'like', '%' . $this->search . '%')
         ->orderBy('id', 'desc')
         ->paginate($this->pagination);
        else
         $trabajo = TrabajoRealizadoTaller::orderBy('id', 'desc')->paginate($this->pagination);


     $this->vehiculodatos = Taller::leftJoin('trabajo_realizado_tallers as tr', 'tr.taller_id', 'tallers.id')
        ->join('diagnosticos as di', 'di.taller_id', 'tallers.id')
        ->select('tallers.*')
        ->whereNotNull('tallers.fecha_salida')
        ->whereNotNull('di.taller_id')
        ->whereNull('tr.taller_id')
        ->orderby('id', 'desc')
        ->get();

        $this->responsableu= User::where('profile','like','%'.'Tecnico-Mecanico'.'%')
        ->orderby('name', 'asc')
        ->get();
     //dd($this->vehiculodatos);

    //dd($this->diagnostico_item);

     return view('livewire.TrabajoRealizadoTaller.component', [
         'trabajor' => $trabajo,
         'vehiculodatos' => $this->vehiculodatos,
         'responsableu'=>$this->responsableu,
         'conductor' => Conductor::orderby('name', 'asc')->get()
     ])
         //extender de layouts
         ->extends('layouts.theme.app')
         //renderizarse
         ->section('content');
    }

    public function trabajodatos(Request $request){
       // dd($request);
        $datoRecibido = $request->input('id');
        //dd($datoRecibido);
        $findvehiculo = taller::where('id', $datoRecibido)
        ->first();
    //dd($findvehiculo);
    $this->placa = $findvehiculo->placa;
    $this->vehiculo = $findvehiculo->vehiculo;
    $this->dependencia = $findvehiculo->dependencia;
    $this->render();
    //$this->emit('show-modal', 'open!');
    
    }
    public function resetUI()
    {
        //dd($this->check);
        $this->TrabajoName = '';
        $this->fecha_ingreso = '';
        $this->fecha_salida = '';
        $this->name = '';
        $this->vehiculo = '';
        $this->dependencia = '';
        $this->responsable = '';
        $this->placa = '';
        $this->check = [];
        $this->search = '';
        $this->selected_id = 0;
        $this->vehiculoselectedName = null;
        $this->km_ingreso = '';
        $this->km_salida = '';
        $this->descripcion = '';
        $this->observacion=' ';
        $this->clase = '';
        $this->tipo_vehiculo = '';
        $this->diagnostico_item = '';
        $this->checkdiagnostico =[];
        $this->resetValidation();
        $this->resetPage();

        $this->emit('trabajos-close', 'taller cerrar');
        //dd($this->check);
    }

    protected $listeners =[
        'destroy' => 'Destroy',
        'resetUI' => 'resetUI'
    ];

    public function Edit(TrabajoRealizadoTaller $trabajosr)
    {
        $this->selected_id = $trabajosr->id;
        $this->vehiculo = $trabajosr->vehiculo;
        $this->placa = $trabajosr->placa;
        $this->responsable = $trabajosr->responsable;
        $this->dependencia = $trabajosr->dependencia;
        $this->fecha_ingreso = $trabajosr->fecha_ingreso;
        $this->fecha_salida = $trabajosr->fecha_salida;
        $this->km_ingreso = $trabajosr->km_ingreso;
        $this->km_salida = $trabajosr->km_salida;
        //$this->descripcion = $trabajosr->descripcion;
        $this->observacion = $trabajosr->observaciones;

        $diagnostico_taller = Diagnostico::where('taller_id', $trabajosr->taller_id)->first();
        //dd($diagnostico_taller);
        $this->checkdiagnostico = explode('-', $trabajosr->descripcion);
        //dd($this->checkdiagnostico);
        $this->diagnostico_item = DiagnosticoItem::where('diagnosticos_id', $diagnostico_taller->id)->get();
        //dd($this->diagnostico_item);
        $this->emit('show-modal', 'open!');
    }

    public function create_trabajo()
    {   
        //guardamos los checks habilitados 
        $this->descripcion = implode('-',$this->checkdiagnostico);
        //dd("hola");
        // dd($this->TallerName,
        // $this->ingreso,
        // $this->salida,
        // $this->fecha_ingreso,
        // $this->fecha_salida,
        // $this->name,
        // $this->vehiculo,
        // $this->color,
        // $this->dependencia,
        // $this->placa,
        // $this->kilometraje,
        // $this->ordentrabajo,
        // $this->check);
        $rules = [
            'dependencia' => 'required|min:3',
            'responsable' => 'required|min:3',
            'km_salida' => 'required|min:3',
            'fecha_salida' => 'required|min:3'
        ];

        $messages =[
            'dependencia.required' => 'Ingrese la dependencia',
            'dependencia.min' => 'Dependencia debe tener al menos 3 caracteres',
            'responsable.required' => 'Agregue el responsable',
            'responsable.min' => 'responsable debe tener al menos 3 caracteres',
            'km_salida.required' => 'Es requerido km_salida a realizar',
            'km_salida.min' => 'km_salida debe tener al menos 3 caracteres',
            'fecha_salida.required' => 'Es requerido Fecha Salida a realizar',
            'fecha_salida.min' => 'Fecha Salida debe tener al menos 3 caracteres',
        ];
        //validar los datos
        $this->validate($rules, $messages);
        
         //por año el numero se reiniciara 
         $ultimotrabajo = TrabajoRealizadoTaller::orderby('id', 'desc')->first();
         //dd($ultimotrabajo); //2023-07-21
 
         if($ultimotrabajo)
         {
             $fechaultimotrabajo=Carbon::parse($ultimotrabajo->fecha_ingreso)->format('Y');
         }
         else
         {
             $fechaultimotrabajo = Carbon::parse(Carbon::now())->format('Y');
         }
 
        //dd($fechaultimotrabajo);
 
         if ($ultimotrabajo && $fechaultimotrabajo == $this->fechataller ) {
             // Continuar incrementando el contador de números de diagnostico
             $numerotrabajo = $ultimotrabajo->numero_trabajo + 1;
         } else {
             // Comenzó un nuevo año, reiniciar el contador de números
             $numerotrabajo = 1;
         }

        //dd($numerotrabajo);
          //crear el usuario
        $trabajosr = TrabajoRealizadoTaller::create([
            'numero_trabajo' => $numerotrabajo,
            'vehiculo' => $this->vehiculo,
            'placa' => $this->placa,
            'responsable' => $this->responsable,
            'dependencia' => $this->dependencia,
            'fecha_ingreso' => $this->fecha_ingreso,
            'fecha_salida' => $this->fecha_salida,
            'km_ingreso' => $this->km_ingreso,
            'km_salida' => $this->km_salida,
            'descripcion' => $this->descripcion,
            'observaciones' => $this->observacion,
            'taller_id' => $this->taller_id,
        ]);

        $this->resetUI();
        $this->emit('trabajo-added', 'Reporte Diario Registrado');
    }

    public function UpdateTrabajo()
    {
       
        if($this->checkdiagnostico ){
            //dd($this->checkdiagnostico);
            $this->descripcion = implode('-',$this->checkdiagnostico);
        }
        
        $rules = [
            'dependencia' => 'required|min:3',
            'responsable' => 'required|min:3',
            'km_salida' => 'required|min:3',
        ];

        $messages =[
            'dependencia.required' => 'Ingrese la dependencia',
            'dependencia.min' => 'Dependencia debe tener al menos 3 caracteres',
            'responsable.required' => 'Agregue el responsable',
            'responsable.min' => 'responsable debe tener al menos 3 caracteres',
            'km_salida.required' => 'Es requerido km_salida a realizar',
            'km_salida.min' => 'km_salida debe tener al menos 3 caracteres',
        ];

        //validamos 
        $this->validate($rules, $messages);
        $trabajosr = TrabajoRealizadoTaller::find($this->selected_id);
        $trabajosr->Update([
            'responsable' => $this->responsable,
            'fecha_ingreso' => $this->fecha_ingreso,
            'fecha_salida' => $this->fecha_salida,
            'km_ingreso' => $this->km_ingreso,
            'km_salida' => $this->km_salida,
            'descripcion' => $this->descripcion,
            'observaciones' => $this->observacion,
        ]);

        
 
         $this->resetUI();
         $this->emit('trabajo-updated', 'Reporte Diario Actualizado');
    }


    public function showDatos()
    {


        //dd($this->vehiculoselectedId);
        //dd($this->vehiculoselectedName, $this->vehiculoselectedId);
        $findvehiculo = taller::where('id', $this->vehiculoselectedId)
            ->first();
        //dd($findvehiculo);
        $this->fechataller = Carbon::parse($findvehiculo->fecha_ingreso)->format('Y');
        $this->placa = $findvehiculo->placa;
        $this->vehiculo = $findvehiculo->clase . ' '. $findvehiculo->vehiculo . ' '. $findvehiculo->tipo_vehiculo;
        $this->dependencia = $findvehiculo->dependencia;
        $this->taller_id = $findvehiculo->id;
        $this->km_ingreso = $findvehiculo->kilometraje;
        $this->fecha_ingreso = $findvehiculo->fecha_ingreso;
        $this->fecha_salida = $findvehiculo->fecha_salida;
        
        $diagnostico_taller = Diagnostico::where('taller_id', $this->vehiculoselectedId)->first();
        //dd($diagnostico_taller);
        $this->diagnostico_item = DiagnosticoItem::where('diagnosticos_id', $diagnostico_taller->id)->get();
        //$this->diagnostico_item = accesoriostaller::orderBy('id', 'desc')->get();
        //dd($this->diagnostico_item);

        /*foreach ($this->diagnostico_item as $di)
        {
            $this->checkdiagnostico[] =
                    $di->id . ", " .
                    $di->descripcion;
        }*/
       // dd($this->checkdiagnostico);
       
        
       
    }

    public function Destroy($id)
    {
       //dd($id);
        //defininar permisos 
        //cantidad de permisos que tiene
        TrabajoRealizadoTaller::find($id)->delete();
        
        $this->emit('trabajo-deleted', 'Se elimino Trabajo Realizado DE VEHICULO con exito');
        
    }
}
