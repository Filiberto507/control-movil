<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Diagnostico sin taller</title>
</head>

<body>
    <table class="tablaImage">
        <tr>
            <th width="15%">
                <div class="imagen1"><img src="assets/img/cochabamba.jpg" alt=""></div>
            </th>
            <th width="80%">
                <h1 class="encabezado">ÁREA DE TRANSPORTES</h1>
                <h2>DIAGNÓSTICO TALLER</h2>
            </th>
        </tr>
    </table>
    <table class="tablaEncabezado">
        <tr>
            <th width="18%"><label for="" class="nro">Nro: {{$Diagnostico->numero_diagnostico}}</label></th>
            <th width="60%"></th>
            <th width="22%"><label for="" class="fecha">Fecha: {{$Diagnostico->fecha}}</label></th>
        </tr>
    </table>
    <div style="text-align: center;" class="contImg">
        <img src="assets/img/toyota.png" class="img1">
        <img src="assets/img/hilux.png" class="img2">
    </div>

    <table class="tableDatos">
        <tbody>
            <tr>
                <td>
                    <label for="">Dependencia: {{$Diagnostico->dependencia}}</label>
                </td>
                <td>
                    <label for="">Conductor: {{$Diagnostico->conductor}}</label>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">N° de placa: {{$Diagnostico->placa}}</label>
                </td>
                <td>
                    <label for="">Tipo de vehiculo: {{$Diagnostico->clase}} {{$Diagnostico->marca}} {{$Diagnostico->tipo_vehiculo}}</label>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="contenedorP">
        <div class="contenedorH">
            <h3 class="subtitulo">EVALUACIÓN Y DIAGNÓSTICO DEL VEHÍCULO</h3>
        </div>
    </div>
    <table class="tableItem">
        <thead class="titulo">
            <tr>
                <th width="20%">
                    ITEM
                </th>
                <th width="20%">
                    CANTIDAD
                </th>
                <th width="80%">
                    DESCRIPCIÓN
                </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($DiagnosticoItem as $index => $di)
            <tr class="datos">
            <td class="item">
                    {{$index+1}}
                </td>
                <td class="item">
                    {{$di->item}}
                </td>
                <td>
                    {{$di->descripcion}}
                </td>

            </tr>
            @endforeach
        </tbody>
        @if($Diagnostico->tipo_taller == 1)
        <tfoot class="tfoot">
            <tr>
                <td colspan="3"><strong>OBSERVACIONES: PARA SU COMPRA.  </strong>{{$Diagnostico->observacion}}</td>
            </tr>
        </tfoot>
        @elseif($Diagnostico->tipo_taller == 2)
        <tfoot class="tfoot">
            <tr>
                <td colspan="3"><strong>OBSERVACIONES: TALLER EXTERNO.  </strong>{{$Diagnostico->observacion}}</td>
            </tr>
        </tfoot>
        @endif
        
    </table>
    <footer>
        <div style="text-align: center;  margin-top:30px;">
            <strong>TALLER MAESTRANZA telf. 4707726</strong><br>
            <font style="vertical-align: inherit">
                <font style="vertical-align: inherit">VALIDEZ DEL DIAGNOSTICO: 45 DIAS CALENDARIO</font>
            </font>
            <br>
            <font style="vertical-align: inherit">
                <font style="vertical-align: inherit">Cochabamba-Bolivia</font>
            </font>
        </div>
    </footer>

    <table class="firma">

        <tr>
            <td>{{$Diagnostico->responsable}}</td>
            <td>{{$Diagnostico->conductor}}</td>
        </tr>
        <tr>
            <th>TECNICO MECANICO</th>
            <th>CONDUCTOR
            </th>
        </tr>
    </table>
</body>

</html>
<style>
    .tablaImage {
        width: 100%;
    }

    img {
        width: 150px;
        height: 150px;
    }

    .imagen1 {
        text-align: left;

    }

    .imagen3 {
        text-align: right;
    }

    .tablaEncabezado {
        width: 100%;
    }

    .nro {
        text-align: left;
        border: 1px solid;
        border-radius: 3px;
    }

    .encabezado {
        text-align: center;
    }

    .fecha {
        text-align: right;
    }

    .titulo {
        background-color: white;
        color: black;
        font-size: 20px;
        border-collapse: collapse;
        border: 1px solid;
    }

    .img1 {
        width: 200px;
        height: 150px;
        padding-left: 80px;
    }

    .img2 {
        width: 150px;
        height: 90px;
        padding-right: 100px;
        padding-bottom: 20px;
    }

    .contenedorH {
        padding-left: 15%;
    }

    .subtitulo {
        text-align: center;
        width: 80%;
        border: 2px solid;
        border-radius: 8px;
        padding: 0;
    }

    .tableDatos {
        width: 100%;
        border-collapse: collapse;
    }

    .tableDatos td {
        border: 1px solid;
    }

    .tableItem {
        width: 100%;
        border-collapse: collapse;
    }

    .tableItem td {
        border: 1px solid;
    }

    .datos {
        text-align: left;
    }

    .item {
        text-align: center;
    }

    .tableItem tfoot {
        border: 1px solid;
    }

    .contImg {
        height: 100px;
    }
       /* firma */
    
       .firma{
        border-collapse: collapse;
        width: 100%;
        margin: auto;
        margin-top: 100px;
    }

    .firma th{
        width: 50%;
    }

    .firma td{
        text-align: center;
    }
</style>