<?php

namespace App\Http\Livewire;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Diagnostico;
use App\Models\Conductor;
use App\Models\DiagnosticoItem;
use App\Models\Diagnosticont;
use App\Models\DiagnosticontItem;
use App\Models\Vehiculos;
use App\Models\User;
use App\Models\Dependencia;
use Carbon\Carbon;
use App\Models\Taller;
use DB;

class DiagnosticontController extends Component
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
    //dependencias y conductores
    public $conductoresnt, $dependenciant;
    //responsable
    public $responsable, $responsableu;

    function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Diagnostico sin Taller';
        $this->vehiculos_id = 'Elegir';
        $this->vehiculoselectedName = 'Elegir';
        $this->tipo_taller = 'Elegir';
    }

    public function render()
    {
        if (strlen($this->search) > 0)

            $Diagnostico = Diagnosticont::join('vehiculos as v', 'v.id', 'diagnosticonts.vehiculos_id')
                ->select('diagnosticonts.*', 'v.id as vehiculos', 'v.placa')
                ->orWhere('v.placa', 'like', '%' . $this->search . '%')
                ->orWhere('diagnosticonts.id', 'like', '%' . $this->search . '%')
                ->orderBy('diagnosticonts.id', 'desc')
                ->paginate($this->pagination);
        else
            $Diagnostico = Diagnosticont::join('vehiculos as v', 'v.id', 'diagnosticonts.vehiculos_id')
                ->select('diagnosticonts.*', 'v.id as vehiculos', 'v.placa')
                ->orderBy('diagnosticonts.id', 'desc')
                ->paginate($this->pagination);
        //dd($Diagnostico);

        $this->responsableu= User::where('profile','like','%'.'Tecnico-Mecanico'.'%')
        ->orderby('name', 'asc')
        ->get();

        $this->vehiculodatos = Vehiculos::orderby('id', 'desc')
        ->get();

        $this->conductoresnt = Conductor::orderby('name', 'asc')
        ->get();
        $this->dependenciant = Dependencia::orderby('nombre', 'asc')
        ->get();

        return view('livewire.diagnosticont.component', [
            'Diagnosticos' => $Diagnostico,
            'Vehiculos' => Vehiculos::orderBy('id', 'asc')->get(),
            'dependenciant' => $this->dependenciant,
            'conductoresnt' => $this->conductoresnt,
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
        $Diagnostico = Diagnosticont::find($id);
        $this->selected_id = $Diagnostico->id;
        $this->fecha = $Diagnostico->fecha;
        $this->dependencia = $Diagnostico->dependencia;
        $this->conductor = $Diagnostico->conductor;
        $this->vehiculos_id = $Diagnostico->vehiculos_id;
        $this->tipo_taller = $Diagnostico->tipo_taller;
        $this->observacion = $Diagnostico->observacion;
        $this->responsable = $Diagnostico->responsable;
        $DiagnosticoItem = DiagnosticontItem::where('diagnosticosnt_id', $id)->get();
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
            'dependencia.required' => 'seleccione un conductor',
            'conductor.required' => 'seleccione una dependencia',
            'tipo_taller' => 'Seleccione al Tipo de taller',
            'responsable.required' => 'Ingrese el responsable',
            'responsable.not_in' => 'Seleccione el responsable'
        ];

        $this->validate($rules, $messages);
        //dd($this->filas);

        $ultimadiagnostico = Diagnosticont::orderby('id', 'desc')->first();
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

        if ($ultimadiagnostico && $fechaultimadiagnostico == Carbon::parse($this->fecha)->format('Y') ) {
            // Continuar incrementando el contador de números de diagnostico
            $numerodiagnostico = $ultimadiagnostico->numero_diagnostico + 1;
        } else {
            // Comenzó un nuevo año, reiniciar el contador de números
            $numerodiagnostico = 1;
        }

        //dd($numerodiagnostico);
        $Diagnostico = Diagnosticont::create([
            'numero_diagnostico' => $numerodiagnostico,
            'fecha' => $this->fecha,
            'dependencia' => strtoupper($this->dependencia),
            'conductor' => strtoupper($this->conductor),
            'vehiculos_id' => $this->vehiculos_id,
            'tipo_taller' => $this->tipo_taller,
            'observacion' => $this->observacion,
            'responsable'=>$this->responsable
        ]);
        if ($Diagnostico) {

            foreach ($this->filas as $f) {
                DiagnosticontItem::create([
                    'item' => $f['items'],
                    'descripcion' => $f['descriptions'],
                    'diagnosticosnt_id' => $Diagnostico->id
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
        $Diagnostico = Diagnosticont::find($this->selected_id);
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
            $itemdiag= DiagnosticontItem::where('diagnosticosnt_id', $this->selected_id)->get();
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
        DiagnosticontItem::where('diagnosticosnt_id', $id)->delete();
        Diagnosticont::find($id)->delete();
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
        $Diagnostico = Diagnosticont::join('vehiculos as v', 'v.id', 'diagnosticonts.vehiculos_id')
            ->select('diagnosticonts.*', 'v.id as vehiculos', 'v.placa', 'v.marca', 'v.clase', 'v.tipo_vehiculo')
            ->where('diagnosticonts.id', $id)->first();
        //dd($Diagnostico);
        $DiagnosticoItem = DiagnosticontItem::where('diagnosticosnt_id', $id)->get();
        //dd($Diagnostico);
        $Vehiculos = Vehiculos::all();
        $pdf = PDF::setPaper([0, 0, 680, 1000])->loadView('livewire.diagnosticont.pdf', compact('Diagnostico', 'DiagnosticoItem', 'Vehiculos'));
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
                    'diagnosticosnt_id' => $iditem
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
                
                DiagnosticontItem::create([
                    'item' => $item['items'],
                    'descripcion' => $item['descriptions'],
                    'diagnosticosnt_id' => $iditem
                ]);
            }
        }
    }

    public function showDatos()
    {

        $this->fecha = Carbon::parse(Carbon::now())->format('Y-m-d');
        //dd($this->vehiculoselectedId);
        //dd($this->vehiculoselectedName, $this->vehiculoselectedId);
        $findvehiculo = Vehiculos::where('vehiculos.id', $this->vehiculoselectedId)
            ->first();
        //dd($findvehiculo);
        $this->vehiculos_id = $findvehiculo->id;
        
        
    }
    public function salida($id)
    {
        $talleres = Diagnosticont::find($id);

        //dd('hola');
        //return view('home');
        return redirect('trabajorealizant');
    }
}
