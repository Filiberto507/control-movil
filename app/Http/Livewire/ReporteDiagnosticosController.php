<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Conductor;
use App\Models\Vehiculos;
use App\Models\Diagnostico;
use App\Models\Diagnostico_area_transporte;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Estadovehiculo;
use DB;

class ReporteDiagnosticosController extends Component
{
    use WithPagination;

    public $search, $selected_id, $pageTitle, $componentName;
    
    //select2
    public $vehiculodatos;
    // fechas
    public $dateFrom, $dateTo;

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
        $this->componentName = 'REPORTE DE DIAGNÓSTICOS';
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
            $Diagnostico = Diagnostico::where('id', 'like', '%' . $this->search . '%');
            $DiagnosticoAreaT = Diagnostico_area_transporte::where('id', 'like', '%' . $this->search . '%')
            ->whereBetween('created_at', [$from,$to])
            ->get();
        }
            
        elseif(strlen($this->search) > 0){
            $Diagnostico = Diagnostico::where('id', 'like', '%' . $this->search . '%')->get();
            $DiagnosticoAreaT = Diagnostico_area_transporte::where('id', 'like', '%' . $this->search . '%')->get();
            
        }

        else{
                $Diagnostico = Diagnostico::orderBy('id', 'desc')->get();
                $DiagnosticoAreaT = Diagnostico_area_transporte::orderBy('id', 'desc')->get();
        }
        
        //dd($Diagnostico);
        return view('livewire.reporte_diagnosticos.component', [
            'data' => $Diagnostico,
            'Diagnostico_area_transporte' => $DiagnosticoAreaT
        ])
            //extender de layouts
            ->extends('layouts.theme.app')
            //renderizarse
            ->section('content');
    }
}
