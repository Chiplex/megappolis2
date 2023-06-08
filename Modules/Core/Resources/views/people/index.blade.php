<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="input-group">
                        <input type="text" name="table_search" class="form-control" placeholder="Search" />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-tools">
                    <a class="btn btn-tool btn-primary" href="{{ url('/core/people/register/') }}" role="button"><i
                            class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tipo</th>
                            <th>Name</th>
                            <th>Other Name</th>
                            <th>Last Name</th>
                            <th>Other Last Name</th>
                            <th>Birth</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Sex</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peoples as $people)
                        <tr>
                            <td>{{$people->id}}</td>
                            <td>{{$people->tipo}}</td>
                            <td>{{$people->name}}</td>
                            <td>{{$people->otherName}}</td>
                            <td>{{$people->lastName}}</td>
                            <td>{{$people->otherLastName}}</td>
                            <td>{{$people->dateBirth}}</td>
                            <td>{{$people->country}}</td>
                            <td>{{$people->city}}</td>
                            <td>{{$people->phone}}</td>
                            <td>{{$people->sex}}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ url('/core/people/register/'.$people->id) }}"
                                        class="btn btn-info btn-flat">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>