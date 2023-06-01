<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Entities\App;
use Modules\Core\Entities\People;
use Modules\Core\Entities\Input;
use App\Http\Requests\PeopleRequest;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $apps = App::all();
        return view('home', compact('apps'));
    }

    /**
     * Create a 
     */
    public function create(Request $request)
    {
        $form = ['route' => 'passport.store', 'method' => 'post', 'files' => true];
        return view('passport', compact('form'));
    }

    /**
     * Store a new people.
     */
    public function store(Request $request)
    {
        try {
            $people = new People;
            $people->fill($request->validated())->tipo = 'HUM';
            $people->save();

            return redirect()->route('core.index')
                ->with('success_message', 'Attribute was successfully added.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }
}
