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
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Estadovehiculo;
use App\Models\TrabajoRealizadoTaller;
use Database\Seeders\TallerDetallerSeeder;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TallerController extends Component
{
    use WithPagination;

    public $TallerName, $search, $selected_id, $pageTitle, $componentName, $check = [];
    public $ingreso, $salida, $fecha_ingreso, $fecha_salida, $conductorname, $vehiculo, $color,
        $dependencia, $placa, $kilometraje, $ordentrabajo, $acctaller, $acctaller2;

    //vehiculo
    public $clase, $tipo_vehiculo;
    //select2
    public $vehiculoselectedId, $vehiculoselectedName, $vehiculodatos;

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
        $this->componentName = 'Taller';
        $this->vehiculoselectedName = 'Elegir';
        $this->conductorname = 'Elegir';
        $this->dependencia = 'Elegir';

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
            $Taller = Taller::where('placa', 'like', '%' . $this->search . '%')
                ->orderBy('id', 'desc')
                ->paginate($this->pagination);
        else
            $Taller = Taller::orderBy('id', 'desc')->paginate($this->pagination);
        $this->acctaller = accesoriostaller::orderBy('id', 'asc')->get();

        $this->vehiculodatos = Vehiculos::orderby('id', 'desc')
            ->get();

        $this->responsableu= User::where('profile','like','%'.'Tecnico-Mecanico'.'%')
        ->orderby('name', 'asc')
        ->get();
        //dd($this->vehiculodatos);

        //dd($this->vehiculoselectedName);

        return view('livewire.taller.component', [
            'taller' => $Taller,
            'acctaller' => $this->acctaller,
            'vehiculodatos' => $this->vehiculodatos,
            'conductor' => Conductor::orderby('name', 'asc')->get(),
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
        $this->ingreso = '';
        $this->salida = '';
        $this->fecha_ingreso = '';
        $this->fecha_salida = '';
        $this->conductorname = '';
        $this->vehiculo = '';
        $this->color = '';
        $this->dependencia = '';
        $this->placa = '';
        $this->kilometraje = '';
        $this->ordentrabajo = '';
        $this->check = [];
        $this->search = '';
        $this->selected_id = 0;
        $this->vehiculoselectedName = null;
        $this->estadovehiculo = [];
        $this->clase = '';
        $this->tipo_vehiculo = '';
        $this->responsable='';

        $this->resetValidation();
        $this->resetPage();

        $this->emit('tallers-close', 'taller cerrar');
        //dd($this->check);
    }

    public function checks()
    {
        dd($this->check);
    }

    public function create_taller(Request $request)
    {
        // dd($this->vehiculoselectedId);
        // para eliminar casillas que esten vacias
        // dd($this->estadovehiculo);
        foreach ($this->estadovehiculo as $value) {

            if ($value["descripcion"] == "") {
                $this->estadovehiculo = array_filter($this->estadovehiculo, function ($value) {
                    return !empty($value["descripcion"]);
                });
            }
        }
        //dd($this->estadovehiculo);
        //dd($this->acctaller);
        //dd($this->check);
        // dd($this->TallerName,
        // $this->ingreso,
        // $this->salida,
        // $this->fecha_ingreso,
        // $this->fecha_salida,
        // $this->conductorname,
        // $this->vehiculo,
        // $this->color,
        // $this->dependencia,
        // $this->placa,
        // $this->kilometraje,
        // $this->ordentrabajo,
        // $this->check);
        //dd($request);
        $rules = [
            'conductorname' => 'required|not_in:Elegir',
            'dependencia' => 'required|min:3|not_in:Elegir',
            'kilometraje' => 'required|min:3',
            'responsable' => 'required|not_in:Elegir'
        ];

        $messages = [
            'conductorname.required' => 'ingrese el nombre',
            'conductorname.not_in' => 'Seleccione el conductor',
            'dependencia.required' => 'Ingrese la dependencia',
            'dependencia.min' => 'Dependencia debe tener al menos 3 caracteres',
            'dependencia.not_in' => 'Seleccione la dependencia',
            'kilometraje.required' => 'Agregue el kilometraje',
            'kilometraje.min' => 'Kilometraje debe tener al menos 3 caracteres',
            'responsable.required' => 'Ingrese el responsable',
            'responsable.not_in' => 'Seleccione el responsable'
        ];
        //validar los datos
        $this->validate($rules, $messages);

        //por año el numero se reiniciara 
        $ultimotaller = Taller::orderby('id', 'desc')->first();
        //dd($ultimotaller); //2023-07-21

        if($ultimotaller)
        {
            $fechaultimotaller=Carbon::parse($ultimotaller->fecha_ingreso)->format('Y');
        }
        else
        {
            $fechaultimotaller = Carbon::parse(Carbon::now())->format('Y');
        }
        //dd(Carbon::parse($this->fecha_ingreso)->format('Y'));
       //dd($fechaultimotaller);   

        if ($ultimotaller && $fechaultimotaller == Carbon::parse($this->fecha_ingreso)->format('Y') ) {
            // Continuar incrementando el contador de números de diagnostico
            $numerotaller = $ultimotaller->numero_taller + 1;
        } else {
            // Comenzó un nuevo año, reiniciar el contador de números
            $numerotaller = 1;
        }
        //dd($numerotaller);
        try {
            //guardar
            $talleres = Taller::create([
                'numero_taller' => $numerotaller,
                'ingreso' => $this->ingreso,
                'fecha_ingreso' => $this->fecha_ingreso,
                'conductor' => $this->conductorname,
                'vehiculo' => $this->vehiculo,
                'color' => $this->color,
                'dependencia' => $this->dependencia,
                'placa' => strtoupper($this->placa),
                'kilometraje' => $this->kilometraje,
                'ordentrabajo' => $this->ordentrabajo,
                'vehiculo_id' => $this->vehiculoselectedId,
                'clase' => $this->clase,
                'tipo_vehiculo' => $this->tipo_vehiculo,
                'responsable'=>$this->responsable,

                //'user_id' => Auth()->user()->id
            ]);
            //dd($talleres);
            //validar si se guardo
            if ($talleres) {
                //guardar detalle de recepcion
                $items = $this->check;
                //dump($items);
                foreach ($items as $item) {
                    //dump(explode(',', $item)[0]);
                    //explide -> divide una cadena usando un separador que definas en este caso la ,
                    tallerdetalle::create([

                        'acctaller_id' => explode(',', $item)[0],
                        'taller_id' => $talleres->id
                    ]);
                }

                //estado vehiculo
                foreach ($this->estadovehiculo as $key => $value) {
                    //agregamos a la tabla 
                    Estadovehiculo::create([
                        'descripcion' => $value["descripcion"],
                        'taller_id' => $talleres->id,
                        'key' => $key
                    ]);
                }
            }
            //confirma la transaccion
            DB::commit();

            //limpiar el carrito y reinicar las variables


            $this->emit('taller-ok', 'recepcion registrada con exito');
            //$this->emit('print-ticket', $talleres->id);
            $this->resetUI();
        } catch (Exception $e) {
            //borrar las acciones incompletas
            DB::rollback();
            $this->emit('taller-error', $e->getMessage());
        }
    }



    public function Edit(Taller $taller)
    {
        //dd($this->check);
        //dd($taller);

        $this->selected_id = $taller->id;
        $this->ingreso = $taller->ingreso;
        $this->salida = $taller->salida;
        $this->fecha_ingreso = $taller->fecha_ingreso;
        $this->fecha_salida = $taller->fecha_salida;
        $this->conductorname = $taller->conductor;
        $this->vehiculo = $taller->vehiculo;
        $this->color = $taller->color;
        $this->dependencia = $taller->dependencia;
        //dd($this->dependencia);
        $this->placa = $taller->placa;
        $this->kilometraje = $taller->kilometraje;
        $this->ordentrabajo = $taller->ordentrabajo;
        $this->clase = $taller->clase;
        $this->tipo_vehiculo = $taller->tipo_vehiculo;
        $this->responsable=$taller->responsable;
        //separar el texto para el pdf
        $separador = "\n"; // Usar salto de línea
        $separada = explode($separador, $this->ordentrabajo);
        //dd($separada);
        $acctalleres = accesoriostaller::orderBy('id', 'asc')->get();

        //dd($acctaller);
        //foreach para agregar si tiene el checked
        foreach ($acctalleres as $tall) {
            //buscado el id del taller
            $tallerid = Taller::find($this->selected_id);
            //dd($tallerherr->id);
            //obtenemos todos los id de las herramientas que tiene el taller id
            $tallerherramientas = tallerdetalle::where('taller_id', $tallerid->id)->get();
            //dd($tallerherramientas);

            //buscamos si existe esa herramienta agregado o no
            $obtenercheck = $tallerherramientas->where('acctaller_id', $tall->id)->first();
            //dump($obtenercheck);
            //exists sirve para obtener valor en boleano
            //$this->roles()->where('nombre', $nombreRol)->exists();

            // verificar si tenemos datos en obtenercheck
            if ($obtenercheck) {
                //dump($obtenercheck->acctaller_id);
                $addcheck = accesoriostaller::find($obtenercheck->acctaller_id);
                //dump($addcheck);
                $tall->checked = 1;
                $this->check[] =
                    $addcheck->id . ", " .
                    $addcheck->name;

                //$acctalleres->pull($tall->id);
            }
        }

        //separar el arreglo
        //$acctalleres = range(1, 30); // Arreglo con 30 elementos
        //dd($acctalleres);


        //la funcion chunk divide el segmento segun el rango especificado
        $segmentos = $acctalleres->chunk($acctalleres->count() / 3);
        //dd($segmentos);

        $primeros10 = $segmentos[0];
        $segundos10 = $segmentos[1];
        //la funcion collect() + ->concat() ayudar a concadenar una coleccion
        $ultimos10 = $segmentos[2];

        //dd($primeros10, $segundos10, $ultimos10);

        //dd($this->check);
        $this->acctaller = $acctalleres;
        //dd($this->check);

        //traer las descripciones de los estados del vehiculo

        $datosestadovehiculo = Estadovehiculo::where('taller_id', $this->selected_id)->get();

        foreach ($datosestadovehiculo as $value) {
            $this->estadovehiculo[$value->key] = [
                'descripcion' => $value->descripcion,
            ];
        }
        //dd($this->estadovehiculo);
        $this->emit('show-modal', 'open!');
    }

    public function UpdateTaller()
    {
        //dd($this->fecha_salida, $this->salida);
        //eliminar casillas vacias que tengamos
        foreach ($this->estadovehiculo as $value) {

            if ($value["descripcion"] == "") {
                $this->estadovehiculo = array_filter($this->estadovehiculo, function ($value) {
                    return !empty($value["descripcion"]);
                });
            }
        }
        $rules = [
            'conductorname' => 'required|not_in:Elegir',
            'dependencia' => 'required|min:3|not_in:Elegir',
            'kilometraje' => 'required|min:3',
            'responsable' => 'required|not_in:Elegir'
        ];

        $messages = [
            'conductorname.required' => 'ingrese el nombre',
            'conductorname.not_in' => 'Seleccione el conductor',
            'dependencia.required' => 'Ingrese la dependencia',
            'dependencia.min' => 'Dependencia debe tener al menos 3 caracteres',
            'dependencia.not_in' => 'Seleccione la dependencia',
            'kilometraje.required' => 'Agregue el kilometraje',
            'kilometraje.min' => 'Kilometraje debe tener al menos 3 caracteres',
            'responsable.required' => 'Ingrese el responsable',
            'responsable.not_in' => 'Seleccione el responsable'
        ];
        //validar los datos
        $this->validate($rules, $messages);
        //dd($this->estadovehiculo);
        //buscar por el id
        $talleres = Taller::find($this->selected_id);

        try {
            //guardar
            $talleres->update([

                'ingreso' => $this->ingreso,
                'salida' => $this->salida,
                'fecha_ingreso' => $this->fecha_ingreso,
                'fecha_salida' => $this->fecha_salida,
                'conductor' => $this->conductorname,
                'vehiculo' => $this->vehiculo,
                'color' => $this->color,
                'dependencia' => $this->dependencia,
                'placa' => $this->placa,
                'kilometraje' => $this->kilometraje,
                'ordentrabajo' => $this->ordentrabajo,
                'clase' => $this->clase,
                'tipo_vehiculo' => $this->tipo_vehiculo,
                'responsable'=>$this->responsable,
                //'user_id' => Auth()->user()->id
            ]);
            //dd($talleres->id);
            //validar si se guardo
            if ($talleres) {
                //actualizar detalle de checkbox de recepcion
                //dd($this->selected_id);
                $itemscheck = tallerdetalle::where('taller_id', $this->selected_id)->get();
                $this->agregarcheck($itemscheck, $this->check, $this->selected_id);
                $checksnuevos = $this->check;
                $this->eliminarcheck($itemscheck, $this->check);
                //dd($this->check);
                //dump($items);

                //actualizar estado vehiculo
                $comentestado = Estadovehiculo::where('taller_id', $this->selected_id)->get();
                //dd($comentestado);
                $this->agregarestadoauto($comentestado, $this->estadovehiculo, $this->selected_id);
                $this->eliminarestadoauto($comentestado, $this->estadovehiculo, $this->selected_id);
            }
            //confirma la transaccion
            DB::commit();

            //limpiar el carrito y reinicar las variables


            $this->emit('taller-ok', 'recepcion actualizada con exito');
            //$this->emit('print-ticket', $talleres->id);

            if (($this->fecha_salida != null) && ($this->salida != null)) {
                //dd("hola");
                //return redirect()->route('trabajorealizadotaller');
            }

            $this->resetUI();
        } catch (Exception $e) {
            //borrar las acciones incompletas
            DB::rollback();
            $this->emit('taller-error', $e->getMessage());
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
            $this->emit('taller-nodeleted', 'No se puede eliminar, por que se esta usando');
            //dd($diagtaller_id, $trabajotaller_id);
        } else {
            //dd($diagtaller_id, $trabajotaller_id);  
            tallerdetalle::where('taller_id', $id)->delete();
            Estadovehiculo::where('taller_id', $id)->delete();
            Taller::find($id)->delete();

            $this->emit('taller-deleted', 'Se elimino la RECEPCION DE VEHICULO con exito');
        }

        //dd('hola');


    }

    public function showDatos()
    {


        $this->fecha_ingreso = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->ingreso = Carbon::parse(Carbon::now())->format('H:i');
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

        //obtencion de los accesorios que tiene el vehiculo
        //para traer el id del ultimo taller del vehiculo que se tiene el id
        $ultivehiculo = Taller::where('vehiculo_id', $this->vehiculoselectedId)
            ->orderBy('id', 'desc')
            ->first();
        //dd($ultivehiculo);
        $acctalleres = accesoriostaller::orderBy('id', 'asc')->get();
        if ($ultivehiculo) {
            //dd($acctaller);
            //foreach para agregar si tiene el checked
            foreach ($acctalleres as $tall) {
                //buscado el id del taller
                //dd($tallerherr->id);
                //obtenemos todos los id de las herramientas que tiene el taller id
                $tallerherramientas = tallerdetalle::where('taller_id', $ultivehiculo->id)->get();
                //dd($tallerherramientas);

                //buscamos si existe esa herramienta agregado o no
                $obtenercheck = $tallerherramientas->where('acctaller_id', $tall->id)->first();
                //dump($obtenercheck);
                //exists sirve para obtener valor en boleano
                //$this->roles()->where('nombre', $nombreRol)->exists();

                // verificar si tenemos datos en obtenercheck
                if ($obtenercheck) {
                    //dump($obtenercheck->acctaller_id);
                    $addcheck = accesoriostaller::find($obtenercheck->acctaller_id);
                    //dump($addcheck);
                    $tall->checked = 1;
                    $this->check[] =
                        $addcheck->id . ", " .
                        $addcheck->name;

                    //$acctalleres->pull($tall->id);
                }
            }

            $this->acctaller = $acctalleres;

            //traer las descripciones de los estados del vehiculo

            $datosestadovehiculo = Estadovehiculo::where('taller_id', $ultivehiculo->id)->get();

            foreach ($datosestadovehiculo as $value) {
                $this->estadovehiculo[$value->key] = [
                    'descripcion' => $value->descripcion,
                ];
            }
        } 
        else{
            
            foreach ($acctalleres as $tall){
                $this->check[] =
                        $tall->id . ", " .
                        $tall->name;
            }
            //dd($this->check);
        }
        $this->emit('show-modal', 'open!');
    }

    //funcion para eliminar los checks que se quitaron
    public function eliminarcheck($checksbd, $checksnuevos)
    {
        //en este doble foreach se buscara la existencia de los checks que tengamos
        //donde el primer foreach sera lo de la bd y luego los $this->check 
        foreach ($checksbd as $item) {
            $datonuevo = null;
            foreach ($checksnuevos as $value) {

                if ($item->acctaller_id == explode(',', $value)[0]) {
                    $datonuevo = explode(',', $value)[0];
                    // dd($item->id, explode(',', $value)[0] );
                    break;
                }
            }
            //si es null, significa que ese elemento ya no existe en la bd y se borra
            if ($datonuevo == null) {
                //dump($datonuevo);
                $item->delete();
            }
        }
    }

    //funcion para agregar los nuevos checks a la bd
    public function agregarcheck($checksbd, $checksnuevos, $idtaller)
    {
        //en este doble foreach se buscara la existencia de los checks que tengamos
        //donde el primer foreach sera los $this->check y luego lo de la bd
        foreach ($checksnuevos as $item) {
            $datonuevo = null;
            foreach ($checksbd as $value) {

                if ($value->acctaller_id == explode(',', $item)[0]) {
                    $datonuevo = explode(',', $value)[0];
                    // dd($item->id, explode(',', $value)[0] );
                    break;
                }
            }
            // si es null no se encontro, significa que es un nuevo check ah agregar
            if ($datonuevo == null) {
                //dump($datonuevo);

                tallerdetalle::create([

                    'acctaller_id' => explode(',', $item)[0],
                    'taller_id' => $idtaller
                ]);
            }
        }
    }

    //funcion para eliminar comentarios del estado del auto que ya no estan
    public function eliminarestadoauto($estadoautobd, $estadoautonew, $idtaller)
    {
        //en este doble foreach se buscara la existencia de los checks que tengamos
        //donde el primer foreach sera lo de la bd y luego los $this->estadoauto 
        foreach ($estadoautobd as $item) {
            $datonuevo = null;
            foreach ($estadoautonew as $key => $value) {

                if ($item->key == $key) {
                    $datonuevo = $value;
                    break;
                }
            }
            //si es null, significa que el dato ya no existe en el nuevo estadoauto y se borra
            if ($datonuevo == null) {
                //dump($datonuevo);
                $item->delete();
            }
            // si se tiene datos, cambiamos el anterior datos por los otros nuevos del estado auto
            else {
                //dump($value);
                $item->update([

                    'descripcion' => $value["descripcion"],
                    'taller_id' => $idtaller,
                    'key' => $key
                ]);
            }
        }
    }

    //funcion para agregar los comentarios nuevos del estado del auto
    public function agregarestadoauto($estadoautobd, $estadoautonew, $idtaller)
    {
        //en este doble foreach se buscara la existencia de los checks que tengamos
        //donde el primer foreach sera los $this->estadoauto y luego lo de la bd
        foreach ($estadoautonew as $key => $item) {
            $datonuevo = null;
            foreach ($estadoautobd as $value) {

                if ($value->key == $key) {
                    $datonuevo = $item;
                    break;
                }
            }
            //si es null, significa que tenemos nuevos datos y los agregamos
            if ($datonuevo == null) {
                //dump($datonuevo);

                Estadovehiculo::create([
                    'descripcion' => $item["descripcion"],
                    'taller_id' => $idtaller,
                    'key' => $key
                ]);
            }
        }
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
