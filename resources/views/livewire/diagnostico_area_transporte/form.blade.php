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
            <label>Dependencia</label>
            <input type="text" disabled wire:model.lazy="dependencia" class="form-control" placeholder="ej: Gabinete">
            @error('dependencia') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Conductor</label>
            <input id="Conductor" disabled type="text" wire:model.lazy="conductor" class="form-control" placeholder="ej: Crismar Rodrigo">
            @error('conductor') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>


    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Asignar Vehiculo</label>
            <select wire:model.lazy="vehiculos_id" disabled class="form-control" id="select2-dropdown">
                <option value="Elegir" selected> Elegir </option>
                @foreach($vehiculos as $v)
                <option value="{{$v->id}}" selected> {{$v->placa}} | {{$v->marca}}</option>
                @endforeach
            </select>
            @error('vehiculos_id') <span class="text-danger er">{{ $message}} </span>

            @enderror
        </div>
    </div>
</div>

<div class="col-sm-12 col-md-12">
    <div class="form-group text-center">
        <label>TIPO DE TALLER</label>
        <select disabled wire:model.lazy="tipo_taller" class="form-control text-center">
            <option value="Elegir" selected> Elegir </option>
            <option value="1" selected> Taller Interno </option>
            <option value="2" selected> Taller Externo </option>
        </select>
        @error('status') <span class="text-danger er">{{ $message}} </span>

        @enderror
    </div>
</div>

<label>Requerimiento</label>
<table class="table  table-bordered table-hover mt-1">
    <thead>
        <tr>
            <th class="col-sm-12 col-md-3">Cantidad</th>
            <th class="col-sm-12 col-md-3">Unidad</th>
            <th class="col-sm-12 col-md-6">Requerimiento</th>

            <th>



            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($requerimiento as $index => $req)
        <tr>
            <td><input type="number" class="form-control" wire:model="requerimiento.{{ $index }}.cantidad" /></td>
            <td><input type="text" class="form-control" wire:model="requerimiento.{{ $index }}.unidad" /></td>
            <td><textarea class="form-control" wire:model="requerimiento.{{ $index }}.servicio" name="" id="" col="100" rows="2"></textarea></td>
            <td><button class="btn btn-danger" wire:click="eliminarRequerimiento({{ $index }})">Eliminar</button></td>
        </tr>
        @if ($errors->has("requerimiento.{$index}.cantidad"))
    <tr>
        <td colspan="4">
            <span class="text-danger er">{{ $errors->first("requerimiento.{$index}.cantidad") }}</span>
        </td>
    </tr>
    @endif

        @endforeach
    </tbody>
</table>


<div class="col-sm-12 col-md-8 text-center">
    <button class="btn btn-primary" wire:click="agregarRequerimiento({{1}})">
        <div class="base-icons">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </div>
    </button>

    <button class="btn btn-danger" wire:click="resetRequerimientos">Eliminar Requerimientos</button>
</div>
<br>

<label>Servicio de Mano de Obra</label>
<table class="table  table-bordered table-hover mt-1">
    <thead>
        <tr>
            <th class="col-sm-12 col-md-3">Cantidad</th>
            <th class="col-sm-12 col-md-6">Servicio</th>

            <th>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($obra as $index => $ob)
        <tr>
            <td><input type="number" class="form-control" wire:model="obra.{{ $index }}.cantidad" /></td>
            <td><textarea class="form-control" wire:model="obra.{{ $index }}.servicio" name="" id="" col="100" rows="2"></textarea></td>
            <td><button class="btn btn-danger" wire:click="eliminarObra({{ $index }})">Eliminar</button></td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="col-sm-12 col-md-8 text-center">
    <button class="btn btn-primary" wire:click="agregarObra({{1}})">
        <div class="base-icons">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </div>
    </button>

    <button class="btn btn-danger" wire:click="resetObra">Eliminar Obras</button>
</div>
<br>
<div class="col-sm-12 col-md-8">
    <div class="form-group">
        <h6><strong>Conclusion: la Gobernación se remite el presente diagnóstico para :</strong></h6>
        <textarea wire:model.lazy="conclusion" class="form-control" name="" id="" cols="100" rows="3" placeholder="...">hola</textarea>
        @error('conclusion') <span class="text-danger er">{{ $message}} </span>

        @enderror
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
            @foreach($requerimiento as $index => $fila)
              <tr>
                <td><input type="text" wire:model="requerimiento.{{ $index}}.items"></td>
                <td><input type="text" wire:model="requerimiento.{{ $index}}.descripcion"></td>
              </tr>
            @endforeach
        </tbody>
    </table> -->


    <!-- <button wire:click="agregarFila">Agregar fila</button> -->




</div>

@include('common.modalFooter')
<style>
    .bolded {
        .bolded {
            font-weight: bold;
        }
    }
</style>