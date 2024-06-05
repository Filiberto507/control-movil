<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
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
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">

                            <label for="maskxd">Placa *</label>
                            <input wire:model.lazy="placa" type="text" class="form-control" placeholder="ej: 2344-XDY">
                            @error('placa') <span class="text-danger er">{{ $message}} </span>

                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Clase *</label>
                            <input type="text" wire:model.lazy="clase" class="form-control" placeholder="ej: vagoneta" maxlength="10">
                            @error('clase') <span class="text-danger er">{{ $message}} </span>

                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-8">
                        <div class="form-group">
                            <label>Marca *</label>
                            <input type="text" wire:model.lazy="marca" class="form-control" placeholder="ej: nissan" maxlength="10">
                            @error('marca') <span class="text-danger er">{{ $message}} </span>

                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Tipo de vehiculo *</label>
                            <input type="text" wire:model.lazy="tipo_vehiculo" class="form-control" placeholder="ej: x-trail" maxlength="10">
                            @error('tipo_vehiculo') <span class="text-danger er">{{ $message}} </span>

                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Color</label>
                            <input type="text" wire:model.lazy="color" class="form-control" placeholder="ej: plomo" maxlength="10">
                            @error('color') <span class="text-danger er">{{ $message}} </span>

                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label>Combustible y capacidad *</label>
                            <input type="text" wire:model.lazy="combustible_capacidad" class="form-control" placeholder="ej: 65 litros" maxlength="10">
                            @error('combustible_capacidad') <span class="text-danger er">{{ $message}} </span>

                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Numero de motor *</label>
                            <input type="text" wire:model.lazy="motor" class="form-control" placeholder="ej: 52WBC10338" maxlength="20">
                            @error('motor') <span class="text-danger er">{{ $message}} </span>

                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Numero de chasis *</label>
                            <input type="text" wire:model.lazy="chasis" class="form-control" placeholder="ej: 1HGBH41JXMN109186" maxlength="20">
                            @error('chasis') <span class="text-danger er">{{ $message}} </span>

                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Modelo *</label>
                            <input type="text" wire:model.lazy="modelo" class="form-control" placeholder="ej: 1999" maxlength="10">
                            @error('modelo') <span class="text-danger er">{{ $message}} </span>

                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <div class="form-group">
                            <label>Cilindrada *</label>
                            <input type="text" wire:model.lazy="cilindrada" class="form-control" placeholder="ej: 2.500 CC" maxlength="15">
                            @error('cilindrada') <span class="text-danger er">{{ $message}} </span>

                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Estado *</label>
                            <select wire:model.lazy="estado" class="form-control" id="select2-dropdown">
                                <option value="Elegir" selected> Elegir </option>
                                <option value="Bueno" selected> Bueno </option>
                                <option value="Regular" selected> Regular </option>
                                <option value="Malo" selected> Malo </option>
                            </select>
                            @error('estado') <span class="text-danger er">{{ $message}} </span>

                            @enderror
                        </div>
                    </div>



                </div>
            </div>

            <div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info" data-desmiss="modal">
                        CERRAR
                    </button>

                    @if($selected_id < 1) <button type="button" wire:click.prevent="Store()" class="btn btn-dark close-modal">
                        GUARDAR
                        </button>
                        @else
                        <button type="button" wire:click.prevent="Update()" class="btn btn-dark close-modal">
                            ACTUALIZAR
                        </button>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>