<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="{{ asset('assets/css/trabajo.css') }}">

    <title>Reporte Trabajo Realizado</title>
</head>

<body>
    <table class="encabezado">
        <tr>
            <td class="colenca1">
                <img class="img-co" src="assets/img/cochabamba.jpg" alt="Imagen del cochabamba">
            </td>
            <td class="colenca2">
                AREA DE TRANSPORTES
                <BR></BR>
                TRABAJO REALIZADOS
            </td>
        </tr>
    </table>
    <h2>REPORTE DIARIO DE MANTENIMIENTO VEHICULARES EN TALLER DE MAESTRANZA (GOBERNACION-EXCORDECO)</h2>

    <table class="datos">
        <tr>
            <td class="columna1">
                Tipo Vehiculo: {{$vehiculo}}
                @php
                //dd($taller->clase, $vehiculo, $taller->tipo_vehiculo);
                @endphp
            </td>
            <td class="columna2">
                Placa: {{$placa}}
            </td>
        </tr>
        <tr>
            <td>
                SECR./DIR./UNIDAD: {{$dependencia}}
            </td>
            <td>
                Responsable: {{$responsable}}
            </td>
        </tr>

        <tr>
            <td>
                Km. INGRESO: {{$km_ingreso}}
            </td>
            <td>
                Fecha: {{$fecha_ingreso}}
            </td>
        </tr>

        <tr>
            <td>
                Km. SALIDA; {{$km_salida}}
            </td>
            <td>
                Fecha; {{$fecha_salida}}
            </td>
        </tr>
    </table>
    <h2>TRABAJOS REALIZADOS (TALLER INTERNO MAESTRANZA)</h2>
    @php
    $totalItems = count($trabajorealizado);
    $halfItems = ceil($totalItems / 2);
    $firstColumn = array_slice($trabajorealizado, 0, $halfItems);
    $secondColumn = array_slice($trabajorealizado, $halfItems);
    @endphp
    <table class="table-check">
        <tr>
            <td class="check-column">
                @foreach($primeros10 as $pr)
                <div class="checkbox-item">
                    <input type="checkbox" id="checkbox1" name="checkbox1" {{ $pr->checked == 1 ? 'checked': '' }}>
                    <label for="checkbox1" class="custom-checkbox-label">
                        <span class="custom-checkbox">{{ $pr->checked == 1 ? '✓' : 'X' }}</span>
                        <input type="checkbox" id="checkbox1" class="checkmark" name="checkbox1" {{ $pr->checked == 1 ? 'checked': '' }}>
                        <span class="checkmark"></span> <!-- Capa adicional para el check original -->
                        {{$pr->descripcion}}
                    </label>
                </div>

                @endforeach
                <!-- Repite las siguientes líneas de código para agregar más elementos -->
            </td>
            <td class="check-column">
                @foreach($segundos10 as $se)
                <div class="checkbox-item">
                    <input type="checkbox" id="checkbox1" name="checkbox1" {{ $se->checked == 1 ? 'checked': '' }}>
                    <label for="checkbox1" class="custom-checkbox-label">
                        <span class="custom-checkbox">{{ $se->checked == 1 ? '✓' : 'X' }}</span>
                        <input type="checkbox" id="checkbox1" class="checkmark" name="checkbox1" {{ $se->checked == 1 ? 'checked': '' }}>
                        <span class="checkmark"></span> <!-- Capa adicional para el check original -->
                        {{$se->descripcion}}
                    </label>
                </div>
                @endforeach
                <!-- Repite las siguientes líneas de código para agregar más elementos -->
            </td>
        </tr>


    </table>

    <table class="footer">
        <tfoot>
            @if($totalItems < 6) <tr>
                <td colspan="3"> <strong>Observaciones: </strong> {{$tallerdatos->observaciones}}</td>
                </tr>
                @else
                <tr>
                    <td colspan="2">Observaciones: {{ $tallerdatos->observaciones }}</td>
                </tr>
                @endif
        </tfoot>
    </table>

    <table class="firma">

        <tr>
            <td>{{$responsable}}</td>
            <td>{{$diagnostico_id->conductor}}</td>
        </tr>
        <tr>
            <th>TECNICO MECANICO</th>
            <th>CONDUCTOR
            </th>
        </tr>
    </table>

</body>

</html>