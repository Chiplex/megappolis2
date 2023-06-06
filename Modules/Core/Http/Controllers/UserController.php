<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    /**
     * Show data for Datatables
     */
    public function data()
    {
        $user = User::with('people')->get();
        return Datatables::of($user)
            ->addIndexColumn()
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
        return view('dashboard', $this->GetInfo($data));
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $peoples = People::all();
        $data = ['peoples' => $peoples];
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
            User::create($data);

            return redirect()
                ->route('core.app.index')
                ->with('success_message', 'App was successfully added.');
        } catch (Exception $exception) {
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
    public function show($id)
    {
        return view('core::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(User $user)
    {
        $peoples = People::all();
        $data = ['user' => $user, 'peoples' => $peoples];
        return view('dashboard', $this->GetInfo($data));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, User $user)
    {
        try {
            $data = $request->all();
            $user->update($data);

            return redirect()
                ->route('core.user.index')
                ->with('success_message', 'App was successfully added.');
        } catch (Exception $exception) {
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
    public function destroy($id)
    {
        //
    }
}
