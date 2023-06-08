<div class="card card-info">
    <form class="form-horizontal" action="@if (isset($people)) {{ route('core.people.update' , ['people' => $people->id]) }} @else {{ route('core.people.store') }} @endif" method="POST">
        @csrf
        @if (isset($people))
            @method('PUT')
        @endif
        <div class="card-header">
            <div class="card-tools">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="tipo" class="col-sm-2 col-form-label">Tipo</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="tipo" placeholder="tipo" name="tipo" value="{{ old('tipo') ?? isset($people) ? $people->tipo : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="name" placeholder="name" name="name" value="{{ old('name') ?? isset($people) ? $people->name : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="otherName" class="col-sm-2 col-form-label">Otros Nombres</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="otherName" placeholder="otherName" name="otherName" value="{{ old('otherName') ?? isset($people) ? $people->otherName : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="lastName" class="col-sm-2 col-form-label">Apellidos</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="lastName" placeholder="lastName" name="lastName" value="{{ old('lastName') ?? isset($people) ? $people->lastName : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="otherLastName" class="col-sm-2 col-form-label">Otros Apellidos</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="otherLastName" placeholder="otherLastName" name="otherLastName" value="{{ old('otherLastName') ?? isset($people) ? $people->otherLastName : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="dateBirth" class="col-sm-2 col-form-label">Fecha de Nacimiento</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="dateBirth" placeholder="dateBirth" name="dateBirth" value="{{ old('dateBirth') ?? isset($people) ? $people->dateBirth : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="country" class="col-sm-2 col-form-label">País</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="country" placeholder="country" name="country" value="{{ old('country') ?? isset($people) ? $people->country : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col-sm-2 col-form-label">Ciudad</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="city" placeholder="city" name="city" value="{{ old('city') ?? isset($people) ? $people->city : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="phone" placeholder="phone" name="phone" value="{{ old('phone') ?? isset($people) ? $people->phone : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="sex" class="col-sm-2 col-form-label">Sex</label>
                <div class="col-sm-4">
                    <select class="custom-select form-control-border" id="sex" name="sex">
                        <option value="male" @isset($people) @if ($people->sex == "male") selected @endif @endisset >Male</option>
                        <option value="female" @isset($people) @if ($people->sex == "female") selected @endif  @endisset>Female</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>