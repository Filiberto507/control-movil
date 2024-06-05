<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Diagnóstico sin taller</title>
</head>

<body>
    <table class="tablaImage">
        <tr>
            <th width="15%">
                <div class="imagen1"><img src="assets/img/cochabamba.jpg" alt=""></div>
            </th>
            <th width="80%">
                <h1 class="encabezado">ÁREA DE TRANSPORTES</h1>
                <h2>DIAGNÓSTICO AREA DE TRANSPORTES</h2>
            </th>
        </tr>
    </table>
    <table class="tablaEncabezado">
        <tr>
            <th width="20%"><label for="" class="fecha">Nro: {{$DiagnosticoAreaT->numero_diagtransporte}}</label></th>
            <th width="20%"><label for="" class="nro"><span class="bolded">A: </span>{{$DiagnosticoAreaT->dependencia}}</label></th>
            <th width="30%"><label for="" class="nro"><span class="bolded">DE: </span>Taller Maestranza</label></th>
            <th width="30%"><label for="" class="fecha"><span class="bolded">FECHA: </span>{{$DiagnosticoAreaT->fecha}}</label></th>
        </tr>
    </table>
    <p>Para su conocimiento, se remite a su autoridad el presente diagnóstico vehicular:</p>
    <table class="tableDatos">
        <tbody>
            <tr>
                <td colspan="1" width="60%">
                    <label for=""><span class="bolded">TIPO DE VEHÍCULO: </span> {{$DiagnosticoAreaT->clase}} {{$DiagnosticoAreaT->marca}} {{$DiagnosticoAreaT->tipo_vehiculo}}</label>
                </td>
                <td colspan="1" width="40%">
                    <label for=""><span class="bolded">CILINDRADA: </span>{{$DiagnosticoAreaT->cilindrada}}</label>
                </td>
            </tr>

            <tr>
                <td>
                    <label for=""><span class="bolded">N° DE PLACA: </span>{{$DiagnosticoAreaT->placa}}</label>
                </td>
                <td>
                    <label for=""><span class="bolded">CHASIS: </span>{{$DiagnosticoAreaT->chasis}}</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for=""><span class="bolded">DIR/UNID/PROY: </span>{{$DiagnosticoAreaT->dependencia}}</label>
                </td>
                <td>
                    <label for=""><span class="bolded">MOTOR: </span>{{$DiagnosticoAreaT->motor}}</label>
                </td>
            </tr>
            <tr>
                <td colspan="1" width="60%">
                    <label for=""><span class="bolded">RESPONSABLE VEHÍCULO: </span> {{$DiagnosticoAreaT->conductor}}</label>
                </td>
                <td colspan="1" width="60%">
                    <label for=""></label>
                </td>
            </tr>
        </tbody>
    </table>
    @if($contreque > 0)
    <p><span class="bolded">REQUERIMIENTO:</span></p>
    <table class="tableItem">
        <thead class="titulo">
            <tr>
                <th width="20%">
                    ITEM
                </th>
                <th width="20%">
                    CANTIDAD
                </th>
                <th width="20%">
                    UNIDAD
                </th>
                <th width="60%">
                    REQUERIMIENTO
                </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($Diagnostico_requerimiento as $dr)
            <tr class="datos">
                <td class="item">
                    {{$dr->item}}
                </td>
                <td class="cant">
                    {{$dr->cantidad}}
                </td>
                <td class="cant">
                    {{$dr->unidad}}
                </td>
                <td>
                    {{$dr->servicio}}
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    @if($contobra > 0)
    <p><span class="bolded">SERVICIO DE MANO DE OBRA:</span></p>
    <table class="tableItem">
        <thead class="titulo">
            <tr>
                <th width="20%">
                    ITEM
                </th>
                <th width="20%">
                    CANTIDAD
                </th>
                <th width="60%">
                    SERVICIO
                </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($Diagnostico_obra as $do)
            <tr class="datos">
                <td class="item">
                    {{$do->item}}
                </td>
                <td class="cant">
                    {{$do->cantidad}}
                </td>
                <td>
                    {{$do->servicio}}
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <br>
    <table class="conclusion">
        <thead>
            <tr>
                <td><span class="bolded">CONCLUSIÓN DEL DIAGNÓSTICO: </span> Realizada la revision técnica del vehiculo <span class="bolded">{{$DiagnosticoAreaT->clase}} {{$DiagnosticoAreaT->marca}} {{$DiagnosticoAreaT->tipo_vehiculo}}</span>,
                    con placa de circulacion <span class="bolded">{{$DiagnosticoAreaT->placa}}</span> en taller de Maestranza de la Gobernación se remite el presente diagnóstico para {{$DiagnosticoAreaT->conclusion}}</td>
            </tr>
        </thead>
    </table>
    @if($DiagnosticoAreaT->tipo_taller == 2)
    <h4><strong><ins>NOTA:</ins></strong> Taller Externo</h4>
    @elseif ($DiagnosticoAreaT->tipo_taller == 1)
    <h4><strong><ins>NOTA: </ins></strong> Para Su Compra</h4>
    @endif
    <footer>

        <div style="margin-top: 20px">
            <div style="float:left">
                <font style="vertical-align: inherit">
                    <font style="vertical-align: inherit">{{$DiagnosticoAreaT->conductor}}</font>
                    <br>
                    
                <font style="vertical-align: inherit"><b>RESPONSABLE VEHÍCULO</b></font>
                </font>
            </div>

            <div style="float:right">
                <font style="vertical-align: inherit">
                    <font style="vertical-align: inherit">{{Auth::user()->name}}</font>
                    <br>
                    
                    <font style="vertical-align: inherit"><b>ENCARGADO DE TRANSPORTE</b></font>
                </font>
            </div>
        </div>
    </footer>
</body>

</html>
<style>
    h1 {
        text-align: center;
    }

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
        border-collapse: collapse;
    }

    .tablaEncabezado th {
        border: 1px solid;
    }

    .nro {
        text-align: left;
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

    .logo {
        width: 150px;
        height: 100px;
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
        padding: 0;
    }

    .tableDatos {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid;
    }

    .bolded {
        font-weight: bold;
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

    .cant {
        text-align: center;
    }

    .tableItem tfoot {
        border: 1px solid;
    }

    .contImg {
        height: 100px;
    }

    .conclusion {
        width: 100%;
        border-collapse: collapse;
    }
</style>