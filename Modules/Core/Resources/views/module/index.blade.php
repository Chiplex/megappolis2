<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a class="btn btn-tool btn-primary" href="{{ url('/core/page/register/') }}" role="button"><i
                            class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-condensed" style="width: 100%" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Icon</th>
                            <th>App</th>
                            <th>Controller</th>
                            <th>Action</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Page</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


@push('js')
<script>
    var t;
    $(function () {
        t = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('core.page.data') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', "orderable": false, "searchable": false },
                { data: 'icon', name: 'icon' },
                { data: 'app.name', name: 'app.name' },
                { data: 'controller', name: 'controller' },
                { data: 'action', name: 'action' },
                { data: 'name', name: 'name' },
                { data: 'type', name: 'type' },
                { data: 'page.name', name: 'name', defaultContent: "", "orderable": false },
            ],
        });
    });

    $.contextMenu({
        selector: '.context-menu',
        build: function ($trigger, e) {
            return {
                callback: function (key, options) {
                    var tr = $(options.$trigger[0]).closest('tr');
                    var row = t.row(tr);
                    var model = row.data();
                    switch (key) {
                        case "edit":
                            var win = OpenWindow("{{ url('/core/page/register') }}/" + model.id)
                            AbrirModal(model);
                            break;
                    }
                },
                items: {
                    "edit": { name: "Editar", icon: "fa fa-edit" },
                    "delete": { name: "Borrar", icon: "fa fa-delete" },
                }
            };
        }
    });
</script>
@endpush