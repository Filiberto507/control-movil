<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="modal" value="5">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    <b>{{$componentName}}</b> | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR'}}
                </h5>
                <h6 class="text-center text-warning" wire:loading>
                    POR FAVOR ESPERE
                </h6>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-6 mt-2">
                        <h6>Fecha Entrada</h6>
                        <div class="form-group">
                            <input id="basicFlatpickr" disabled wire:model.lazy="fecha_ingreso" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Seleccione la fecha.." disabled readonly="readonly">
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                        <h6>Fecha Salida</h6>
                        <div class="form-group">

                            <input id="basicFlatpickr2" disabled wire:model.lazy="fecha_salida" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Seleccione la fecha.." disabled readonly="readonly">
                        </div>
                        @error('fecha_salida')
                        <span class="text-danger er"> {{ $message }} </span>
                        @enderror
                    </div>

                    <!-- <div class="col-sm-12 mt2">
                        
                        <input id="appt-time" type="time" name="appt-time" value="13:30" />
                    </div> -->



                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>VEHICULO</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" disabled id="vehiculo" wire:model.lazy="vehiculo" class="form-control" placeholder="Vehiculo" maxlength="255">
                            </div>
                            @error('vehiculo')
                            <span class="text-danger er"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>PLACA</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" disabled id="placa" wire:model.lazy="placa" class="form-control" placeholder="PLACA" maxlength="255">
                            </div>
                            @error('placa')
                            <span class="text-danger er"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 ">
                        <div class="form-group">
                            <label>DEPENDENCIA</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" disabled="dependencia" wire:model.lazy="dependencia" class="form-control" placeholder="DEPENDENCIA" maxlength="255">
                            </div>
                            @error('dependencia')
                            <span class="text-danger er"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ASIGNAR RESPONSABLE *</label>
                            <select wire:model.lazy="responsable" class="form-control">
                                <option value="Elegir" selected> Elegir </option>
                                @foreach($responsableu as $r)
                                <option value="{{$r->name}}" selected> {{$r->name}} </option>
                                @endforeach
                            </select>
                            @error('responsable') <span class="text-danger er">{{ $message}} </span>

                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-4 ">
                        <div class="form-group">
                            <label>KM INGRESO</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" disabled id="km_ingreso" wire:model.lazy="km_ingreso" class="form-control" placeholder="KM INGRESO" maxlength="255">
                            </div>
                            @error('km_ingreso')
                            <span class="text-danger er"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-4 ">
                        <div class="form-group">
                            <label>KM SALIDA *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" id="km_salida" wire:model.lazy="km_salida" class="form-control" placeholder="KM SALIDA" maxlength="255">
                            </div>
                            @error('km_salida')
                            <span class="text-danger er"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>



                    <label for="exampleFormControlTextarea1">TRABAJO REALIZADO (TALLER INTERNO DE MAESTRANZA) *</label>
                    @if($diagnostico_item)

                    @foreach($diagnostico_item as $di)
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-check">
                                <label class="new-control new-checkbox new-checkbox-text checkbox-primary">
                                    <input wire:model="checkdiagnostico" value="{{$di->descripcion}}" type="checkbox" class="new-control-input">
                                    <span class="new-control-indicator"></span><span class="new-chk-content">{{$di->descripcion}}</span>
                                </label>

                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    <div class="col-sm-12 mt-2">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">OBSERVACIONES *</label>
                            <textarea class="form-control" wire:model.lazy="observacion" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        @error('observacion') <span class="text-danger er">{{ $message}} </span>

                        @enderror
                    </div>

                    <div>
                        <div class="modal-footer">
                            <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info" data-desmiss="modal">
                                CERRAR
                            </button>


                            @if($selected_id < 1) <button type="button" wire:click.prevent="create_trabajo()" class="btn btn-dark close-modal">
                                GUARDAR
                                </button>
                                @else
                                <button type="button" wire:click.prevent="UpdateTrabajo()" class="btn btn-dark close-modal">
                                    ACTUALIZAR
                                </button>

                                <!-- <button onclick="mostrarValores()">Mostrar Valores</button> -->
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr(document.getElementsByClassName('flatpickr'), {
                enableTime: false,
                dateFormat: 'Y-m-d',
                locale: {
                    firstDayofWeek: 1,
                    weekdays: {
                        shorthand: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                        longhand: [
                            "Domingo",
                            "Lunes",
                            "Martes",
                            "Miércoles",
                            "Jueves",
                            "Viernes",
                            "Sábado",
                        ],
                    },
                    months: {
                        shorthand: [
                            "Ene",
                            "Feb",
                            "Mar",
                            "Abr",
                            "May",
                            "Jun",
                            "Jul",
                            "Ago",
                            "Sep",
                            "Oct",
                            "Nov",
                            "Dic",
                        ],
                        longhand: [
                            "Enero",
                            "Febrero",
                            "Marzo",
                            "Abril",
                            "Mayo",
                            "Junio",
                            "Julio",
                            "Agosto",
                            "Septiembre",
                            "Octubre",
                            "Noviembre",
                            "Diciembre",
                        ],
                    },
                }
            })

            //eventos
            window.livewire.on('show-modal', Msg => {
                $('#modalDetails').modal('show')
            })



        });

        //fuera del modal evento


        //funcion para obtener los checks
        function mostrarValores() {
            var checkboxes = document.getElementsByClassName("miCheckbox");
            var vehiculo = document.getElementById('vehiculo').value;
            var conductor = document.getElementById('conductor').value;
            var color = document.getElementById('color').value;
            var dependencia = document.getElementById('dependencia').value;
            var placa = document.getElementById('placa').value;
            var kilometraje = document.getElementById('kilometraje').value;
            var valoresSeleccionados = [];

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    valoresSeleccionados.push(checkboxes[i].value);
                    console.log(valoresSeleccionados);
                }
            }

            //console.log(vehiculo, conductor, color, dependencia, placa, kilometraje, valoresSeleccionados);
            //console.log(valoresSeleccionados);
        }
    </script>