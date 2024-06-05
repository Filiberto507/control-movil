@include('common.modalHead')

<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Fecha</label>
            <input id="basicFlatpickr" disabled wire:model.lazy="fecha" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Seleccione la fecha.." onclick="openFlatpickr()">
            @error('fecha') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>

    <div class="col-sm-3 mt2">
        <div class="form-group">
            <label>Salida</label>
            <input type="time" disabled wire:model.lazy="hora_salida" class="form-control" />
        </div>
    </div>
    <div class="col-sm-3 mt2">
        <div class="form-group">
            <label>Retorno</label>
            <input type="time" disabled wire:model.lazy="hora_retorno" class="form-control" />
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
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

    <div class="col-sm-12 col-md-6">
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


    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Asignar Vehiculo</label>
            <select wire:model.lazy="vehiculos_id" disabled class="form-control" id="select2-dropdown">
                <option value="Elegir" selected> Elegir </option>
                @foreach($vehiculodatos as $v)
                <option value="{{$v->id}}" selected> {{$v->placa}} | {{$v->marca}}</option>
                @endforeach
            </select>
            @error('vehiculos_id') <span class="text-danger er">{{ $message}} </span>

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

    <div class="col-sm-3 mt2">
        <div class="form-group">
            <label>Km salida: *</label>
            <input type="number" id="kilometraje_salida" wire:model.lazy="kilometraje_salida" class="form-control" placeholder="Kilometraje" maxlength="255">
            @error('kilometraje_salida') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>
    <div class="col-sm-3 mt2">
        <div class="form-group">
            <label>Km retorno: *</label>
            <input type="number" id="kilometraje_regreso" wire:model.lazy="kilometraje_regreso" class="form-control" placeholder="Kilometraje" maxlength="255">
            @error('kilometraje_regreso') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>

    <div class="col-sm-3 mt2">
        <div class="form-group">
            <label>Combustible: *</label>
            <input type="number" id="combustible" wire:model.lazy="combustible" class="form-control" placeholder="combustible" maxlength="255">
            @error('combustible') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>

    <div class="col-sm-6 mt2">
        <div class="form-group">
            <label>tipo actividad: *</label>
            <input type="text" id="tipo_actividad" wire:model.lazy="tipo_actividad" class="form-control" placeholder="actividad" maxlength="255">
            @error('tipo_actividad') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>
</div>



<br>




</div>

@include('common.modalFooter')
</div>
</div>