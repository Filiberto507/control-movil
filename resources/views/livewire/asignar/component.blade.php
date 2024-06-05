<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} </b>
                </h4>
                     
            </div>

            <div class="widget-content">

                <div class="form-inline">
                    <div class="form-group mr-5">
                        <select wire:model="role" class="form-control">
                            <option value="Elegir" selected>== Selecciona el Role ==</option>
                            @foreach ($roles as $role)

                                <option value="{{$role->id}}" >{{$role->name}} </option>
                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mr-5">
                        @if($namerol != 'Elegir')
                        <select wire:model="rolesTD" class="form-control">
                            <option value="Todos" selected>== Selecciona Alunga Opcion ==</option>
                            <option value="Todos" selected>== Selecciona Todos los permisos ==</option>
                                
                                <option value="Asignados" >== Permisos del {{$namerol}} ==</option>
                                
                        </select>
                        @endif

                    </div>
                    <button wire:click.prevent="SyncAll()" type="button" class="btn btn-dark mbmobile inblock mr-5">
                        Sincronizar Todos
                    </button>

                    <button wire:click.prevent="RemoveAll()" type="button" class="btn btn-dark mbmobile mr-5">
                        Revocar Todos
                    </button>
                </div>
                @include('common.searchbox')
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table striped mt-1">
                                <thead class="text-white" style="background:#3b3f5c;">
                                    <tr>
                                        <th class="table-th text-white text-center">
                                            ID
                                        </th>
                                        <th class="table-th text-white text-center">
                                            PERMISO
                                        </th>
                                        <th class="table-th text-white text-center">
                                            ROLES CON EL PERMISO
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permisos as $permiso)
                                    <tr>
                                        <!-- Si se da click a mostrar permisos del empleado se entrara a este if -->
                                        @if(($permiso->checked==1 && $mostrarTR=='Asignados')|| $namerol=='Elegir')
                                        <td>
                                            <h6 class="text-center">{{$permiso->id}}</h6>
                                        </td>

                                        <td class="">
                                            
                                            <div class="n-check" style="justify-content: center">
                                                <!--
                                                <label class="new-control new-checkbox checkbox-primary">
                                                    <input type="checkbox" wire:change="SyncPermiso($('#p' + {{ $permiso->id }} ).is(':checked'), '{{ $permiso->name }}' )"
                                                    id="p{{ $permiso->id }}"
                                                    value="{{ $permiso->id }}"
                                                    class="new-control-input"
                                                    {{ $permiso->checked == 1 ? 'checked': '' }}
                                                    >
                                                    <span class="new-control-indicator"></span>
                                                    <h6> {{ $permiso->name }} </h6>
                                                </label>
                                            -->
                                            
                                                
                                            </div>
                                       

                                            <div class="form-check form-switch" style="font-size: 20px;text-align: center;">
                                                <input class="form-check-input " type="checkbox" wire:change="SyncPermiso($('#p' + {{ $permiso->id }} ).is(':checked'), '{{ $permiso->name }}' )"
                                                id="p{{ $permiso->id }}"
                                                value="{{ $permiso->id }}"
                                                class="new-control-input"
                                                {{ $permiso->checked == 1 ? 'checked': '' }}
                                                >
                                                <label class="form-check-label" for="flexSwitchCheckDefault"><h6 > {{ $permiso->name }} </h6></label>
                                              </div>
                                        </td>

                                        <td class="text-center">
                                            <h6>{{ $permiso->Total }}</h6>
                                        </td>
                                        @elseif($mostrarTR=='Todos' )
                                        <td>
                                            <h6 class="text-center">{{$permiso->id}}</h6>
                                        </td>

                                        <td class="text-center">
                                            <!-- 
                                            <div class="n-check">
                                                
                                                <label class="new-control new-checkbox checkbox-primary">
                                                    <input type="checkbox" wire:change="SyncPermiso($('#p' + {{ $permiso->id }} ).is(':checked'), '{{ $permiso->name }}' )"
                                                    id="p{{ $permiso->id }}"
                                                    value="{{ $permiso->id }}"
                                                    class="new-control-input"
                                                    {{ $permiso->checked == 1 ? 'checked': '' }}
                                                    >
                                                    <span class="new-control-indicator"></span>
                                                    <h6> {{ $permiso->name }} </h6>
                                                </label>
                                               
                                            </div>
                                        -->
                                        <div class="form-check form-switch" style="font-size: 20px;text-align: center;">
                                            <input class="form-check-input" type="checkbox" wire:change="SyncPermiso($('#p' + {{ $permiso->id }} ).is(':checked'), '{{ $permiso->name }}' )"
                                            id="p{{ $permiso->id }}"
                                            value="{{ $permiso->id }}"
                                            class="new-control-input"
                                            {{ $permiso->checked == 1 ? 'checked': '' }}
                                            >
                                            <label class="form-check-label" for="flexSwitchCheckDefault"><h6 > {{ $permiso->name }} </h6></label>
                                          </div>
                                        </td>

                                        <td class="text-center">
                                            <h6>{{ $permiso->Total }}</h6>
                                        </td>
                                        
                                        @endif
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            {{ $permisos->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    include(form)
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('sync-error', Msg =>{
            noty(Msg)
        })
        
        //evento de permiso
        window.livewire.on('permi', Msg =>{
            noty(Msg)
        })
        
        //
        window.livewire.on('syncall', Msg =>{
            noty(Msg)
        })
        
        //evento de remover
        window.livewire.on('removeall', Msg =>{
            noty(Msg)
        })
        
    });

    function Revocar()
    {   
        
        swal({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS Revocar Todos los Permisos',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result){
            if(result.value){
                window.livewire.emit('revokeall')
                swal.close()
            }
        })
    }
</script>