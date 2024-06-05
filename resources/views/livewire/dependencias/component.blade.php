<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">
                            Agregar
                        </a>
                    </li>
                </ul>

            </div>
            @include('common.searchbox')
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" >
                            <tr>
                                <th class="table-th text-while">
                                    ID
                                </th>
                                <th class="table-th text-while">
                                    DEPENDENCIA
                                </th>
                                <th class="table-th text-while">
                                    ACCTIONS
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Dependencias as $d )
                            <tr>
                                <td>
                                    <h6>{{$d->id}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{$d->nombre}}</h6>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" 
                                    wire:click="Edit({{$d->id}})"
                                    class="btn btn-dark mtmoble" title="Editar Registro">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                    @can('vista_eliminar')
                                    <a href="javascript:void(0)"
                                        onclick="Confirm('{{$d->id}}')"
                                        class="btn btn-dark" title="Eliminar Registro">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$Dependencias->links()}}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.dependencias.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        //evento ocultar la ventana modal y notificar
        window.livewire.on('dependencia-added', Msg => {
            $('#theModal').modal('hide')
        })
        //evento ocultar la ventana modal y notificar
        window.livewire.on('dependencia-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        //evento  notificar
        window.livewire.on('dependencia-deleted', Msg => {
            noty(Msg)
        })
        //evento notificar
        window.livewire.on('dependencia-exists', Msg => {
            noty(Msg)
        })

        //evento notificar
        window.livewire.on('dependencia-error', Msg => {
            noty(Msg)
        })

        //evento ocultar la ventana modal 
        window.livewire.on('hide-modal', Msg => {
            $('#theModal').modal('hide')
        })

        //evento mostrar
        window.livewire.on('show-modal', msg =>{
            $('#theModal').modal('show')
        });
        //cerrar
        window.livewire.on('dependencia-close', Msg =>{
            $('#theModal').modal('hide')
            noty(Msg)
        });
    });
    //confimar eliminar
    function Confirm(id)
    {   
        
        swal({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result){
            if(result.value){
                window.livewire.emit('deleteRow', id)
                swal.close()
            }
        })
    }
</script>