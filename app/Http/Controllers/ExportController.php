<?php

namespace App\Http\Controllers;

use App\Http\Livewire\DiagnosticontController;
use Illuminate\Http\Request;
//importar todo lo requerido para el pdf
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
//modelos
use App\Models\Conductor;
use App\Models\Vehiculos;
use App\Models\Taller;
use App\Models\tallerdetalle;
use App\Models\Diagnostico_area_transporte;
use App\Models\Diagnostico;
use App\Models\accesoriostaller;
use App\Models\DiagnosticoItem;
use App\Models\Estadovehiculo;
use App\Models\TrabajoRealizadoTaller;
use App\Models\Diagnosticont;
use App\Models\TrabajoRealizadont;
use App\Models\DiagnosticontItem;
use App\Models\Controlmovil;


class ExportController extends Controller
{
    public $check = [];
    public function reportPDF($id)
    {

        $tallerdatos = Taller::find($id);
        //datos para el reporte
        $datosestadovehiculo = [];

        for ($i = 0; $i < 11; $i++) {
            $datosestadovehiculo[$i] = [];
        }
        /*$cadena = $tallerdatos->fecha_ingreso;
        $separador = "-";
        $s = explode($separador, $cadena);*/

        $fecha_ingreso = $tallerdatos->fecha_ingreso;
        //dd($fecha_ingreso);
        $fecha_salida = $tallerdatos->fecha_salida;
        $hora_ingreso = $tallerdatos->ingreso;
        $hora_salida = $tallerdatos->salida;
        $nombre = $tallerdatos->conductor;
        $vehiculo = $tallerdatos->vehiculo;
        $color = $tallerdatos->color;
        $dependencia = $tallerdatos->dependencia;
        $placa = $tallerdatos->placa;
        $kilometraje = $tallerdatos->kilometraje;
        $estadovehiculo = Estadovehiculo::where('taller_id', $id)->get();

        foreach ($estadovehiculo as $value) {
            $datosestadovehiculo[$value->key] = [
                'descripcion' => $value->descripcion,
            ];
        }
        $ordentrabajo = $tallerdatos->ordentrabajo;

        $separador = "\n"; // Usar salto de línea
        $separarord = explode($separador, $ordentrabajo);
        // dd($separarord);


        //obtener los checks
        $acctalleres = accesoriostaller::orderBy('id', 'asc')->get();
        
        //dd($acctalleres);
        //foreach para agregar si tiene el checked
        foreach ($acctalleres as $tall) {
            //buscado el id del taller
            //dd($tallerherr->id);
            //obtenemos todos los id de las herramientas que tiene el taller id
            $tallerherramientas = tallerdetalle::where('taller_id', $tallerdatos->id)->get();
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

       //dd($acctalleres);

        // Colecciones separadas
        $primeros10 = collect();
        $segundos10 = collect();
        $ultimos10 = collect();
        $a = 0;
        $b = 1;
        $c = 2;
        foreach ($acctalleres as $key => $value) {
            if ($key == $a) {
                $primeros10->push($value);
                $a = $a + 3;
            }

            if ($key == $b) {
                $segundos10->push($value);
                $b = $b + 3;
            }

            if ($key == $c) {
                $ultimos10->push($value);
                $c = $c + 3;
            }
        }
        //dd($primeros10, $segundos10, $ultimos10);   

        /*//la funcion chunk divide el segmento segun el rango especificado
        $segmentos = $acctalleres->chunk($acctalleres->count() / 3);
        //dd($segmentos);

        $primeros10 = $segmentos[0];
        $segundos10 = $segmentos[1];
        //la funcion collect + concat ayudar a concadenar una coleccion
        $ultimos10 = collect($segmentos[2])->concat($segmentos[3]);
        */

        //validar la palabra user
        //$user = $id == 0 ? 'Todos' : User::find($userId)->name;
        //usar lo importado del PDF
        //loadView = pasando la vista
        // tamaño oficio -> 609.45, 935.43
        //ajuste perfecto en 73 al imprimir
        //tamaño anterior -> 0, 0, 680, 1170
        $pdf = PDF::setPaper([0, 0, 700, 1200])->loadView('pdf.reporte1', compact(
            'tallerdatos',
            'hora_ingreso',
            'hora_salida',
            'fecha_ingreso',
            'fecha_salida',
            'primeros10',
            'segundos10',
            'ultimos10',
            'nombre',
            'vehiculo',
            'color',
            'dependencia',
            'placa',
            'kilometraje',
            'datosestadovehiculo',
            'separarord'
        ));
        //visualizar en el navegador
        return $pdf->stream('salesReport.pdf');
        //para descargar el reporte en pdf
        //return $pdf->download('salesReport.pdf');
    }

    public function reportTrabajo($id)
    {

        $tallerdatos = TrabajoRealizadoTaller::find($id);
        //datos para el reporte
        /*$cadena = $tallerdatos->fecha_ingreso;
        $separador = "-";
        $s = explode($separador, $cadena);*/
        //dd($tallerdatos);
        $taller=Taller::find($tallerdatos->taller_id);
        //dd($taller);
        //$conductor = $taller->name;
        $fecha_ingreso = $tallerdatos->fecha_ingreso;
        //dd($fecha_ingreso);
        $fecha_salida = $tallerdatos->fecha_salida;
        $vehiculo = $tallerdatos->vehiculo;
        $placa = $tallerdatos->placa;
        $dependencia = $tallerdatos->dependencia;
        $responsable = $tallerdatos->responsable;
        $km_ingreso = $tallerdatos->km_ingreso;
        $km_salida = $tallerdatos->km_salida;
        $descripcion = $tallerdatos->descripcion;
        $observaciones  = $tallerdatos->observaciones;


        /*// Longitud deseada para cada fragmento
        $longitud = 110;

        // Divide el texto por el salto de línea
        $lineas = explode("\n", $descripcion);
        //dump($lineas);
        // Inicializa un arreglo para los fragmentos finales
        $trabajorealizado = [];

        // Recorre cada línea y utiliza str_split para dividir por longitud
        foreach ($lineas as $linea) {
            $fragmentos_linea = str_split($linea, $longitud);
            $trabajorealizado = array_merge($trabajorealizado, $fragmentos_linea);
        }*/
        $trabajorealizado = explode('-', $descripcion);
        $trabajorealizado = array_filter($trabajorealizado);
        $checktrabajo = collect();

       
        foreach ($trabajorealizado as $key => $value) {
            $checktrabajo->push([
                'servicio' => $value,
                'checked' => '',
            ]);
        }
        //dd($checktrabajo);
        //obtener los checks
        //dd($taller->id);
        $diagnostico_id = Diagnostico::where('taller_id', $taller->id)->first();
        //dd($diagnostico_id->id);
        $checksdiagnostico = DiagnosticoItem::where('diagnosticos_id',$diagnostico_id->id)->get();

        //dd($checksdiagnostico);
        //foreach para agregar si tiene el checked
        foreach ($checksdiagnostico as $tall) {
            //buscado el id del taller
            //dd($tallerherr->id);
            //obtenemos todos los id de las herramientas que tiene el taller id
            //$tallerherramientas = tallerdetalle::where('taller_id', $tallerdatos->id)->get();
            //dd($tallerherramientas);

            //buscamos si existe esa herramienta agregado o no
            $obtenercheck = $checktrabajo->where('servicio', $tall->descripcion)->first();
            //dump($obtenercheck);
            //exists sirve para obtener valor en boleano
            //$this->roles()->where('nombre', $nombreRol)->exists();

            // verificar si tenemos datos en obtenercheck
            if ($obtenercheck) {
                //dump($obtenercheck->acctaller_id);
                //$addcheck = accesoriostaller::find($obtenercheck->acctaller_id);
                //dump($addcheck);
                $tall->checked = 1;
                
                //$acctalleres->pull($tall->id);
            }
        }

        //dd($checksdiagnostico);

        // Colecciones separadas
        $primeros10 = collect();
        $segundos10 = collect();
        $ultimos10 = collect();
        $a = 0;
        $b = 1;
        $c = 2;
        foreach ($checksdiagnostico as $key => $value) {
            if ($key == $a) {
                $primeros10->push($value);
                $a = $a + 2;
            }

            if ($key == $b) {
                $segundos10->push($value);
                $b = $b + 2;
            }

        }
        //dd($primeros10, $segundos10);   

        //dd($trabajorealizado);
       //dd($trabajorealizado);
        //dd($taller->clase);
        //{{$taller->clase}} {{$vehiculo}} {{$taller->tipo_vehiculo}}
        //validar la palabra user
        //$user = $id == 0 ? 'Todos' : User::find($userId)->name;
        //usar lo importado del PDF
        //loadView = pasando la vista
        // tamaño oficio -> 609.45, 935.43
        //ajuste perfecto en 73 al imprimir
        $pdf = PDF::setPaper([0, 0, 680, 900])->loadView('pdf.trabajo', compact(
            'fecha_ingreso',
            'fecha_salida',
            'vehiculo',
            'placa',
            'dependencia',
            'responsable',
            'km_ingreso',
            'km_salida',
            'trabajorealizado',
            'observaciones',
            'taller',
            'tallerdatos',
            'primeros10',
            'segundos10',
            'ultimos10'
        ));
        //visualizar en el navegador
        return $pdf->stream('Trabjo-Realizado.pdf');
        //para descargar el reporte en pdf
        //return $pdf->download('salesReport.pdf');
    }

    public function reportTrabajoNT($id)
    {

        $tallerdatos = TrabajoRealizadont::find($id);
        //datos para el reporte
        /*$cadena = $tallerdatos->fecha_ingreso;
        $separador = "-";
        $s = explode($separador, $cadena);*/
        //dd($tallerdatos);
        
        //dd($taller);
        //$conductor = $taller->name;
        $fecha_ingreso = $tallerdatos->fecha_ingreso;
        //dd($fecha_ingreso);
        $fecha_salida = $tallerdatos->fecha_salida;
        $vehiculo = $tallerdatos->vehiculo;
        $placa = $tallerdatos->placa;
        $dependencia = $tallerdatos->dependencia;
        $responsable = $tallerdatos->responsable;
        $km_ingreso = $tallerdatos->km_ingreso;
        $km_salida = $tallerdatos->km_salida;
        $descripcion = $tallerdatos->descripcion;
        $observaciones  = $tallerdatos->observaciones;


        /*// Longitud deseada para cada fragmento
        $longitud = 110;

        // Divide el texto por el salto de línea
        $lineas = explode("\n", $descripcion);
        //dump($lineas);
        // Inicializa un arreglo para los fragmentos finales
        $trabajorealizado = [];

        // Recorre cada línea y utiliza str_split para dividir por longitud
        foreach ($lineas as $linea) {
            $fragmentos_linea = str_split($linea, $longitud);
            $trabajorealizado = array_merge($trabajorealizado, $fragmentos_linea);
        }*/
        $trabajorealizado = explode('-', $descripcion);
        $trabajorealizado = array_filter($trabajorealizado);
        $checktrabajo = collect();

       
        foreach ($trabajorealizado as $key => $value) {
            $checktrabajo->push([
                'servicio' => $value,
                'checked' => '',
            ]);
        }
        //dd($checktrabajo);
        //obtener los checks
        //dd($taller->id);
        $diagnostico_id = Diagnosticont::where('id', $tallerdatos->id)->first();
        //dd($diagnostico_id->id);
        $checksdiagnostico = DiagnosticontItem::where('diagnosticosnt_id',$diagnostico_id->id)->get();

        //dd($checksdiagnostico);
        //foreach para agregar si tiene el checked
        foreach ($checksdiagnostico as $tall) {
            //buscado el id del taller
            //dd($tallerherr->id);
            //obtenemos todos los id de las herramientas que tiene el taller id
            //$tallerherramientas = tallerdetalle::where('taller_id', $tallerdatos->id)->get();
            //dd($tallerherramientas);

            //buscamos si existe esa herramienta agregado o no
            $obtenercheck = $checktrabajo->where('servicio', $tall->descripcion)->first();
            //dump($obtenercheck);
            //exists sirve para obtener valor en boleano
            //$this->roles()->where('nombre', $nombreRol)->exists();

            // verificar si tenemos datos en obtenercheck
            if ($obtenercheck) {
                //dump($obtenercheck->acctaller_id);
                //$addcheck = accesoriostaller::find($obtenercheck->acctaller_id);
                //dump($addcheck);
                $tall->checked = 1;
                
                //$acctalleres->pull($tall->id);
            }
        }

        //dd($checksdiagnostico);

        // Colecciones separadas
        $primeros10 = collect();
        $segundos10 = collect();
        $ultimos10 = collect();
        $a = 0;
        $b = 1;
        $c = 2;
        foreach ($checksdiagnostico as $key => $value) {
            if ($key == $a) {
                $primeros10->push($value);
                $a = $a + 2;
            }

            if ($key == $b) {
                $segundos10->push($value);
                $b = $b + 2;
            }

        }
        //dd($primeros10, $segundos10);   

        //dd($trabajorealizado);
       //dd($trabajorealizado);
        //dd($taller->clase);
        //{{$taller->clase}} {{$vehiculo}} {{$taller->tipo_vehiculo}}
        //validar la palabra user
        //$user = $id == 0 ? 'Todos' : User::find($userId)->name;
        //usar lo importado del PDF
        //loadView = pasando la vista
        // tamaño oficio -> 609.45, 935.43
        //ajuste perfecto en 73 al imprimir
        $pdf = PDF::setPaper([0, 0, 680, 900])->loadView('pdf.trabajont', compact(
            'fecha_ingreso',
            'fecha_salida',
            'vehiculo',
            'placa',
            'dependencia',
            'responsable',
            'km_ingreso',
            'km_salida',
            'trabajorealizado',
            'observaciones',
            'diagnostico_id',
            'tallerdatos',
            'primeros10',
            'segundos10',
            'ultimos10'
        ));
        //visualizar en el navegador
        return $pdf->stream('Trabjo-Realizado.pdf');
        //para descargar el reporte en pdf
        //return $pdf->download('salesReport.pdf');
    }

    public function reportResponsable($id, $reportType, $dateFrom = null, $dateTo = null)
    {   
        //dd($id, $reportType, $dateFrom, $dateTo);
         //obtener las ventas del dia 
         if($reportType == 0)// ventas del dia
         {
             //obtener fecha de hoy
             $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
             $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
         } else {
             //obtener fechas especificadas por el usuario
             $from = Carbon::parse($dateFrom)->format('Y-m-d') . ' 00:00:00';
             $to = Carbon::parse($dateTo)->format('Y-m-d') . ' 23:59:59';
         }
         //validar si el usuario esta usando un tipo de reporte
         if($reportType == 1 && ($dateFrom == '' || $dateTo == '')) {
             return;
         }
         //validar si seleccionamos algun usuario
         if($id == 0){
             //consulta
             $data = Taller::leftJoin('diagnosticos as d', 'd.taller_id', 'tallers.id')
             ->leftJoin('diagnostico_area_transportes as dt', 'dt.taller_id', 'tallers.id')
             ->select('tallers.*', 'd.numero_diagnostico as diagnostico', 'dt.numero_diagtransporte as diagnosticotransporte', 'd.tipo_taller', 'd.observacion')
             ->whereBetween('tallers.fecha_ingreso', [$from,$to])
             ->orderBy('tallers.id', 'desc')->get();
            
             
             //dd($data);
         } else {
             //dd($vehiculoselectedId);
             $data = Taller::leftJoin('diagnosticos as d', 'd.taller_id', 'tallers.id')
             ->leftJoin('diagnostico_area_transportes as dt', 'dt.taller_id', 'tallers.id')
             ->select('tallers.*', 'd.numero_diagnostico as diagnostico', 'dt.numero_diagtransporte as diagnosticotransporte', 'd.tipo_taller', 'd.observacion')
             ->where('vehiculo_id', $id)
             ->whereBetween('tallers.fecha_ingreso', [$from,$to])
             ->orderBy('tallers.id', 'desc')->get();

             $diagnosnt = Diagnosticont::leftJoin('diagnostico_area_transportents as da', 'da.diagnosticont_id', 'diagnosticonts.id')
             ->select('diagnosticonts.*', 'da.numero_diagtransporte as diagnosticotransporte')
             ->where('diagnosticonts.vehiculos_id', $id)
             ->whereBetween('diagnosticonts.fecha', [$from,$to])
             ->orderBy('diagnosticonts.id', 'desc')->get();
         }
         $vehiculodato= Vehiculos::find($id);
         //dd($diagnosnt);
         $fecha = Carbon::parse(Carbon::now())->format('Y-m-d');
        $pdf = PDF::setPaper([0, 0, 680, 1000])->loadView('pdf.reporte_responsable', compact(
            'data',
            'vehiculodato',
            'fecha',
            'diagnosnt',
            
        ));
        //visualizar en el navegador
        return $pdf->stream('ReportResponsable.pdf');
        //para descargar el reporte en pdf
        //return $pdf->download('salesReport.pdf');
    }
    function obtenerNombreDelMes($numeroDelMes) {
        $meses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];
    
        return isset($meses[$numeroDelMes]) ? $meses[$numeroDelMes] : 'Mes inválido';
    }

    public function Controlpdf($id, $mes)
    {   


        // dd($id,$mes);
         $data = Controlmovil::where('controlmovils.vehiculo_id', $id)
            ->whereMonth('controlmovils.created_at', $mes)
            ->orderBy('controlmovils.id', 'desc')->get();

        $nombreDelMes = $this->obtenerNombreDelMes($mes);
        //dd($nombreDelMes);
        $datatitulo = $data->where('vehiculo_id', $id)->first();
        
         $fecha = Carbon::parse(Carbon::now())->format('Y-m-d');
        $pdf = PDF::setPaper([0, 0, 1000, 600])->loadView('pdf.controlmovil', compact(
            'data',
            'datatitulo',
            'nombreDelMes'
            
            
        ));
        //visualizar en el navegador
        return $pdf->stream('controlmovil.pdf');
        //para descargar el reporte en pdf
        //return $pdf->download('salesReport.pdf');
    }


    
}
