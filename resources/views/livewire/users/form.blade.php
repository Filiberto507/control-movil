@include('common.modalHead')
<style>
    .select2-fix {
    position: relative; /* o position: absolute; */
    z-index: 9999;
}

</style>
<div class="row ">

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Nombre *</label>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: pedro pascal">
            @error('name') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Nombre Usuario *</label>
            <input type="text" wire:model.lazy="username" class="form-control" placeholder="ej: pedrop">
            @error('username') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Telefono *</label>
            <input type="text" wire:model.lazy="phone" class="form-control" placeholder="ej: 852 145 254" maxlength="10">
            @error('phone') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Email *</label>
            <input type="text" wire:model.lazy="email" class="form-control" placeholder="ej: pedropa@gmail.com">
            @error('email') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Contraseña *</label>
            <input type="password" wire:model.lazy="password" class="form-control">
            @error('password') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Estado *</label>
            <select wire:model.lazy="status" class="form-control">
                <option value="Elegir" selected> Elegir </option>
                <option value="ACTIVE" selected> Activo </option>
                <option value="LOCKED" selected> Bloqueado </option>
            </select>
            @error('status') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Asignar Role *</label>
            <select wire:model.lazy="profile" class="form-control" id="select2-dropdown" >
                <option value="Elegir" selected> Elegir </option>
                @foreach($roles as $role)
                <option value="{{$role->name}}" selected> {{$role->name}} </option>
                @endforeach
            </select>
            @error('profile') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>



</div>




@include('common.modalFooter')