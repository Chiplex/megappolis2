<div class="card card-info">
    <form class="form-horizontal" action="@isset($permission) {{ route('core.permission.update' , ['permission' => $permission->id]) }} @else {{ route('core.permission.store') }} @endif" method="POST">
      @csrf
      @isset($permission)
        @method('PUT')
      @endif
      <div class="card-header">
        <div class="card-tools">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>
      <div class="card-body">
        <div class="form-group row">
          <label for="role" class="col-sm-2 col-form-label">Roles</label>
          <div class="col-sm-4">
            <select class="custom-select form-control-border" id="role" name="role_id">
                @foreach ($roles as $role)
                    <option value="{{$role->id}}"
                      @isset($permission)
                        @if (old('role_id') ?? $permission->role_id == $role->id)
                          selected
                        @endif
                      @endisset
                      @empty($permission)
                        @if (old('role_id') == $role->id)
                          selected
                        @endif
                      @endempty
                      >
                      {{$role->name}}
                    </option>
                @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="module" class="col-sm-2 col-form-label">Module</label>
          <div class="col-sm-4">
            <select class="custom-select form-control-border" id="module" name="module_id">
                @foreach ($modules as $module)
                    <option value="{{$module->id}}"
                      @isset($permission)
                        @if (old('module_id') ?? $permission->module_id == $module->id)
                          selected
                        @endif
                      @endisset
                      @empty($permission)
                        @if (old('module_id') == $module->id)
                          selected
                        @endif
                      @endempty
                      >
                      {{$module->name}}
                    </option>
                @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="name" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="name" placeholder="name" name="name" value="{{ old('name') ?? isset($permission) ? $permission->name : '' }}">
          </div>
        </div>
      </div>
    </form>
  </div>
  @push('js')
  <script>
      var modal = $("#modal");
      var t = $('#table').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ route('core.permission.data') }}',
          columns: [
              { data: 'id', name: 'id', "orderable": false },
              { data: 'descripcion', name: 'descripcion' },
              { data: 'marca', name: 'marca' }
          ],
      });
  
      $.contextMenu({
          selector: ".context-menu",
          build: function ($trigger, e) {
              return {
                  callback: function (key, options) {
                      var tr = $(options.$trigger[0]).closest('tr');
                      var row = t.row(tr);
                      var model = row.data();
                      switch (key) {
                          case "edit":
                              AbrirModal(model);
                              break;
                      }
                  },
                  items: {
                      "edit": { name: "Editar", icon: "edit", },
                  }
              };
          },
      });
  
      $("#frmProducto").on('submit', function (e) {
          e.preventDefault();
          var model = FormToJSON($(this));
          var url = model.id ? "{{ url('yeipi/product/register') }}" + "/" +  model.id : "{{ route('yeipi.product.store') }}"
          $.ajax({
              type: "POST",
              url: url,
              data: model,
          })
          .done((r) => t.search("").draw())
          .fail((e) => console.log(e))
          .always(() => modal.modal("hide"))
      });
  
      $("#btnAbrirModal").on('click', function () {
         AbrirModal();
      });
  
      function AbrirModal(model) {
          let nuevo = typeof model === "undefined";
          $("#iptMethod").remove();
          if (nuevo) {
              $("#frmProducto")[0].reset();
          }
          else {
              JSONToForm($("#frmProducto")[0], model);
          }
          modal.modal("show");
      }
  </script>
  @endpush