@include('common.modalHead')

<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Nombre *</label>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: Crismar Rodrigo">
            @error('name') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Ci. *</label>
            <input type="number" wire:model.lazy="ci" class="form-control" placeholder="ej: 70985745" maxlength="15">
            @error('ci') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Telefono *</label>
            <input type="number" wire:model.lazy="telefono" class="form-control" placeholder="ej: 66985745" maxlength="10">
            @error('telefono') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Estado *</label>
            <select wire:model.lazy="status" class="form-control">
                <option value="Elegir" selected> Elegir </option>
                <option value="ACTIVE" selected> ACTIVO </option>
                <option value="LOCKED" selected> BLOQUEADO </option>
            </select>
            @error('status') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>

   




</div>

@include('common.modalFooter')