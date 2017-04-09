<?php

namespace App\Http\Controllers;
use App\Models\Campeonato;
use App\Models\Jogo;
use App\Models\Time;
use Illuminate\Http\Request;

class JogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jogos = Jogo::with('Campeonato')->get();
        $teamHome = Jogo::with('TimeHome')->get();
        $teamAway = Jogo::with('TimeAway')->get();
        return view('jogo.index', compact('jogos','teamHome','teamAway'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campeonatos = Campeonato::all();
        $times = Time::all();

        return view('jogo.create',compact('campeonatos','times'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'competition_id'=> 'required',
            'home_id'=> 'required',
            'away_id'=> 'required',
            'scoreHome'=> 'required',
            'scoreAway'=> 'required',

        ]);
        // create new data
        $jogo = new jogo;
        $jogo->competition_id = $request->competition_id;
        $jogo->home_id = $request->home_id;
        $jogo->away_id = $request->away_id;
        $jogo->scoreHome = $request->scoreHome;
        $jogo->scoreAway = $request->scoreAway;

        $jogo->save();
        return redirect()->route('jogo.index')->with('alert-success','Salvo!');
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
        $campeonatos = Campeonato::all();
        $times = Time::all();

        $jogo = Jogo::findOrFail($id);
        // return to the edit views
        return view('jogo.edit',compact('jogo','campeonatos','times'));
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
        $this->validate($request,[
            'competition_id'=> 'required',
            'home_id'=> 'required',
            'away_id'=> 'required',
            'scoreHome'=> 'required',
            'scoreAway'=> 'required',

        ]);

        $jogo = Jogo::findOrFail($id);
        $jogo->competition_id = $request->competition_id;
        $jogo->home_id = $request->home_id;
        $jogo->away_id = $request->away_id;
        $jogo->scoreHome = $request->scoreHome;
        $jogo->scoreAway = $request->scoreAway;

        $jogo->save();

        return redirect()->route('jogo.index')->with('alert-success','Dados atualizados');
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
        $jogo = Jogo::findOrFail($id);
        $jogo->delete();
        return redirect()->route('jogo.index')->with('alert-success','Dado Removido!');
    }
}
