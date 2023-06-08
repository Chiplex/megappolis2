<div class="card card-info">
    <form class="form-horizontal" action="@if (isset($user)) {{ route('core.user.update' , ['user' => $user->id]) }} @else {{ route('core.user.store') }} @endif" method="POST">
        @csrf
        @if (isset($user))
            @method('PUT')
        @endif
        <div class="card-header">
            <div class="card-tools">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="name" placeholder="name" name="name" value="{{ old('name') ?? isset($user) ? $user->name : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="email" placeholder="email" name="email" value="{{ old('email') ?? isset($user) ? $user->email : '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="people" class="col-sm-2 col-form-label">Persona</label>
                <div class="col-sm-4">
                  <select class="custom-select form-control-border" id="people" name="people_id">
                      @foreach ($peoples as $people)
                          <option value="{{$people->id}}" 
                            @isset($user) 
                              @if (old('people_id') ?? $user->people_id == $people->id) 
                                selected 
                              @endif 
                            @endisset
                            @empty($user)
                              @if (old('people_id') == $people->id) 
                                selected 
                              @endif 
                            @endempty
                            >
                            {{$people->name}}
                          </option> 
                      @endforeach
                  </select>
                </div>
              </div>
        </div>
    </form>
</div>