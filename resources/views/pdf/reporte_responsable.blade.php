<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
    <link rel="stylesheet" href="{{ asset('assets/css/Report_responsable.css') }}">
</head>

<body>
    <div id="page_pdf">

        <table>
            <tr>
                <td class="">
                    <img class="img-bo" src="assets/img/Bolivia.png" alt="Imagen bolivia">
                </td>
                <td class="">
                    <img class="img-co" src="assets/img/cochabamba.jpg" alt="Imagen del cochabamba">
                </td>
                <td class="">
                    <img class="img-go" src="assets/img/img-go.png" alt="Imagen del gobernacion">
                </td>
            </tr>
        </table>
        <h2>DETALLE DIAGNOSTICO DEL AREA DE TRANSPORTES</h2>

        <table class="datos">
            <tr>
                <td class="columna1">

                    PLACA: {{$vehiculodato->placa}}
                    @php
                    //dd($taller->clase, $vehiculo, $taller->tipo_vehiculo);
                    @endphp
                </td>
                <td class="columna2">
                    COLOR: {{$vehiculodato->color}}

                </td>
            </tr>
            <tr>
                <td>
                    TIPO DE VEHICULO: {{$vehiculodato->clase}} {{$vehiculodato->marca}} {{$vehiculodato->tipo_vehiculo}}
                </td>
                <td>
                    CILINDRADA:{{$vehiculodato->cilindrada}}
                </td>
            </tr>

            <tr>
                <td>
                    IMPRESION EN FECHA : {{$fecha}}
                </td>
                <td>
                    CHASIS : {{$vehiculodato->chasis}}
                </td>
            </tr>

           
        </table>
        <!--<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3">Cliente</span>
					<table class="datos_cliente">
						<tr>
							<td><label>Nit:</label><p>54895468</p></td>
							<td><label>Teléfono:</label> <p>7854526</p></td>
						</tr>
						<tr>
							<td><label>Nombre:</label> <p>Angel Arana Cabrera</p></td>
							<td><label>Dirección:</label> <p>Calzada Buena Vista</p></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>-->
        @if(count($data) < 1)
        
            <h3 style="text-align: center;">NO SE TIENE DATOS CON TALLER</h3>
        
        @else
            <table id="factura_detalle" width="100%">
            <thead>
                <tr>
                    <th width="5%">Nº</th>
                    <th class="textleft" width="20%">FECHA</th>
                    <th class="textleft" width="15%">Nº DIAGNOSTICO TALLER DE MAESTRANZA</th>
                    <th class="textleft" width="15%">Nº DIAGNOSTICO AREA DE TRANSPORTES</th>
                    <th class="textleft" width="15%">KILOMETRAJE</th>
                    <th class="textright" width="40%">DESCRIPCION</th>
                    <th class="textright" width="12%"> TALLER INTERNO</th>
                    <th class="textright" width="12%"> TALLER EXTERNO</th>
                    <th class="textcenter" width="50%"> CONDUCTOR</th>
                </tr>

            </thead>
            <tbody id="detalle_productos">
                @foreach($data as $index => $item)
                <tr>
                    <td align="center">{{$index+1}}</td>
                    <td align="center">{{$item->fecha_ingreso}}</td>
                    <td align="center">{{$item->diagnostico}}</td>
                    <td align="center">{{$item->diagnosticotransporte}}</td>
                    <td align="center">{{$item->kilometraje}}</td>
                    <td align="center">{{$item->observacion}}</td>
                    @if($item->tipo_taller == 1)
                    <td align="center">X</td>
                    @else
                    <td align="center"></td>
                    @endif

                    @if($item->tipo_taller == 2)
                    <td align="center">X</td>
                    @else
                    <td align="center"></td>
                    @endif
                    <td style="font-size:12px;" >{{$item->conductor}}</td>


                </tr>
                @endforeach
            </tbody>

        </table>
        
        @endif
        

        <h3 style="text-align: center;">SIN TALLER</h3>
        <table id="factura_detalle" width="100%">
            <thead>
                <tr>
                    <th width="5%">Nº</th>
                    <th class="textleft" width="20%">FECHA</th>
                    <th class="textleft" width="15%">Nº DIAGNOSTICO</th>
                    <th class="textleft" width="15%">Nº DIAGNOSTICO AREA DE TRANSPORTES</th>
                    <th class="textright" width="40%">DESCRIPCION</th>
                    <th class="textright" width="12%"> TALLER INTERNO</th>
                    <th class="textright" width="12%"> TALLER EXTERNO</th>
                    <th class="textcenter" width="50%"> CONDUCTOR</th>
                </tr>

            </thead>
            <tbody id="detalle_productos">
                @foreach($diagnosnt as $index => $item)
                <tr>
                    <td align="center">{{$index+1}}</td>
                    <td align="center">{{$item->fecha}}</td>
                    <td align="center">{{$item->numero_diagnostico}}</td>
                    <td align="center">{{$item->diagnosticotransporte}}</td>
                    <td align="center">{{$item->observacion}}</td>
                    @if($item->tipo_taller == 1)
                    <td align="center">X</td>
                    @else
                    <td align="center"></td>
                    @endif

                    @if($item->tipo_taller == 2)
                    <td align="center">X</td>
                    @else
                    <td align="center"></td>
                    @endif
                    <td style="font-size:12px;" >{{$item->conductor}}</td>


                </tr>
                @endforeach
            </tbody>

        </table>


    </div>

</body>

</html>