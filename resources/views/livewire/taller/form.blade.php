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

                    <div class="col-sm-4 mt2">
                        <div class="form-group">
                            <label>Entrada</label>
                            <input type="time" disabled wire:model.lazy="ingreso" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-4 mt2">
                        <div class="form-group">
                            <label>Salida</label>
                            <input type="time" disabled wire:model.lazy="salida" class="form-control" />
                        </div>
                    </div>

                    <div class="col-sm-6 mt-2">
                        <h6>Fecha Entrada</h6>
                        <div class="form-group">
                            <label for="fecha_ingreso">Fecha de Ingreso</label>
                            <input id="fecha_ingreso" disabled wire:model.lazy="fecha_ingreso" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Seleccione la fecha de ingreso.." onclick="openFlatpickr('fecha_ingreso')">
                        </div>
                    </div>

                    <div class="col-sm-6 mt-2">
                        <h6>Fecha Salida</h6>
                        <div class="form-group">
                            <label for="fecha_salida">Fecha de Salida</label>
                            <input id="fecha_salida" disabled wire:model.lazy="fecha_salida" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Seleccione la fecha de salida.." onclick="openFlatpickr('fecha_salida')">
                        </div>
                    </div>
                        <!-- <div class="col-sm-12 mt2">
                        
                        <input id="appt-time" type="time" name="appt-time" value="13:30" />
                    </div> -->



                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Asignar Conductor *</label>
                                <select wire:model.lazy="conductorname" class="form-control">
                                    <option value="Elegir" selected> Elegir </option>
                                    @foreach($conductor as $role)
                                    <option value="{{$role->name}}" selected> {{$role->name}} </option>
                                    @endforeach
                                </select>
                                @error('conductorname') <span class="text-danger er">{{ $message}} </span>

                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-3">
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

                        <div class="col-sm-4 ">
                            <div class="form-group">
                                <label>COLOR</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <input type="text" disabled id="color" wire:model.lazy="color" class="form-control" placeholder="color" maxlength="255">
                                </div>
                                @error('color')
                                <span class="text-danger er"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Asignar Dependencia *</label>
                                <select wire:model.lazy="dependencia" class="form-control">
                                    <option value="Elegir" selected> Elegir </option>
                                    @foreach($dependencias as $de)
                                    <option value="{{$de->nombre}}" selected> {{$de->nombre}} </option>
                                    @endforeach
                                </select>
                                @error('dependencia') <span class="text-danger er">{{ $message}} </span>

                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-3 ">
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
                                    <input type="text" id="placa" wire:model.lazy="placa" class="form-control" placeholder="Placa" maxlength="255" disabled>
                                </div>
                                @error('placa')
                                <span class="text-danger er"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-3 ">
                            <div class="form-group">
                                <label>KILOMETRAJE *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <input type="text" id="kilometraje" wire:model.lazy="kilometraje" class="form-control" placeholder="Kilometraje" maxlength="255">
                                </div>
                                @error('kilometraje')
                                <span class="text-danger er"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12">
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
                        <br>

                        @foreach($acctaller as $tall)
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <input wire:model="check" value="{{$tall->id}}, {{$tall->name}}" class=" miCheckbox form-check-input" type="checkbox" style="width:20px; height:20px;" id="{{$tall->id}}">

                                    <label class="form-check-label" for="gridCheck">
                                        {{$tall->name}}
                                    </label>

                                </div>
                            </div>
                        </div>
                        @endforeach




                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table class="table  table-bordered table-hover mt-1">
                                <thead>
                                    <tr>
                                        <th>IZQUIERDO</th>
                                        <th>CENTRO</th>
                                        <th>DERECHO</th>
                                        <th>PARACHOQUES</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>
                                        <td><img class="img-go" src="assets/img/iz-1.JPG" alt="Imagen del vehículo" width="150px"></td>
                                        <td><img class="img-go" src="assets/img/cen-1.JPG" alt="Imagen del vehículo" width="150px"></td>
                                        <td><img class="img-go" src="assets/img/der-1.JPG" alt="Imagen del vehículo" width="150px"></td>
                                        <td><img class="img-go" src="assets/img/par-1.JPG" alt="Imagen del vehículo" width="150px"></td>
                                    </tr>

                                    <tr>

                                        <td><textarea placeholder="Descripcion" wire:model="estadovehiculo.{{ 0 }}.descripcion" name="" id="" rows="3"></textarea></td>
                                        <td><textarea placeholder="Descripcion" wire:model="estadovehiculo.{{ 1 }}.descripcion" name="" id="" rows="3"></textarea></td>
                                        <td><textarea placeholder="Descripcion" wire:model="estadovehiculo.{{ 2 }}.descripcion" name="" id="" rows="3"></textarea></td>
                                        <td><textarea placeholder="Descripcion" wire:model="estadovehiculo.{{ 3 }}.descripcion" name="" id="" rows="3"></textarea></td>
                                    </tr>

                                    <tr>
                                        <td><img class="img-go" src="assets/img/iz-2.JPG" alt="Imagen del vehículo" width="150px"></td>
                                        <td><img class="img-go" src="assets/img/cen-2.JPG" alt="Imagen del vehículo" width="150px"></td>
                                        <td><img class="img-go" src="assets/img/der-2.JPG" alt="Imagen del vehículo" width="150px"></td>
                                        <td><img class="img-go" src="assets/img/par-2.JPG" alt="Imagen del vehículo" width="150px"></td>
                                    </tr>

                                    <tr>
                                        <td><textarea placeholder="Descripcion" wire:model="estadovehiculo.{{ 4 }}.descripcion" name="" id="" rows="3"></textarea></td>
                                        <td><textarea placeholder="Descripcion" wire:model="estadovehiculo.{{ 5 }}.descripcion" name="" id="" rows="3"></textarea></td>
                                        <td><textarea placeholder="Descripcion" wire:model="estadovehiculo.{{ 6 }}.descripcion" name="" id="" rows="3"></textarea></td>
                                        <td><textarea placeholder="Descripcion" wire:model="estadovehiculo.{{ 7 }}.descripcion" name="" id="" rows="3"></textarea></td>
                                    </tr>

                                    <tr>
                                        <td><img class="img-go" src="assets/img/iz-3.JPG" alt="Imagen del vehículo" width="150px"></td>
                                        <td><img class="img-go" src="assets/img/cen-3.JPG" alt="Imagen del vehículo" width="150px"></td>
                                        <td><img class="img-go" src="assets/img/der-3.JPG" alt="Imagen del vehículo" width="150px"></td>
                                    </tr>

                                    <tr>
                                        <td><textarea placeholder="Descripcion" wire:model="estadovehiculo.{{ 8 }}.descripcion" name="" id="" rows="3"></textarea></td>
                                        <td><textarea placeholder="Descripcion" wire:model="estadovehiculo.{{ 9 }}.descripcion" name="" id="" rows="3"></textarea></td>
                                        <td><textarea placeholder="Descripcion" wire:model="estadovehiculo.{{ 10 }}.descripcion" name="" id="" rows="3"></textarea></td>
                                    </tr>



                                </tbody>
                            </table>
                        </div>
                    </div>



                    <div class="col-sm-12 mt-2">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Orden Trabajo *</label>
                            <textarea class="form-control" wire:model.lazy="ordentrabajo" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        @error('ordentrabajo') <span class="text-danger er">{{ $message}} </span>

                        @enderror
                    </div>

                    <div>
                        <div class="modal-footer">
                            <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info" data-desmiss="modal">
                                CERRAR
                            </button>


                            @if($selected_id < 1) <button type="button" wire:click.prevent="create_taller()" class="btn btn-dark close-modal">
                                GUARDAR
                                </button>
                                @else
                                <button type="button" wire:click.prevent="UpdateTaller()" class="btn btn-dark close-modal">
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