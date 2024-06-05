<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Taller;
use App\Models\Diagnostico;
use App\Models\Diagnostico_area_transporte;
use App\Models\TrabajoRealizadoTaller;
use App\Models\Diagnosticont;
use App\Models\DiagnosticoAreaTransportent;
use App\Models\Vehiculos;
use Carbon\Carbon;

class ReporteResponsableController extends Component
{
    public $componentName, $data, $details, $sumDetails, $countDetails, 
    $reportType, $userId, $dateFrom, $dateTo, $saleId, $diagnosnt;


    //select2
    public $vehiculoselectedId, $vehiculoselectedName, $vehiculodatos;
    //propiedades de las vistas
    public function mount(){
        $this->componentName = 'Reportes Area de Transportes';
        $this->data = [];
        $this->diagnosnt = [];
        $this->details = [];
        $this->sumDetails = 0;
        $this->countDetails = 0;
        $this->reportType = 0;
        $this->userId = 0;
        $this->saleId = 0;

    }
    public function render()
    {

        $this->vehiculodatos = Vehiculos::orderby('id', 'desc')
            ->get();

        return view('livewire.ReporteResponsable.component',[
            'vehiculodatos' => $this->vehiculodatos
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
    //metodo retornar reporte de la fecha
    public function SalesByDate()
    {
        //obtener las ventas del dia 
        if($this->reportType == 0)// ventas del dia
        {
            //obtener fecha de hoy
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        } else {
            //obtener fechas especificadas por el usuario
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
        }
        //validar si el usuario esta usando un tipo de reporte
        if($this->reportType == 1 && ($this->dateFrom == '' || $this->dateTo == '')) {
            return;
        }
        //validar si seleccionamos algun usuario
        if($this->vehiculoselectedName == 0){
            //consulta
            $this->data = Taller::leftJoin('diagnosticos as d', 'd.taller_id', 'tallers.id')
            ->leftJoin('diagnostico_area_transportes as dt', 'dt.taller_id', 'tallers.id')
            ->select('tallers.*', 'd.numero_diagnostico as diagnostico', 'dt.numero_diagtransporte as diagnosticotransporte', 'd.tipo_taller')
            ->whereBetween('tallers.fecha_ingreso', [$from,$to])
            ->orderBy('tallers.id', 'desc')->get();

            $this->diagnosnt = Diagnosticont::leftJoin('diagnostico_area_transportents as da', 'da.diagnosticont_id', 'diagnosticonts.id')
             ->select('diagnosticonts.*', 'da.numero_diagtransporte as diagnosticotransporte')
             ->whereBetween('diagnosticonts.fecha', [$from,$to])
             ->orderBy('diagnosticonts.id', 'desc')->get();
             //dd(count($this->diagnosnt));
            //dd($this->data);
        } else {
            //dd($this->vehiculoselectedId);
            $this->data = Taller::leftJoin('diagnosticos as d', 'd.taller_id', 'tallers.id')
            ->leftJoin('diagnostico_area_transportes as dt', 'dt.taller_id', 'tallers.id')
            ->select('tallers.*', 'd.numero_diagnostico as diagnostico', 'dt.numero_diagtransporte as diagnosticotransporte', 'd.tipo_taller')
            ->where('vehiculo_id', $this->vehiculoselectedId)
            ->whereBetween('tallers.fecha_ingreso', [$from,$to])
            ->orderBy('tallers.id', 'desc')->get();

            $this->diagnosnt = Diagnosticont::leftJoin('diagnostico_area_transportents as da', 'da.diagnosticont_id', 'diagnosticonts.id')
             ->select('diagnosticonts.*', 'da.numero_diagtransporte as diagnosticotransporte')
             ->where('diagnosticonts.vehiculos_id', $this->vehiculoselectedId)
             ->whereBetween('diagnosticonts.fecha', [$from,$to])
             ->orderBy('diagnosticonts.id', 'desc')->get();
            //dd(count($this->diagnosnt));
        }
    }
}
