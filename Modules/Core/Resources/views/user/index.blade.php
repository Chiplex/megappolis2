<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                </div>
                <div class="card-tools">
                    <a class="btn btn-tool btn-primary" href="{{ url('/core/user/register/') }}" role="button">
						<i class="fa fa-plus" aria-hidden="true"></i>
					</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table class="table table-head-fixed text-nowrap" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    var t = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('core.user.data') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', "orderable": false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
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
                            OpenWindow('{{ url('/core/user/register/') }}/' + model.id);
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