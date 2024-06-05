<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Movilidad</title>
    <link rel="stylesheet" href="{{ asset('assets/css/controlmovil.css') }}">
</head>
<body>
    <div class="container">
        <h1>CONTROL DE MOVILIDAD DEL G.A.M. DE ARBIETO 2024</h1>
        <table>
            <thead>
                <tr>
                    <th colspan="2">MOVILIDAD: {{$datatitulo->vehiculo}}</th>
                    <th colspan="4">CORRESPONDE A LA AREA: {{$datatitulo->dependencia}}</th>
                    <th colspan="1">MES DE:  {{$nombreDelMes}}</th>
                    <th colspan="1">PLACA: {{$datatitulo->placa}}</th>
                </tr>
                <tr>
                    <th>NOMBRE Y APELLIDO</th>
                    <th>FECHA</th>
                    <th>HORA DE SALIDA</th>
                    <th>HORA DE RETORNO</th>
                    <th>KILOMETRAJE DE SALIDA</th>
                    <th>KILOMETRAJE DE REGRESO</th>
                    <th>NÚMERO DE VALE O CANTIDAD DE COMBUSTIBLE</th>
                    <th>TIPO DE ACTIVIDAD - DESTINO Y LUGAR</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $di)
                <tr class="datos">
                    <td class="item">
                    {{$di->conductor}}
                    </td>
                    <td class="item">
                        
                        {{\Carbon\Carbon::parse($di->created_at)->format('d-m-Y')}}
                    </td>
                    <td>
                        {{$di->hora_salida}}
                    </td>
                    <td>
                        {{$di->hora_retorno}}
                    </td>
                    <td>
                        {{$di->km_salida}}
                    </td>
                    <td>
                        {{$di->km_regreso}}
                    </td>
                    <td>
                        {{$di->combustible}}
                    </td>
                    <td>
                        {{$di->tipo_destino}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>