<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Taller;
use App\Models\accesoriostaller;
use App\Models\Conductor;
use App\Models\Vehiculos;
use App\Models\TrabajoRealizadoTaller;
use App\Models\tallerdetalle;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Diagnostico;
use App\Models\Estadovehiculo;
use Database\Seeders\TallerDetallerSeeder;
use DB;

class ReporteTallerController extends Component
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
        $this->componentName = 'REPORTE DE MAESTRANZA';
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
            $Taller = Taller::where('placa', 'like', '%' . $this->search . '%')
            ->whereBetween('fecha_ingreso', [$from,$to])
            ->orderBy('id', 'desc')
            ->get();
        }
            
        elseif(strlen($this->search) > 0){
            $Taller = Taller::where('placa', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->get();
            //dd($Taller);
            
        }

        else{
                $Taller = Taller::orderBy('id', 'desc')->get();
        }

        $TrabajoRealizadoTaller = TrabajoRealizadoTaller::orderBy('id', 'desc')->get();
        
        $algo = TrabajoRealizadoTaller::where('taller_id', 4)->get();
        //dd($Taller);
        $Diagnostico = Diagnostico::join('vehiculos as v', 'v.id', 'diagnosticos.vehiculos_id')
        ->select('diagnosticos.*', 'v.id as vehiculos', 'v.placa', 'v.marca')
        ->orderBy('id', 'desc')->get();
        //dd($Diagnostico);
            
        $this->vehiculodatos = Vehiculos::orderby('id', 'desc')
            ->get();

        //dd($Taller);

        //dd($this->vehiculoselectedName);

        return view('livewire.ReporteTaller.component', [
            'data' => $Taller,
            'vehiculodatos' => $this->vehiculodatos,
            'TrabajoRealizadoTaller' => $TrabajoRealizadoTaller,
            'Diagnostico' => $Diagnostico,
            'conductor' => Conductor::orderby('name', 'asc')->get()
        ])
            //extender de layouts
            ->extends('layouts.theme.app')
            //renderizarse
            ->section('content');
    }
}
