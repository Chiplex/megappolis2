<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Modules\Core\Entities\Module;
use Modules\Core\Entities\App;
use Datatables;

class ModuleController extends Controller
{
    /**
     * Show data for Datatables
     * @return Renderable
     */
    public function data()
    {
        $modules = Module::with(['app','module'])->select('modules.*');
        return Datatables::of($modules)
            ->setRowClass('{{ "context-menu" }}')
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('dashboard', $this->GetInfo([]));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $apps = App::pluck('name', 'id')->all();
        $menus = Module::type('menu')->pluck('name', 'id')->all();
        $form = ['route' => 'core.module.store', 'method' => 'post'];
        $data = ['apps' => $apps, 'menus' => $menus, 'form' => $form];
        return $this->layout($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data['state'] = "A";
            $data['module_id'] = 0;
            Module::create($data);

            return redirect()->route('core.module.index')->with('success', 'Module created successfully');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Module $module)
    {
        $data = ['module' => $module];
        return view('dashboard', $this->GetInfo($data));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Module $module)
    {
        $apps = App::pluck('name', 'id')->all();
        $menus = Module::type('menu')->pluck('name', 'id')->all();
        $form = ['route' => ['core.module.update', $module->id], 'method' => 'put'];
        $data = ['apps' => $apps, 'menus' => $menus, 'form' => $form, 'module' => $module];
        return $this->layout($data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Module $module)
    {
        try {
            $data = $request->all();
            $data['module_id'] = $data['module_id'] ?? 0;
            $module->update($data);

            return redirect()->route('core.module.index')->with('success', 'Module updated successfully');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Module $module)
    {
        try {
            $module->delete();

            return redirect()->route('core.module.index')->with('success', 'Module deleted successfully');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }
}
