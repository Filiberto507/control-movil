<?php

namespace App\Http\Livewire;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Diagnostico;
use App\Models\Conductor;
use App\Models\DiagnosticoItem;
use App\Models\Vehiculos;
use Carbon\Carbon;
use App\Models\Taller;
use App\Models\User;
use DB;

class DiagnosticoController extends Component
{
    use WithPagination;

    public $fecha, $fechataller, $observacion, $dependencia, $conductor, $vehiculos_id,
        $search, $selected_id, $pageTitle, $componentName, $taller_id;
    public $filas = [];
    private $pagination = 6;

    //tipo de taller
    public $tipo_taller;
    //datos select2
    public $vehiculoselectedId, $vehiculoselectedName, $vehiculodatos;
    //responsable
    public $responsable, $responsableu;

    function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Diagnostico';
        $this->vehiculos_id = 'Elegir';
        $this->vehiculoselectedName = 'Elegir';
        $this->tipo_taller = 'Elegir';
    }

    public function render()
    {
        if (strlen($this->search) > 0)

            $Diagnostico = Diagnostico::join('vehiculos as v', 'v.id', 'diagnosticos.vehiculos_id')
                ->select('diagnosticos.*', 'v.id as vehiculos', 'v.placa')
                ->orWhere('v.placa', 'like', '%' . $this->search . '%')
                ->orWhere('diagnosticos.id', 'like', '%' . $this->search . '%')
                ->orderBy('diagnosticos.id', 'desc')
                ->paginate($this->pagination);
        else
            $Diagnostico = Diagnostico::join('vehiculos as v', 'v.id', 'diagnosticos.vehiculos_id')
                ->select('diagnosticos.*', 'v.id as vehiculos', 'v.placa')
                ->orderBy('diagnosticos.id', 'desc')
                ->paginate($this->pagination);
        //dd($Diagnostico);

        $this->vehiculodatos = Taller::leftJoin('diagnosticos as di', 'di.taller_id', 'tallers.id')
        ->select('tallers.*')
        ->whereNull('taller_id')
        ->orderby('id', 'desc')
        ->get();
        
        $this->responsableu= User::where('profile','like','%'.'Tecnico-Mecanico'.'%')
        ->orderby('name', 'asc')
        ->get();

        return view('livewire.diagnostico.component', [
            'Diagnosticos' => $Diagnostico,
            'Vehiculos' => Vehiculos::orderBy('id', 'asc')->get(),
            'responsableu'=>$this->responsableu,
            'vehiculodatos' => $this->vehiculodatos
            //'Conductor'=> Conductor::orderBy('name','asc')->get()
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function Edit($id)
    {
        //dd($Dependencias);
        $Diagnostico = Diagnostico::find($id);
        $this->selected_id = $Diagnostico->id;
        $this->fecha = $Diagnostico->fecha;
        $this->dependencia = $Diagnostico->dependencia;
        $this->conductor = $Diagnostico->conductor;
        $this->vehiculos_id = $Diagnostico->vehiculos_id;
        $this->tipo_taller = $Diagnostico->tipo_taller;
        $this->observacion = $Diagnostico->observacion;
        $this->responsable = $Diagnostico->responsable;
        $DiagnosticoItem = DiagnosticoItem::where('diagnosticos_id', $id)->get();
        //dd($DiagnosticoItem);
        foreach ($DiagnosticoItem as $d) {
            //dd($d->item);
            $this->filas[] = [
                'items' => $d->item,
                'descriptions' => $d->descripcion,
            ];
        }
        //dd($this->filas);
        $this->emit('show-modal', 'SHOW MODAL');
    }
    public function Store()
    {
        //dd($this->filas);
        foreach ($this->filas as $key => $value) {
            if($value['items'] == '' || $value['descriptions'] == '')
            {
                unset($this->filas[$key]);
            }
            
        }
        $rules = [
            'fecha' => 'required',
            'dependencia' => 'required|min:3',
            'conductor' => 'required|min:3',
            'vehiculos_id' => 'required',
            'tipo_taller' => 'required|not_in:Elegir',
            'responsable' => 'required|not_in:Elegir'
        ];
        $messages = [
            'fecha.required' => 'seleccione una fecha',
            'tipo_taller' => 'Seleccione al Tipo de taller',
            'responsable.required' => 'Ingrese el responsable',
            'responsable.not_in' => 'Seleccione el responsable'
        ];

        $this->validate($rules, $messages);
        //dd($this->filas);

        $ultimadiagnostico = Diagnostico::orderby('id', 'desc')->first();
        //dd($ultimadiagnostico->fecha); 2023-07-21
        if($ultimadiagnostico)
        {
            $fechaultimadiagnostico=Carbon::parse($ultimadiagnostico->fecha)->format('Y');
        }
        else
        {
            $fechaultimadiagnostico = Carbon::parse(Carbon::now())->format('Y');
        }
        //dd($this->fechataller);

        if ($ultimadiagnostico && $fechaultimadiagnostico == $this->fechataller ) {
            // Continuar incrementando el contador de números de diagnostico
            $numerodiagnostico = $ultimadiagnostico->numero_diagnostico + 1;
        } else {
            // Comenzó un nuevo año, reiniciar el contador de números
            $numerodiagnostico = 1;
        }

        //dd($numerodiagnostico);
        $Diagnostico = Diagnostico::create([
            'numero_diagnostico' => $numerodiagnostico,
            'fecha' => $this->fecha,
            'dependencia' => $this->dependencia,
            'conductor' => $this->conductor,
            'vehiculos_id' => $this->vehiculos_id,
            'tipo_taller' => $this->tipo_taller,
            'observacion' => $this->observacion,
            'taller_id' => $this->taller_id,
            'responsable'=>$this->responsable
        ]);
        if ($Diagnostico) {

            foreach ($this->filas as $f) {
                DiagnosticoItem::create([
                    'item' => $f['items'],
                    'descripcion' => $f['descriptions'],
                    'diagnosticos_id' => $Diagnostico->id
                ]);
            }
        }
        // dd($Dependencias);
        $this->resetUI();
        $this->emit('diagnostico-added', 'Se registro la dependencia con exito');
    }

    public function resetUI()
    {
        $this->fecha = '';
        $this->observaciones = '';
        $this->dependencia = '';
        $this->conductor = '';
        $this->search = '';
        $this->vehiculos_id = 'Elegir';
        $this->filas = [];
        $this->selected_id = 0;
        $this->taller_id = '';
        $this->tipo_taller= '';
        $this->observacion= '';
        $this->responsable='';
        $this->resetValidation();
        //para regresar a la pagina principal
        $this->resetPage();
        $this->emit('diagnostico-close', 'vehiculo cerrar');
    }
    public function Update()
    {
        foreach ($this->filas as $key => $value) {
            if($value['items'] == '' || $value['descriptions'] == '')
            {
                unset($this->filas[$key]);
            }
            
        }
        //dd($this->filas);
        $rules = [
            'fecha' => 'required',
            'dependencia' => 'required|min:3',
            'conductor' => 'required|min:3',
            'vehiculos_id' => 'required',
            'tipo_taller' => 'required|not_in:Elegir',
            'responsable' => 'required|not_in:Elegir'
        ];

        $messages = [
            'fecha.required' => 'ingresela fecha',
            'tipo_taller' => 'Seleccione al Tipo de taller',
            'responsable.required' => 'Ingrese el responsable',
            'responsable.not_in' => 'Seleccione el responsable'
        ];

        $this->validate($rules, $messages);
        $Diagnostico = Diagnostico::find($this->selected_id);
        $Diagnostico->update([
            'fecha' => $this->fecha,
            'dependencia' => $this->dependencia,
            'conductor' => $this->conductor,
            'tipo_taller' => $this->tipo_taller,
            'observacion' => $this->observacion,
            'vehiculos_id' => $this->vehiculos_id,
            'responsable'=>$this->responsable
        ]);

        if ($Diagnostico) {
            $itemdiag= DiagnosticoItem::where('diagnosticos_id', $this->selected_id)->get();
            //dd($itemdiag);
            $this->AgregarItem($itemdiag, $this->filas, $this->selected_id);
            $this->EliminarItem($itemdiag, $this->filas, $this->selected_id);
        }

        // dd($Dependencias);
        $this->resetUI();
        $this->emit('diagnostico-updated', 'Se actualizo el diagnostico con exito');
    }

    protected $listeners =[
        'destroy' => 'Destroy',
        'resetUI' => 'resetUI'
    ];

    public function Destroy($id)
    {
        //dd('hola');
        DiagnosticoItem::where('diagnosticos_id', $id)->delete();
        Diagnostico::find($id)->delete();
        $this->resetUI();
        $this->emit('diagnostico-deleted', 'Se elimino el diagnostico');
    }

    public function agregarFila($variable)
    {
        /*if (count($this->filas) == 10) {
            dd($this->filas);
        }*/

        switch ($variable) {
            case '1':
                $this->filas[] = [
                    'items' => '',
                    'descriptions' => '',
                ];
                break;
            default:
                # code...
                break;
        }
    }

    public function eliminarFila($index)
    {
        unset($this->filas[$index]);
        $this->filas = $this->filas; // Reindexar el arreglo
    }
    public function pdf($id)
    {
        $Diagnostico = Diagnostico::join('vehiculos as v', 'v.id', 'diagnosticos.vehiculos_id')
            ->select('diagnosticos.*', 'v.id as vehiculos', 'v.placa', 'v.marca', 'v.clase', 'v.tipo_vehiculo')
            ->where('diagnosticos.id', $id)->first();
        //dd($Diagnostico);
        $DiagnosticoItem = DiagnosticoItem::where('diagnosticos_id', $id)->get();
        $Vehiculos = Vehiculos::all();
        $pdf = PDF::setPaper([0, 0, 680, 1000])->loadView('livewire.diagnostico.pdf', compact('Diagnostico', 'DiagnosticoItem', 'Vehiculos'));
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
            }

            else{
                $item->update([

                    'item' => $value['items'],
                    'descripcion' => $value['descriptions'],
                    'diagnosticos_id' => $iditem
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
                
                DiagnosticoItem::create([
                    'item' => $item['items'],
                    'descripcion' => $item['descriptions'],
                    'diagnosticos_id' => $iditem
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
        $findvehiculo = taller::where('id', $this->vehiculoselectedId)
            ->first();
        //dd($this->vehiculoselectedId);
        $this->fecha = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->fechataller = Carbon::parse($findvehiculo->fecha_ingreso)->format('Y');
        $this->conductor = $findvehiculo->conductor;
        $this->vehiculos_id = $findvehiculo->vehiculo_id;
        $this->dependencia = $findvehiculo->dependencia;
        $this->taller_id = $findvehiculo->id;
        
        
    }
}
