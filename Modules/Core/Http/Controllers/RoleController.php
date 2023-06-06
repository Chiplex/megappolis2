<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
// use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Modules\Core\Entities\Role;
use Modules\Core\Entities\App;
use DataTables;

class RoleController extends Controller
{
    /**
     * Show data for Datatables
     */
    public function data()
    {
        $roles = Role::with('users')->get();
        return Datatables::of($roles)
            ->addIndexColumn()
            ->addColumn('user', function ($row) {
                return $row->users->map(function ($user) {
                    return $user->name;
                })->implode(', ');
            })
            ->setRowClass('{{ "context-menu" }}')
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = [];
        return $this->layout($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $form = ['route' => 'core.role.store', 'method' => 'POST'];
        $data = ['form' => $form];
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
            Role::create($data);

            return redirect()->route('core.role.index')
                ->with('success_message', 'Attribute was successfully added.');
        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Role $role)
    {
        $data = ['role' => $role];
        return $this->layout($data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $form = ['route' => ['core.role.update', $role->id], 'method' => 'PUT'];
        $data = ['form' => $form, 'role' => $role];
        return $this->layout($data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Role $role)
    {
        try {
            $data = $request->all();
            $role->update($data);

            return redirect()->route('core.role.index')
                ->with('success_message', 'Attribute was successfully added.');
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
    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return redirect()->route('core.role.index')
                ->with('success_message', 'Attribute was successfully deleted.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }
}
