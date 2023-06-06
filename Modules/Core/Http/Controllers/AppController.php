<?php

namespace Modules\Core\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Modules\Core\Entities\App;
use DataTables;

class AppController extends Controller
{
    /**
     * Show data for Datatables
     */
    public function data()
    {
        $apps = App::with(['user','statuses'])->get();
        return Datatables::of($apps)
            ->addIndexColumn()
            ->addColumn('status', function ($app) {
                return $app->latestStatus();
            })
            ->addColumn('status_date', function ($app) {
                return $app->latestStatus() != null ? $app->latestStatus()->created_at->format('d/m/Y H:i') : '';
            })
            ->setRowClass(function ($app) {
                switch ($app->status) {
                    case 'approved':
                        return 'context-menu-approved';
                        break;
                    case 'pending':
                    case 'rejected':
                    default:
                        return 'context-menu-reject';
                        break;
                }
            })
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $form = ['route' => 'core.app.store', 'method' => 'POST'];
        $data = ['form' => $form, 'crud' => '/core/app'];
        return $this->layout($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $form = ['route' => 'core.app.store', 'method' => 'POST'];
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
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        try {
            $app = App::create($data);
            $app->setStatus(App::STATUS_PENDING);

            $response = [
                'success' => true,
                'message' => 'App was successfully inserted.'
            ];

        } catch (Exception $exception) {
            $response = [
                'success' => false,
                'message' => 'App was not successfully inserted.'
            ];
        }

        if ($request->ajax()) {
            return response()->json($response);
        }

        return redirect()
            ->route('core.app.index')
            ->with('success_message', 'App was successfully added.');
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data = ['app_' => $app];
        return $this->layout($data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = ['app_' => $app];
        return $this->layout($data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param App $app
     * @return Renderable
     */
    public function update(Request $request, App $app)
    {
        try {
            $app->update($request->all());
            $response = [
                'success' => true,
                'message' => 'App was successfully updated.'
            ];

        } catch (Exception $exception) {
            $response = [
                'success' => false,
                'message' => 'App was not successfully updated.'
            ];
        }

        if ($request->ajax()) {
            return response()->json($response);
        }

        return redirect()
            ->route('core.app.index')
            ->with('success_message', 'App was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     * @param App $app
     * @return Renderable
     */
    public function destroy(App $app)
    {
        try {
            $app->delete();

            if ($request->ajax())
                return response()->json(['success' => true, 'message' => 'App was successfully deleted.']);

            return redirect()->route('core.app.index')->with('success_message', 'App was successfully deleted.');
        } catch (Exception $exception) {
            if ($request->ajax())
                return response()->json(['success' => false, 'message' => 'App was not successfully deleted.']);

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Aprueba la aplicacion.
     * @param App $app
     * @return Renderable
     */
    public function approve(App $app)
    {
        try {
            $app->setStatus(App::STATUS_APPROVED);

            $response = [
                'success' => true,
                'message' => 'App was successfully approved.'
            ];

        } catch (Exception $exception) {
            $response = [
                'success' => false,
                'message' => 'App was not successfully approved.'
            ];
        }

        if ($request->ajax()) {
            return response()->json($response);
        }

        return redirect()
            ->route('core.app.index')
            ->with('success_message', 'App was successfully approved.');
    }

    /**
     * Rechaza la aplicacion.
     * @param App $app
     * @return Renderable
     */
    public function reject(App $app)
    {
        try {
            $app->setStatus(App::STATUS_REJECTED);

            $response = [
                'success' => true,
                'message' => 'App was successfully rejected.'
            ];

        } catch (Exception $exception) {
            $response = [
                'success' => false,
                'message' => 'App was not successfully rejected.'
            ];
        }

        if ($request->ajax()) {
            return response()->json($response);
        }

        return redirect()
            ->route('core.app.index')
            ->with('success_message', 'App was successfully rejected.');
    }
}
