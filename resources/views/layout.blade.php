@extends('adminlte::page')

@section('title', $module->buildTitle())

@section('content_top_nav_right')
    @if (Route::has('login'))
        <li class="nav-item">
            @guest
                <a href="{{ route('login') }}" class="nav-link">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 nav-link">Register</a>
                @endif
            @endauth
        </li>
    @endif
@endsection

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $module->buildTitle() }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @foreach($module->buildBreadcrumbs($module) as $breadcrumb)
                        <li class="breadcrumb-item @if($breadcrumb['active']) active @endif">
                            @if($breadcrumb['active'])
                                {{ $breadcrumb['name'] }}
                            @else
                                <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
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

@if ($permissions->contains('name', 'view'))
    @include($module->buildView(), $data)
@else
    No tiene permisos para ver esta pagina
@endif

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/service.js') }}" ></script>
    <script src="{{ asset('js/helpers.js') }}" ></script>
    {{-- <script src="{{ asset('js/dashboard.js') }}" defer></script> --}}
@stop

@section('footer')
© 2021 MegaAppolis.
@endsection