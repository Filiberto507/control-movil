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

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Asignar Dependencia *</label>
            <select wire:model.lazy="dependencia" class="form-control">
                <option value="Elegir" selected> Elegir </option>
                @foreach($dependenciant as $de)
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
            <select wire:model.lazy="conductor" class="form-control">
                <option value="Elegir" selected> Elegir </option>
                @foreach($conductoresnt as $role)
                <option value="{{$role->name}}" selected> {{$role->name}} </option>
                @endforeach
            </select>
            @error('conductor') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>


    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Asignar Vehiculo</label>
            <select wire:model.lazy="vehiculos_id" disabled class="form-control" id="select2-dropdown">
                <option value="Elegir" selected> Elegir </option>
                @foreach($Vehiculos as $v)
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
</div>
<table class="table  table-bordered table-hover mt-1">
    <thead>
        <tr>
            <th>Cantidad</th>
            <th>Descripción</th>
            <th>



            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($filas as $index => $fila)
        <tr>
            <td><input type="number" class="form-control" wire:model="filas.{{ $index }}.items" /></td>
            <td><textarea class="form-control" wire:model="filas.{{ $index }}.descriptions" name="" id="" col="100" rows="2"></textarea></td>
            <td><button class="btn btn-danger" wire:click="eliminarFila({{ $index }})">Eliminar</button></td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="col-sm-12 col-md-8 text-center">
    <button class="btn btn-primary" wire:click="agregarFila({{1}})">
        <div class="base-icons">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </div>
    </button>
</div>


<br>


<div class="col-sm-12 col-md-12">
    <div class="form-group">
        <label>Seleccione el Tipo *</label>
        <select wire:model.lazy="tipo_taller" class="form-control">
            <option value="Elegir" selected> Elegir </option>
            <option value="1" selected> Taller Interno </option>
            <option value="2" selected> Taller Externo </option>
        </select>
        @error('tipo_taller') <span class="text-danger er">{{ $message}} </span>

        @enderror
    </div>
</div>
<div class="col-sm-12 col-md-12">
    <div class="form-group">
        <label>Observaciones: *</label>
        <textarea wire:model.lazy="observacion" class="form-control" name="" id="" cols="100" rows="3" placeholder="...">hola</textarea>
        @error('observacion') <span class="text-danger er">{{ $message}} </span>

        @enderror
    </div>
</div>



<!-- tabla de solo uno -->

<!-- <table class="table  table-bordered table-hover mt-1">
        <thead>
          <tr>
            <th>Numero de item</th>
            <th>Descripcion</th>
            <th>
              <button wire:click="agregar">
                Agregar
              </button>
            </th>
          </tr>
        </thead>

        <tbody>
            @foreach($filas as $index => $fila)
              <tr>
                <td><input type="text" wire:model="filas.{{ $index}}.items"></td>
                <td><input type="text" wire:model="filas.{{ $index}}.descripcion"></td>
              </tr>
            @endforeach
        </tbody>
    </table> -->


<!-- <button wire:click="agregarFila">Agregar fila</button> -->




</div>

@include('common.modalFooter')
</div>
</div>