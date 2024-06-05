<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>REPORTE TRANSPORTES</title>
    <link rel="stylesheet" href="{{ asset('assets/css/Report-pdf.css') }}">
</head>

<body>
    <table class="encabezado">
        <tr>
            <td>
            <img class="img-go" src="assets/img/cochabamba.jpg" alt="Imagen del vehículo">
            </td>
            <td>
            <h1 class="encabezado">ÁREA DE TRANSPORTES</h1>
                <h2>TALLER DE MAESTRANZA</h2>
            </td>
        </tr>
    </table>
    <table>
        <tr>

            <td class="columna2">
                <h3>Recepción de vehículo</h2>
                    <table>
                        <tr>
                            <td>Hora de entrada</td>
                            <td>{{$hora_ingreso}}</td>
                        </tr>
                        <tr>
                            <td>Hora de salida</td>
                            @if($hora_salida != null)
                            <td>{{$hora_salida}}</td>
                            @else
                            <td>En Curso</td>
                            @endif
                        </tr>
                    </table>
            </td>
            <td class="columna3">

                <table>
                    <tr>
                        <td>
                            <p class="fecha-title">Nº</h2>
                        </td>
                        <td>
                            <p class="fecha-title">Dia</h2>
                        </td>
                        <td>
                            <p class="fecha-title">Mes</h2>
                        </td>
                        <td>
                            <p class="fecha-title">Año</h2>
                        </td>

                    </tr>
                    <tr>
                        <td class="fecha-td">
                            <p>{{$tallerdatos->numero_taller}}</p>
                        </td>
                        <td class="fecha-td">
                            <p>{{substr($fecha_ingreso, 8, 2)}}</p>
                        </td>
                        <td class="fecha-td">
                            <p>{{substr($fecha_ingreso, 5, 2)}}</p>
                        </td>
                        <td class="fecha-td">
                            <p>{{substr($fecha_ingreso, 0, 4)}}</p>
                        </td>
                        <td>
                            <p class="fecha-title">ingreso</p>
                        </td>
                    </tr>

                    <tr>
                        @if($fecha_salida != null)
                        <td>
                            <p></p>
                        </td>
                        <td class="fecha-td">
                            <p>{{substr($fecha_salida, 8, 2)}}</p>
                        </td>
                        <td class="fecha-td">
                            <p>{{substr($fecha_salida, 5, 2)}}</p>
                        </td>
                        <td class="fecha-td">
                            <p>{{substr($fecha_salida, 0, 4)}}</p>
                        </td>
                        @else
                        <td></td>
                        <td>En</td>
                        <td>Curso</td>
                        <td></td>
                        @endif

                        <td>
                            <p class="fecha-title">salida</p>
                        </td>
                    </tr>
                </table>
                <!-- <div>
                    <p class="fecha-title">Número de formulario</h2>
                    <p>123</p>
                </div>
                <div>
                    <p class="fecha-title">Fecha Entrada</h2>
                    <p>Día, Mes, Año</p>
                    <p>{{$fecha_ingreso}}</p>
                </div>
                <div>
                    <p class="fecha-title">Fecha Salida</h2>
                    <p>Día, Mes, Año</p>
                    @if($fecha_salida != null)
                    <p>{{$fecha_salida}}</p>
                    @else
                    <p>En Curso</p>
                    @endif
                </div> -->
            </td>
        </tr>
    </table>

    <table class="info">

        <tr>
            <th class="info-th">Nombre:</th>
            <td class="info-td">
                <div class="text">
                    {{$nombre}}
                </div>
            </td>
            <th class="info-th">Vehiculo:</th>
            <td class="info-td">
                <div class="text">
                    {{$vehiculo}}
                </div>
            </td>
            <th class="info-th">Color:</th>
            <td class="info-td">
                <div class="text">
                    {{$color}}
                </div>
            </td>
        </tr>
        <tr>
            <th class="info-th">Stria/Dir:</th>
            <td class="info-td">
                <div class="text">
                    {{$dependencia}}
                </div>
            </td>
            <th class="info-th">Placa:</th>
            <td class="info-td">
                <div class="text">
                    {{$placa}}
                </div>
            </td>
            <th class="info-th">Kilometraje:</th>
            <td class="info-td">
                <div class="text">
                    {{$kilometraje}}
                </div>
            </td>
        </tr>

    </table>


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
                        {{$pr->name}}
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
                        {{$se->name}}
                    </label>
                </div>
                @endforeach
                <!-- Repite las siguientes líneas de código para agregar más elementos -->
            </td>
            <td class="check-column">
                @foreach($ultimos10 as $ul)
                <div class="checkbox-item">
                    <input type="checkbox" id="checkbox1" name="checkbox1" {{ $ul->checked == 1 ? 'checked': '' }}>
                    <label for="checkbox1" class="custom-checkbox-label">
                        <span class="custom-checkbox">{{ $ul->checked == 1 ? '✓' : 'X' }}</span>
                        <input type="checkbox" id="checkbox1" class="checkmark" name="checkbox1" {{ $ul->checked == 1 ? 'checked': '' }}>
                        <span class="checkmark"></span> <!-- Capa adicional para el check original -->
                        {{$ul->name}}
                    </label>
                </div>
                @endforeach
                <!-- Repite las siguientes líneas de código para agregar más elementos -->
            </td>
        </tr>
    </table>

    <h4 class="title-auto">ESTADO EXTERIOR DEL AUTO</h4>

    <table class="auto">
        <tr>
            <th class="auto-th">IZQUIERDO</th>
            <th class="auto-th-c"> CENTRO </th>
            <th class="auto-th"> DERECHO </th>
            <th class="auto-th">PARACHOQUES</th>
        </tr>
        <tr>
            <td class="auto-td-img"><img class="car-image" src="assets/img/iz-1.JPG" alt="Imagen 2"></td>
            <td class="auto-td-img"><img class="car-image" src="assets/img/cen-1.JPG" alt="Imagen 2"></td>
            <td class="auto-td-img"><img class="car-image" src="assets/img/der-1.JPG" alt="Imagen 2"></td>
            <td class="auto-td-img"><img class="car-image" src="assets/img/par-1.JPG" alt="Imagen 2"></td>
        </tr>

        <tr>
            <td class="auto-td">
                @if($datosestadovehiculo[0] == [])
                sin novedad
                @else
                {{$datosestadovehiculo[0]['descripcion']}}
                @endif
            </td>
            <!-- <td class="auto-td"><img class="car-image" src="imagen2.JPG" alt="Imagen 2"></td> -->
            <td class="auto-td">
                @if($datosestadovehiculo[1] == [])
                sin novedad
                @else
                {{$datosestadovehiculo[1]['descripcion']}}
                @endif
            </td>

            <td class="auto-td">
                @if($datosestadovehiculo[2] == [])
                sin novedad
                @else
                {{$datosestadovehiculo[2]['descripcion']}}
                @endif
            </td>

            <td class="auto-td">
                @if($datosestadovehiculo[3] == [])
                sin novedad
                @else
                {{$datosestadovehiculo[3]['descripcion']}}
                @endif
            </td>

        </tr>

        <tr>
            <td class="auto-td-img"><img class="car-image" src="assets/img/iz-2.JPG" alt="Imagen 2"></td>
            <td class="auto-td-img"><img class="car-image" src="assets/img/cen-2.JPG" alt="Imagen 2"></td>
            <td class="auto-td-img"><img class="car-image" src="assets/img/der-2.JPG" alt="Imagen 2"></td>
            <td class="auto-td-img"><img class="car-image" src="assets/img/par-2.JPG" alt="Imagen 2"></td>
        </tr>

        <tr>
            <td class="auto-td">
                @if($datosestadovehiculo[4] == [])
                sin novedad
                @else
                {{$datosestadovehiculo[4]['descripcion']}}
                @endif
            </td>
            <!-- <td class="auto-td"><img class="car-image" src="imagen2.JPG" alt="Imagen 2"></td> -->
            <td class="auto-td">
                @if($datosestadovehiculo[5] == [])
                sin novedad
                @else
                {{$datosestadovehiculo[5]['descripcion']}}
                @endif
            </td>

            <td class="auto-td">
                @if($datosestadovehiculo[6] == [])
                sin novedad
                @else
                {{$datosestadovehiculo[6]['descripcion']}}
                @endif
            </td>

            <td class="auto-td">
                @if($datosestadovehiculo[7] == [])
                sin novedad
                @else
                {{$datosestadovehiculo[7]['descripcion']}}
                @endif
            </td>

        </tr>

        <tr>
            <td class="auto-td-img"><img class="car-image" src="assets/img/iz-3.JPG" alt="Imagen 2"></td>
            <td class="auto-td-img"><img class="car-image" src="assets/img/cen-3.JPG" alt="Imagen 2"></td>
            <td class="auto-td-img"><img class="car-image" src="assets/img/der-3.JPG" alt="Imagen 2"></td>
        </tr>

        <tr>
            <td class="auto-td">
                @if($datosestadovehiculo[8] == [])
                sin novedad
                @else
                {{$datosestadovehiculo[8]['descripcion']}}
                @endif
            </td>
            <!-- <td class="auto-td"><img class="car-image" src="imagen2.JPG" alt="Imagen 2"></td> -->
            <td class="auto-td">
                @if($datosestadovehiculo[9] == [])
                sin novedad
                @else
                {{$datosestadovehiculo[9]['descripcion']}}
                @endif
            </td>

            <td class="auto-td">
                @if($datosestadovehiculo[10] == [])
                sin novedad
                @else
                {{$datosestadovehiculo[10]['descripcion']}}
                @endif
            </td>



        </tr>
    </table>

    <h4 class="title-orden">ORDEN DE TRABAJO</h4>
    <div class="container-parrafo">
        @foreach ( $separarord as $ord)
        <div class="paragraph">
            <p class="par">{{$ord}}</p>
        </div>
        @endforeach

    </div>
    @if($fecha_salida != null)
    <table class="firma">
        <tr>
            
            <th>{{$tallerdatos->responsable}}</th>
            <th>{{$nombre}}</th>
        </tr>
        <tr>
            <th>MECANICO DE MAESTRANZA</th>
            <th>CONDUCTOR DE VEHICULO SALIDA</th>
        </tr>
    </table>
    @else
    <table class="firma">
        <tr>
            <th>{{$nombre}}</th>
            <th>{{$tallerdatos->responsable}}</th>
        </tr>
        <tr>
            <th>CONDUCTOR DE VEHICULO INGRESO</th>
            <th>MECANICO DE MAESTRANZA</th>
        </tr>
    </table>
    @endif
    <!-- <div class="container">
            <span class="label">Nombre:</span>
            <div class="text">
                Aquí está tu texto.
            </div>
        </div> -->

</body>

</html>