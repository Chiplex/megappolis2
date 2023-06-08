<div class="card card-info">
    {!! Form::open($form) !!}
    <div class="card-header">
        <div class="card-tools">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    <div class="card-body">
        @include('form.select', ['name' => 'app_id', 'title' => 'App', 'list' => $apps, 'selected' => $page->app_id ?? null])
        @include('form.text', ['name' => 'controller', 'title' => 'Controller', 'value' => $page->controller ?? null])
        @include('form.text', ['name' => 'action', 'title' => 'Action', 'value' => $page->action ?? null])
        @include('form.text', ['name' => 'name', 'title' => 'Name', 'value' => $page->name ?? null])
        @include('form.text', ['name' => 'icon', 'title' => 'Icon', 'value' => $page->icon ?? null])
        @include('form.text', ['name' => 'type', 'title' => 'Type', 'value' => $page->type ?? null])
        @include('form.select', ['name' => 'page_id', 'title' => 'Menu', 'list' => $menus, 'selected' => $page->page_id ?? null])
        {{-- @include('form.checkbox', ['name' => 'header', 'title' => 'Header', 'value'=>'1', 'checked' => false]) --}}
    </div>
    {!! Form::close() !!}
    </form>
</div>