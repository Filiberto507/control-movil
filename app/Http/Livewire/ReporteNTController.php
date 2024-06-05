<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Diagnosticont;
use App\Models\accesoriostaller;
use App\Models\Conductor;
use App\Models\Vehiculos;
use App\Models\TrabajoRealizadoTaller;
use App\Models\tallerdetalle;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Diagnostico;
use App\Models\DiagnosticoAreaTransportent;
use Database\Seeders\TallerDetallerSeeder;
use DB;

class ReporteNTController extends Component
{
    use WithPagination;

    public $TallerName, $search, $selected_id, $pageTitle, $componentName, $check = [];
    public $ingreso, $salida, $fecha_ingreso, $fecha_salida, $name, $vehiculo, $color,
        $dependencia, $placa, $kilometraje, $ordentrabajo, $acctaller, $acctaller2;
    //select2
    public $vehiculoselectedId, $vehiculoselectedName, $vehiculodatos;
    // fechas
    public $dateFrom, $dateTo;

    //estado de vehiculo img
    public $estadovehiculo = [];


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
        $this->pageTitle = 'LISTADO';
        $this->componentName = 'REPORTE DE MAESTRANZA SIN TALLER';
        $this->vehiculoselectedName = 'Elegir';
        $this->name = 'Elegir';

        //dd($this->ingreso, $this->fecha_ingreso);
        //     $this->check=[
        //         "12, Estuche de Herramientas",
        // "18, Luz de Placa"
        //     ];
    }
    public function render()
    {
        //validar si el usuario ingreso informacion
        if ((strlen($this->search) > 0) && ($this->dateFrom != null) && ($this->dateTo != null)){
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
            $Taller = Diagnosticont::join('vehiculos as v', 'v.id', 'diagnosticonts.vehiculos_id')
            ->select('diagnosticonts.*', 'v.id as vehiculos', 'v.placa', 'v.marca')
            ->where('placa', 'like', '%' . $this->search . '%')
            ->whereBetween('fecha_ingreso', [$from,$to])
            ->orderBy('id', 'desc')
            ->get();
        }
            
        elseif(strlen($this->search) > 0){
            $Taller = Diagnosticont::join('vehiculos as v', 'v.id', 'diagnosticonts.vehiculos_id')
            ->select('diagnosticonts.*', 'v.id as vehiculos', 'v.placa', 'v.marca')
            ->where('placa', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->get();
            //dd($Taller);
            
        }

        else{
                $Taller = Diagnosticont::join('vehiculos as v', 'v.id', 'diagnosticonts.vehiculos_id')
                ->select('diagnosticonts.*', 'v.id as vehiculos', 'v.placa', 'v.marca')
                ->orderBy('id', 'desc')->get();
        }

        //dd($Taller);
        $Diagnostico = DiagnosticoAreaTransportent::join('vehiculos as v', 'v.id', 'diagnostico_area_transportents.vehiculos_id')
        ->select('diagnostico_area_transportents.*', 'v.id as vehiculos', 'v.placa', 'v.marca')
        ->orderBy('id', 'desc')->get();
        //dd($Diagnostico);
            
        $this->vehiculodatos = Vehiculos::orderby('id', 'desc')
            ->get();

        //dd($Diagnostico);

        //dd($this->vehiculoselectedName);

        return view('livewire.reporteNT.component', [
            'data' => $Taller,
            'vehiculodatos' => $this->vehiculodatos,
            'Diagnostico' => $Diagnostico,
            'conductor' => Conductor::orderby('name', 'asc')->get()
        ])
            //extender de layouts
            ->extends('layouts.theme.app')
            //renderizarse
            ->section('content');
    }
}
