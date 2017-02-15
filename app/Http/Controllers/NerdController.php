<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NerdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nerds = Nerd::all();

        return View::make('nerds.index')
            ->with('nerds', $nerds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View:make('nerds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'nerd_level' => 'required|numeric'
            );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('nerds/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        }else{
            $nerd = new Nerd;
            $nerd->name = Input::get('name');
            $nerd->email = Input::get('email');
            $nerd->nerd_level = Input::get('nerd_level');
            $nerd->save();

            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to('nerds');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nerd = Nerd::find($id);

        return View::make('nerds.show')
            ->with('nerd', $nerd);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nerd = Nerd::find($id);

        return View::make('nerds.edit')
            ->with('nerd', $nerd);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'nerd_level' => 'required|numeric'
            );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('nerds/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        }else{
            $nerd = Nerd::find($id);
            $nerd->name = Input::get('name');
            $nerd->email = Input::get('email');
            $nerd->nerd_level = Input::get('nerd_level');
            $nerd->save();

            Session::flash('message', 'Successfully updated nerd!');
            return Redirect::to('nerds');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nerd = Nerd::find($id);
        $nerd->delete();

        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to('nerds');
    }
}
