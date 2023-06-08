<div class="card card-info">
    {{ Form::open($form) }}
    <div class="card-header">
        <div class="card-tools">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    <div class="card-body">
        @include('form.text', ['name' => 'type', 'title' => 'Tipo', 'value' => $app->type ?? ''])
    </div>
    {!! Form::close() !!}
</div>