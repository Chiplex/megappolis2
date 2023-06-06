<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Modules\Core\Entities\Module;
use Modules\Core\Entities\Role;
use Modules\Core\Entities\Permission;
use Datatables;

class PermissionController extends Controller
{
    /**
     * Show data for Datatables
     * @return Renderable
     */
    public function data()
    {
        $permissions = Permission::with('module.app', 'role')->select('permissions.*');
        return Datatables::of($permissions)
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
        $modules = Module::all();
        $roles = Role::all();
        $data = ['modules' => $modules, 'roles' => $roles];
        return view('dashboard', $this->GetInfo($data));
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
            Permission::create($data);

            return redirect()->route('core.permission.index')
                ->with('success_message', 'Attribute was successfully added.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('core::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Permission $permission)
    {
        $modules = Module::all();
        $roles = Role::all();
        $data = ['modules' => $modules, 'roles' => $roles, 'permission' => $permission];
        return view('dashboard', $this->GetInfo($data));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Permission $permission)
    {
        try {
            $data = $request->all();
            $permission->update($data);

            return redirect()->route('core.permission.index')
                ->with('success_message', 'Attribute was successfully updated.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()
            ->route('core.permission.index')
            ->with('success_message', 'Attribute was successfully added.');
    }
}
