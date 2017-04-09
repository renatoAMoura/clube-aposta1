<?php

namespace App\Http\Controllers;

use App\Models\Campeonato;
use Illuminate\Http\Request;

class CampeonatoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show data
        $campeonatos =  Campeonato::all();
        return view('campeonato.index',['campeonatos' => $campeonatos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campeonato.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $this->validate($request,[
            'name'=> 'required',

        ]);
        // create new data
        $campeonato = new campeonato;
        $campeonato->name = $request->name;

        $campeonato->save();
        return redirect()->route('campeonato.index')->with('alert-success','Salvo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campeonato = Campeonato::findOrFail($id);
        // return to the edit views
        return view('campeonato.edit',compact('campeonato'));
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
        // validation
        $this->validate($request,[
            'name'=> 'required', ]);

        $campeonato = Campeonato::findOrFail($id);
        $campeonato->name = $request->name;
        $campeonato->save();

        return redirect()->route('campeonato.index')->with('alert-success','Dados atualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete data
        $campeonato = Campeonato::findOrFail($id);
        $campeonato->delete();
        return redirect()->route('campeonato.index')->with('alert-success','Dado Removido!');
    }
}
