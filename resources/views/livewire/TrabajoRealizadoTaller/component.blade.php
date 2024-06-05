<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>

                <div class="input-group mb-4">
                    <div class="col-sm-8" wire:ignore>
                        <label class="text-center">Asignar Vehiculo</label>
                        <select class="form-control basic" wire:model="vehiculoselectedName" id="select2-dropdown">
                            <option value="Elegir" selected>Elegir</option>
                            @foreach ($vehiculodatos as $ve)
                            <option value="{{ $ve->id }}"> {{ $ve->id }} | {{ $ve->placa }} | {{ $ve->conductor }}  </option>
                            @endforeach
                        </select>
                    </div>

                    @if($vehiculoselectedName != "Elegir")
                    <div class="input-group-append" style="margin-left: 60px; margin-top:25px; padding-top: 10px;">
                        <button class="btn btn-dark" wire:click="showDatos" data-toggle="modal" data-target="#theModal" type="button">Agregar</button>
                    </div>
                    @else
                    <div class="input-group-append" style="margin-left: 60px; margin-top:25px; padding-top: 10px;">
                        <button class="btn btn-dark" disabled wire:click="showDatos" data-toggle="modal" data-target="#theModal" type="button">Agregar</button>
                    </div>
                    @endif
                </div>





            </div>
            @include('common.searchbox')
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white">
                            <tr>
                                <th class="table-th text-while">
                                    Nº
                                </th>
                                <th class="table-th text-while text-center">
                                    VEHICULO
                                </th>

                                <th class="table-th text-while text-center">
                                    RESPONSABLE
                                </th>
                                <th class="table-th text-while text-center">
                                    DEPENDENCIA
                                </th>
                                <th class="table-th text-while text-center">
                                    FECHA
                                </th>

                                <th class="table-th text-while">
                                    ACCTIONS
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trabajor as $tall )
                            <tr>
                                <td>
                                    <h6>{{$tall->numero_trabajo}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{$tall->vehiculo}} - {{$tall->placa}}</h6>
                                </td>

                                <td class="text-center">
                                    <h6>{{$tall->responsable}}</h6>
                                </td>

                                <td class="text-center">
                                    <h6>{{$tall->dependencia}}</h6>
                                </td>

                                <td class="text-center">
                                    <h6>{{$tall->created_at}}</h6>
                                </td>

                                <td class="text-center">
                                    <a href="javascript:void(0)" wire:click="Edit({{$tall->id}})" class="btn btn-dark mtmoble" title="Editar Registro">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                    @can('vista_eliminar')
                                    <a href="javascript:void(0)" onclick="Confirm('{{$tall->id}}')" class="btn btn-dark" title="Eliminar Registro">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </a>
                                    @endcan
                                    <a href="{{ url('reportrabajo/pdf' . '/' . $tall->id) }}" class="btn btn-danger" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer">
                                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                            <rect x="6" y="14" width="12" height="8"></rect>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$trabajor->links()}}
                </div>
            </div>


        </div>
    </div>
    @include('livewire.TrabajoRealizadoTaller.form')
</div>

<script>
     function openFlatpickr() {
        // Abre el selector de fechas al hacer clic en el input.
        flatpickr("#basicFlatpickr", {
            enableTime: false,
            dateFormat: 'Y-m-d',
            // Otras opciones de configuración de flatpickr...
        });
    }
    document.addEventListener('DOMContentLoaded', function() {

        //esta variable es para el modal 
        var isModalOpen = false;
        //     document.getElementById('miSelect').addEventListener('change', function(event) {
        //     Livewire.emit('vehiculoselectedId', event.target.value);
        // });

        //idselect y name
        //$('#select2-dropdown').select2() //inicializador
        //capturamos values when change event

        $('#select2-dropdown').on('change', function(e) {
            console.log($('#select2-dropdown option:selected').text());
            var pId = $('#select2-dropdown').select2("val") // get vehiculo id
            var pName = $('#select2-dropdown option:selected').text() // get name vehiculo
            console.log(pId, pName);

            @this.set('vehiculoselectedId', pId) // set vehiculo od selected
            @this.set('vehiculoselectedName', pName)
        });


        

        //evento ocultar la ventana modal y notificar
        window.livewire.on('trabajo-ok', Msg => {
            //llamar a la funcion del backend
            noty(Msg)
        })
        //evento ocultar la ventana modal y notificar
        window.livewire.on('trabajo-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })

        //crear trabajo
        window.livewire.on('trabajo-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
            location.reload()
        })

        //evento  notificar
        window.livewire.on('trabajo-deleted', Msg => {
            noty(Msg)
            location.reload()
        })
        //evento notificar
        window.livewire.on('role-exists', Msg => {
            noty(Msg)
        })

        //evento notificar
        window.livewire.on('trabajo-error', Msg => {
            noty(Msg)
        })

        //evento ocultar la ventana modal 
        window.livewire.on('hide-modal', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })

        //evento mostrar
        window.livewire.on('show-modal', Msg => {
            isModalOpen = true
            $('#theModal').modal('show')
            noty(Msg)

        });
        //cerrar
        window.livewire.on('trabajos-close', Msg => {
            $('#theModal').modal('hide')
            isModalOpen = false
            $('#select2-dropdown').val('Elegir').trigger('change');
            noty(Msg)
        });

        //limpiar bug de saltado
        var modal = document.getElementById('modal');

        // Capturar el evento de clic fuera del modal
       document.addEventListener('click', function(event) {
            //console.log(isModalOpen);
            // Verificar si el clic ocurrió fuera del modal
            // Verificar si el clic ocurrió en el input dentro del modal
            if (isModalOpen == true && !modal.contains(event.target && event.target.tagName != 'INPUT')) {
                // Llamamos a la funcion limpiar para que se cierre correctamente
                limpiar();
                isModalOpen = false;
            }
        });

    });

    //resetui
    function limpiar() {
        console.log("hola")
        window.livewire.emit('resetUI')

    }

    //confimar eliminar
    function Confirm(id) {

        swal({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('destroy', id)
                swal.close()
            }
        })
    };



    // document.addEventListener('livewire:load', function () {
    //     $('#select2-dropdown').on('change', function (e) {
    //         console.log($('#select2-dropdown option:selected').text());
    //         Livewire.emit('optionSelected', e.target.value);
    //     });
    // });

    //
</script>