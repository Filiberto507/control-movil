<?php

namespace App\Http\Livewire;

use App\Models\Diagnostico;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Diagnostico_area_transporte;
use App\Models\Diagnostico_servicio;
use App\Models\DiagnosticoAreaTransportent;
use App\Models\DiagnosticoObra;
use App\Models\Vehiculos;
use Carbon\Carbon;
use App\Models\Taller;
use App\Models\DiagnosticoItem;
use App\Models\Diagnosticont;
use App\Models\DiagnosticontItem;
use App\Models\DiagnosticoObrant;
use App\Models\DiagnosticoServiciont;
use DB;

class DiagnosticoAreaTransportentController extends Component
{
    use WithPagination;

    public $fecha, $fechataller, $conclusion, $dependencia, $conductor, $vehiculos_id, $taller_id,
        $search, $selected_id, $pageTitle, $componentName;

    //TIPO DE TALLER
    public $tipo_taller;

    //requemiento
    public $requerimiento = [];

    //obra
    public $obra = [];
    //paginacion
    private $pagination = 6;

    public $vehiculoselectedId, $vehiculoselectedName, $vehiculodatos;

    function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Diagnostico Transportes Sin Taller';
        $this->tipo_taller = 'Elegir';
        $this->vehiculos_id = 'Elegir';
        $this->vehiculoselectedName = 'Elegir';
    }

    public function render()
    {
        if (strlen($this->search) > 0)
        
            $DiagnosticoAreaT = DiagnosticoAreaTransportent::join("vehiculos as v", "v.id", "diagnostico_area_transportents.vehiculos_id")
                ->select('diagnostico_area_transportents.*', 'v.id as vehiculos', 'v.placa', 'v.tipo_vehiculo', 'v.cilindrada', 'v.chasis', 'v.motor')
                ->orWhere('v.placa', 'like', '%' . $this->search . '%')
                ->orWhere('diagnostico_area_transportents.id', 'like', '%' . $this->search . '%')
                ->orderBy('diagnostico_area_transportents.id', 'desc')
                ->paginate($this->pagination);
        else
            $DiagnosticoAreaT = DiagnosticoAreaTransportent::join("vehiculos as v", "v.id", "diagnostico_area_transportents.vehiculos_id")
                ->select('diagnostico_area_transportents.*', 'v.id as vehiculos', 'v.placa', 'v.tipo_vehiculo', 'v.cilindrada', 'v.chasis', 'v.motor')
                ->orderBy('diagnostico_area_transportents.id', 'desc')
                ->paginate($this->pagination);
        //dd($Diagnostico);

        $this->vehiculodatos = Diagnosticont::leftJoin('diagnostico_area_transportents as dt', 'dt.diagnosticont_id', 'diagnosticonts.id')
        ->join('vehiculos as v', 'v.id', 'diagnosticonts.id')
        ->select('diagnosticonts.*', 'v.id as vehiculos', 'v.placa', 'v.tipo_vehiculo')
        ->whereNull('diagnosticont_id')
        ->orderby('id', 'desc')
        ->get();
        //dd($this->vehiculodatos);
        return view('livewire.diagnostico_area_transportent.component', [
            'Diagnostico_area_transportes' => $DiagnosticoAreaT,
            'vehiculos' => Vehiculos::orderBy('id', 'asc')->get(),
            'vehiculodatos' => $this->vehiculodatos
            //'Conductor'=> Conductor::orderBy('name','asc')->get()
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }
    public function Edit($id)
    {
        //dd($Dependencias);
        $DiagnosticoAreaT = DiagnosticoAreaTransportent::find($id);
        $this->selected_id = $DiagnosticoAreaT->id;
        $this->fecha = $DiagnosticoAreaT->fecha;
        $this->dependencia = $DiagnosticoAreaT->dependencia;
        $this->conductor = $DiagnosticoAreaT->conductor;
        $this->conclusion = $DiagnosticoAreaT->conclusion;
        $this->vehiculos_id = $DiagnosticoAreaT->vehiculos_id;
        $this->tipo_taller = $DiagnosticoAreaT->tipo_taller;
        $DiagnosticoServicio = DiagnosticoServiciont::where('diagnostico_area_transportent_id', $id)->get();
        //dd($DiagnosticoItem);
        foreach ($DiagnosticoServicio as $d) {
            //dd($d->item);
            $this->requerimiento[] = [
                'item' => $d->item,
                'cantidad' => $d->cantidad,
                'unidad' => $d->unidad,
                'servicio' => $d->servicio,
            ];
        }

        $DiagnosticoObra = DiagnosticoObrant::where('diagnostico_area_transportent_id', $id)->get();
        foreach ($DiagnosticoObra as $d) {
            //dd($d->item);
            $this->obra[] = [
                'item' => $d->item,
                'cantidad' => $d->cantidad,
                'servicio' => $d->servicio,
            ];
        }
        //dd($this->requerimiento);
        $this->emit('show-modal', 'SHOW MODAL');
    }


    public function Store()
    {

        foreach ($this->requerimiento as $key => $value) {
            if ($value['cantidad'] == '' || $value['servicio'] == '') {
                unset($this->requerimiento[$key]);
            }
        }

        foreach ($this->obra as $key => $value) {
            if ($value['cantidad'] == '' || $value['servicio'] == '') {
                unset($this->obra[$key]);
            }
        }


        $rules = [
            'fecha' => 'required',
            'conclusion' => 'required|min:3',
            'dependencia' => 'required|min:3',
            'conductor' => 'required|min:3',
            'vehiculos_id' => 'required',
        ];
        $messages = [
            'fecha.required' => 'seleccione una fecha',
            'conclusion.required' => 'Ingrese las conclusion',
            'conclusion.min' => 'El campo tiene que tener al menos 3 caracteres',

        ];

        $this->validate($rules, $messages);

        //por año el numero se reiniciara 
        $ultimadiagnostico = DiagnosticoAreaTransportent::orderby('id', 'desc')->first();
        //dd($ultimadiagnostico); //2023-07-21

        if($ultimadiagnostico)
        {
            $fechaultimadiagnostico=Carbon::parse($ultimadiagnostico->fecha)->format('Y');
        }
        else
        {
            $fechaultimadiagnostico = Carbon::parse(Carbon::now())->format('Y');
        }

       //dd($ultimadiagnostico);

        if ($ultimadiagnostico && $fechaultimadiagnostico == $this->fechataller ) {
            // Continuar incrementando el contador de números de diagnostico
            $numerodiagnostico = $ultimadiagnostico->numero_diagtransporte + 1;
        } else {
            // Comenzó un nuevo año, reiniciar el contador de números
            $numerodiagnostico = 1;
        }

       
        //dd($numerodiagnostico);
        //dd($this->requerimiento);
        $DiagnosticoAreaT = DiagnosticoAreaTransportent::create([
            'numero_diagtransporte' => $numerodiagnostico,
            'fecha' => $this->fecha,
            'dependencia' => $this->dependencia,
            'conductor' => $this->conductor,
            'vehiculos_id' => $this->vehiculos_id,
            'conclusion' => $this->conclusion,
            'tipo_taller' => $this->tipo_taller,
            'diagnosticont_id' => $this->taller_id
        ]);
        if ($DiagnosticoAreaT) {
            $cont = 1;
            foreach ($this->requerimiento as $f) {
                DiagnosticoServiciont::create([
                    'item' => $cont,
                    'cantidad' => $f['cantidad'],
                    'servicio' => $f['servicio'],
                    'unidad' => $f['unidad'],
                    'diagnostico_area_transportent_id' => $DiagnosticoAreaT->id
                ]);
                $cont++;
            }

            $conto = 1;
            foreach ($this->obra as $f) {
                DiagnosticoObrant::create([
                    'item' => $conto,
                    'cantidad' => $f['cantidad'],
                    'servicio' => $f['servicio'],
                    'diagnostico_area_transportent_id' => $DiagnosticoAreaT->id
                ]);
                $conto++;
            }
        }
        // dd($Dependencias);
        $this->resetUI();
        $this->emit('diagnostico_area_transporte-added', 'Se registro el diagnostico con exito');
    }

    public function resetUI()
    {
        $this->fecha = '';
        $this->conclusion = '';
        $this->dependencia = '';
        $this->conductor = '';
        $this->search = '';
        $this->vehiculos_id = 'Elegir';
        $this->requerimiento = [];
        $this->obra = [];
        $this->tipo_taller = 'Elegir';
        $this->selected_id = 0;
        $this->resetValidation();
        //para regresar a la pagina principal
        $this->resetPage();
        $this->emit('diagnostico_area_transporte-close', 'vehiculo cerrar');
    }
    public function Update()
    {
        foreach ($this->requerimiento as $key => $value) {
            if ($value['cantidad'] == '' || $value['servicio'] == '') {
                unset($this->requerimiento[$key]);
            }
        }

        foreach ($this->obra as $key => $value) {
            if ($value['cantidad'] == '' || $value['servicio'] == '') {
                unset($this->obra[$key]);
            }
        }
        //dd($this->requerimiento);
        $rules = [
            'fecha' => 'required',
            'conclusion' => 'required|min:3',
            'dependencia' => 'required|min:3',
            'conductor' => 'required|min:3',
            'vehiculos_id' => 'required',

        ];

        $messages = [
            'fecha.required' => 'ingresela fecha',
            'conclusion.required' => 'ingrese las conclusiones',
            'conclusion.min' => 'El campo tiene que tener al menos 3 caracteres',

        ];

        $this->validate($rules, $messages);
        $DiagnosticoAreaT = DiagnosticoAreaTransportent::find($this->selected_id);
        $DiagnosticoAreaT->update([
            'fecha' => $this->fecha,
            'conclusion' => $this->conclusion,
            'dependencia' => $this->dependencia,
            'conductor' => $this->conductor,
            'tipo_taller' => $this->tipo_taller,
            'vehiculos_id' => $this->vehiculos_id
        ]);

        if ($DiagnosticoAreaT) {
            $itemdiag = DiagnosticoServiciont::where('diagnostico_area_transportent_id', $this->selected_id)->get();
            $iteobra = DiagnosticoObrant::where('diagnostico_area_transportent_id', $this->selected_id)->get();
            //dd($itemdiag);
            $this->AgregarItem($itemdiag, $this->requerimiento, $this->selected_id);
            $this->EliminarItem($itemdiag, $this->requerimiento, $this->selected_id);
            $this->AgregarItemObra($iteobra, $this->obra, $this->selected_id);
            $this->EliminarItemObra($iteobra, $this->obra, $this->selected_id);
        }

        // dd($Dependencias);
        $this->resetUI();
        $this->emit('diagnostico_area_transporte-updated', 'Se actualizo el diagnostico con exito');
    }

    protected $listeners = [
    'destroy' => 'Destroy',
    'resetUI' => 'resetUI'
    ];

    public function Destroy($id)
    {
        //dd('hola');
        Diagnostico_servicio::where('diagnostico_area_transportes_id', $id)->delete();
        DiagnosticoObra::where('diagnostico_area_transportes_id', $id)->delete();
        Diagnostico_area_transporte::find($id)->delete();
        $this->resetUI();
        $this->emit('diagnostico_area_transporte-deleted', 'Se elimino el diagnostico');
    }

    public function agregarRequerimiento($variable)
    {
        /*if (count($this->requerimiento) == 30) {
            dd($this->requerimiento);
        }*/
        switch ($variable) {
            case '1':
                $this->requerimiento[] = [
                    'item' => '',
                    'cantidad' => '',
                    'unidad' => '',
                    'servicio' => '',
                ];
                break;
            default:
                # code...
                break;
        }
    }

    public function eliminarRequerimiento($index)
    {
        unset($this->requerimiento[$index]);
        $this->requerimiento = $this->requerimiento; // Reindexar el arreglo
    }

    public function agregarObra($variable)
    {
        /*if (count($this->obra) == 30) {
            dd($this->obra);
        }*/
        switch ($variable) {
            case '1':
                $this->obra[] = [
                    'item' => '',
                    'cantidad' => '',
                    'servicio' => '',
                ];
                break;
            default:
                # code...
                break;
        }
    }

    public function eliminarObra($index)
    {
        unset($this->obra[$index]);
        $this->obra = $this->obra; // Reindexar el arreglo
    }

    public function pdft($id)
    {
        //dd('hola');
        $DiagnosticoAreaT = DiagnosticoAreaTransportent::join('vehiculos as v', 'v.id', 'diagnostico_area_transportents.vehiculos_id')
            ->select('diagnostico_area_transportents.*', 'v.id as vehiculos', 'v.clase', 'v.placa', 'v.marca', 'v.tipo_vehiculo', 'v.cilindrada', 'v.chasis', 'v.motor')
            ->where('diagnostico_area_transportents.id', $id)->first();
        //dd($DiagnosticoAreaT);
        $Diagnostico_requerimiento = DiagnosticoServiciont::where('diagnostico_area_transportent_id', $id)->get();
        $Diagnostico_obra = DiagnosticoObrant::where('diagnostico_area_transportent_id', $id)->get();
        $contreque = $Diagnostico_requerimiento->count();
        $contobra = $Diagnostico_obra->count();
        //dd($contobra);

        $Vehiculos = Vehiculos::all();
        $pdf = Pdf::loadView('livewire.diagnostico_area_transportent.pdf', compact('DiagnosticoAreaT', 'Diagnostico_obra', 'Vehiculos', 'Diagnostico_requerimiento', 'contreque', 'contobra'));
        return $pdf->stream();
        //si se quiere descargar
        //return $pdf->download('reporteDisagnostico.pdf');
    }

    public function EliminarItem($itembd, $itemnew, $iditem)
    {
        //dd($itembd, $itemnew);
        foreach ($itembd as $key => $item) {
            $itemnuevo = null;
            foreach ($itemnew as $key2 => $value) {
                if ($key == $key2) {
                    $itemnuevo = $item;
                    break;
                }
            }

            if ($itemnuevo == null) {
                ($item)->delete();
            } else {
                $item->update([
                    'item' => $key2 + 1,
                    'cantidad' => $value['cantidad'],
                    'servicio' => $value['servicio'],
                    'unidad' => $value['unidad'],
                    'diagnostico_area_transportent_id' => $iditem
                ]);
            }
        }
    }

    public function AgregarItem($itembd, $itemnew, $iditem)
    {
        //dd($itembd, $itemnew);
        foreach ($itemnew as $key => $item) {
            $itemnuevo = null;
            foreach ($itembd as $key2 => $value) {
                if ($key == $key2) {
                    $itemnuevo = $value;
                    break;
                }
            }

            if ($itemnuevo == null) {

                DiagnosticoServiciont::create([
                    'item' => $key + 1,
                    'cantidad' => $item['cantidad'],
                    'servicio' => $item['servicio'],
                    'unidad' => $item['unidad'],
                    'diagnostico_area_transportent_id' => $iditem
                ]);
            }
        }
    }

    public function EliminarItemObra($itembd, $itemnew, $iditem)
    {
        //dd($itembd, $itemnew);
        foreach ($itembd as $key => $item) {
            $itemnuevo = null;
            foreach ($itemnew as $key2 => $value) {
                if ($key == $key2) {
                    $itemnuevo = $item;
                    break;
                }
            }

            if ($itemnuevo == null) {
                ($item)->delete();
            } else {
                $item->update([
                    'item' => $key2 + 1,
                    'cantidad' => $value['cantidad'],
                    'servicio' => $value['servicio'],
                    'diagnostico_area_transportent_id' => $iditem
                ]);
            }
        }
    }

    public function AgregarItemObra($itembd, $itemnew, $iditem)
    {
        //dd($itembd, $itemnew);
        foreach ($itemnew as $key => $item) {
            $itemnuevo = null;
            foreach ($itembd as $key2 => $value) {
                if ($key == $key2) {
                    $itemnuevo = $value;
                    break;
                }
            }

            if ($itemnuevo == null) {

                DiagnosticoObrant::create([
                    'item' => $key + 1,
                    'cantidad' => $item['cantidad'],
                    'servicio' => $item['servicio'],
                    'diagnostico_area_transportent_id' => $iditem
                ]);
            }
        }
    }
    public function showDatos()
    {


        // $this->fecha_ingreso = Carbon::parse(Carbon::now())->format('Y-m-d');
        // $this->ingreso = Carbon::parse(Carbon::now())->format('H:i');
        //dd($this->vehiculoselectedId);
        //dd($this->vehiculoselectedName, $this->vehiculoselectedId);
        $findvehiculo = Diagnosticont::where('id', $this->vehiculoselectedId)
            ->first();
        //dd($findvehiculo);
        //dd($this->vehiculoselectedId);
        //dd($tipotalldiagnostico->tipo_taller);
        $this->fecha = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->fechataller = Carbon::parse($findvehiculo->fecha_ingreso)->format('Y');
        $this->conductor = $findvehiculo->conductor;
        $this->vehiculos_id = $findvehiculo->vehiculos_id;
        $this->dependencia = $findvehiculo->dependencia;
        $this->taller_id = $findvehiculo->id;
        $this->tipo_taller = $findvehiculo->tipo_taller;
        //dd($this->taller_id);

        //listado de diagnostico
        $DiagnosticoItem = DiagnosticontItem::where('diagnosticosnt_id', $findvehiculo->id)->get();
        //dd($DiagnosticoItem);

        foreach ($DiagnosticoItem as $d) {
            //dd($d->item);
            $this->requerimiento[] = [
                'item' => $d->item,
                'cantidad' => $d->item,
                'unidad' => '',
                'servicio' => $d->descripcion,
            ];
        }

        foreach ($DiagnosticoItem as $d) {
            //dd($d->item);
            $this->obra[] = [
                'item' => $d->item,
                'cantidad' => $d->item,
                'servicio' => $d->descripcion,
            ];
        }
    }

    public function resetRequerimientos()
    {
        $this->requerimiento = [];
    }

    public function resetObra()
    {
        $this->obra = [];
    }
}
