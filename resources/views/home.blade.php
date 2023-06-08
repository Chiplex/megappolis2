@extends('adminlte::page')

@section('title', 'Home')

@section('content_top_nav_right')
    @if (Route::has('login'))
        @guest
            <li>
                <a href="{{ route('login') }}" class="nav-link">Log in</a>
            </li>
            <li>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                @endif
            </li>
        @endauth
    @endif
@endsection

{{-- Aqui deberia ir los erroes en notificaciones --}}
@section('content_header')
    @if (\Session::has('message'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            {!! \Session::get('message') !!}
        </div>
    @endif
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="position-relative p-3 bg-green text-center">
                            <a href="{{ route('core.app.create') }}">
                                <i class="fa fa-plus fa-10x fa-fw"></i>
                            </a>
                            <h1 class="display-1">Nueva App</h1>
                        </div>
                    </div>
                    @foreach ($apps as $app)
                    <div class="col-4">
                        <div class="position-relative p-3 bg-light text-center">
                            <div class="ribbon-wrapper ribbon-xl">
                                <div class="ribbon bg-warning text-lg">
                                    NEW
                                </div>
                            </div>
                            <a href="{{ route($app->name) }}">
                                <i class="fa {{$app->icon }} fa-10x fa-fw"></i>
                            </a>
                            <h1 class="display-1">{{ $app->name }}</h1>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/helpers.js') }}" ></script>
    {{-- <script src="{{ asset('js/dashboard.js') }}" defer></script> --}}
@stop

@section('footer')
© 2021 MegaAppolis.
@endsection