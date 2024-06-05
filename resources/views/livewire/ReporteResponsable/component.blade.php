<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget" style="background: #ebe6ea">
            <div class="widget-heading">
                <h4 class="card-title text-center"><b>{{$componentName}}</b></h4>
            </div>
            <div class="widget-content">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="col-sm-12" wire:ignore>
                                    <label class="text-center">Asignar Vehiculo</label>
                                    <select class="form-control basic" wire:model="vehiculoselectedName" id="select2-dropdown">
                                        <option value="Elegir" selected>Elegir</option>
                                        @foreach ($vehiculodatos as $ve)
                                        <option value="{{ $ve->id }}">{{ $ve->placa }} | {{ $ve->marca }} | {{$ve->tipo_vehiculo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Elige el tipo de reporte</h6>
                                <div class="form-group">
                                    <select wire:model="reportType" class="form-control">
                                        <option value="0">Reporte del dia</option>
                                        <option value="1">Reporte por fecha</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-12 mt-2">
                                <h6>Fecha Entrada</h6>
                                <div class="form-group">
                                    <input id="basicFlatpickr" wire:model="dateFrom" class="form-control flatpickr flatpickr-input active" type="date" placeholder="Seleccione la fecha.." >
                                </div>
                            </div>

                            <div class="col-sm-12 mt-2">
                                <h6>Fecha Salida</h6>
                                <div class="form-group">
                                    <input id="basicFlatpickr2" wire:model="dateTo" class="form-control flatpickr flatpickr-input active" type="date" placeholder="Seleccione la fecha.." >
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button wire:click="SalesByDate" class="btn btn-dark btn-block">
                                    Consultar
                                </button>
                                <a class="btn btn-dark btn-block {{(count($data) < 1 && count($diagnosnt) < 1) ? 'disabled' : ''}}" 
                                href="{{ url('report_responsable/pdf' . '/' . $vehiculoselectedId . '/' . $reportType. '/' . $dateFrom. '/' . $dateTo) }}" target="_blank">
                                    Generar PDF</a>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9">
                        <!-- TABLA -->
                        <div class="table-responsive">
                            <!-- Anterior table: table table-bordered border-primary table striped mt-1  -->
                            <table class="table table-hover mb-4">
                                <thead class="text-white" style="background:#3b3f5c;">
                                    <tr>
                                        <th class="table-th text-white text-center">
                                            Nº
                                        </th>
                                        <th class="table-th text-white text-center">
                                            FECHA
                                        </th>
                                        <th class="table-th text-white text-center">
                                            Nº DIAGNOSTICO TALLER DE MAESTRANZA
                                        </th>
                                        <th class="table-th text-white text-center">
                                            Nº DIAGNOSTICO AREA DE TRANSPORTES
                                        </th>
                                        <th class="table-th text-white text-center">
                                            KILOMETRAJE
                                        </th>
                                        <th class="table-th text-white text-center">
                                            DESCRIPCION
                                        </th>
                                        <th class="table-th text-white text-center">
                                            TALLER INTERNO
                                        </th>
                                        <th class="table-th text-white text-center">
                                            TALLER EXTERNO
                                        </th>
                                        <th class="table-th text-white text-center">
                                            CONDUCTOR
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($data) <1) <tr>
                                        <td colspan="7">
                                            <h5>Sin Resultados</h5>
                                        </td>
                                        </tr>
                                        @endif
                                        @foreach ($data as $index => $d)
                                        <tr>
                                            <td class="text-center">
                                                <h6>{{$index+1}}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{$d->fecha_ingreso}}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{$d->diagnostico}}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{$d->diagnosticotransporte}}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{$d->kilometraje}}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{$d->descripcion}}</h6>
                                            </td>
                                            @if($d->tipo_taller == 1)
                                            <td class="text-center">
                                                <h6>X</h6>
                                            </td>
                                            @else
                                            <td class="text-center">
                                                <h6></h6>
                                            </td>
                                            @endif

                                            @if($d->tipo_taller == 2)
                                            <td class="text-center">
                                                <h6>X</h6>
                                            </td>
                                            @else
                                            <td class="text-center">
                                                <h6></h6>
                                            </td>
                                            @endif

                                            <td class="text-center">
                                                <h6>{{$d->conductor}}</h6>
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var f1 = flatpickr(document.getElementById('basicFlatpickr'));
        var f2 = flatpickr(document.getElementById('basicFlatpickr2'));

        //select2
        $('#select2-dropdown').on('change', function(e) {
            console.log($('#select2-dropdown option:selected').text());
            var pId = $('#select2-dropdown').select2("val") // get vehiculo id
            var pName = $('#select2-dropdown option:selected').text() // get name vehiculo
            console.log(pId, pName);

            @this.set('vehiculoselectedId', pId) // set vehiculo od selected
            @this.set('vehiculoselectedName', pName)
        });

        //eventos
        window.livewire.on('show-modal', Msg => {
            $('#modalDetails').modal('show')
        })



    });
</script>