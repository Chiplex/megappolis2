<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a class="btn btn-tool btn-primary" href="{{ url('/core/permission/register/') }}" role="button"><i
                            class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table" id="table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role</th>
                            <th>App</th>
                            <th>Controller</th>
                            <th>Action</th>
                            <th>Page</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

@push('js')
<script>
    var modal = $("#modal");
    var t = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('core.permission.data') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', "orderable": false, searchable: false },
            { data: 'role.name', name: 'role.name' },
            { data: 'module.app.name', name: 'module.app.name' },
            { data: 'module.controller', name: 'module.controller' },
            { data: 'module.action', name: 'module.action' },
            { data: 'module.name', name: 'module.name' },
            { data: 'name', name: 'name' },
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
                            OpenWindow('{{ url('/core/permission/register/') }}/' + model.id);
                            break;
                    }
                },
                items: {
                    "edit": { name: "Editar", icon: "edit", },
                }
            };
        },
    });

</script>
@endpush