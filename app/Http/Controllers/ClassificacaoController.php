<?php

namespace App\Http\Controllers;
use App\Models\Campeonato;
use App\Models\Jogo;
use App\Models\Time;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class Classificacao
{
    public $id;
    public $nome;
    public $pontos;
    public $saldo;
    public $vitorias;
    public $golsMarcados;
    public $golsSofridos;
    public $jogos;

}
class ClassificacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $campeonatos = Campeonato::all();
        $jogos = [];
        $sorted =[];

        $times = Time::all();

        return view('classificacao.index', compact('campeonatos','jogos','sorted','times'));
    }
    public function store(Request $request)
    {
        $campeonato = $request->competition_id;
        $jogos = Jogo::all()->where('competition_id', $campeonato);

        $times = [];

        //Pega os Id's de cada time que possui jogo no campeonato
        foreach ($jogos as $jogo) {

            array_push($times, $jogo->home_id);
            array_push($times, $jogo->away_id);
        }

        //Exclui os Id's duplicados
        $uniqueTimes = array_unique($times);
        $classi = array();


        foreach ($uniqueTimes as $t)
        {
            $time = Time::findOrFail($t);
            $classificacao = new Classificacao();
            $classificacao->id = $t;
            $classificacao->nome = $time->name;
            $numeroPontos = 0;
            $numeroVitorias = 0;
            $numeroGolsMarcados = 0;
            $numeroGolsSofridos = 0;
            $numeroJogos = 0;

            //Para cada time percorre-se a lista de jogos do cacmpeonato
            foreach ($jogos as $jogo) {


                if ($t == $jogo->home_id)
                {
                    $numeroJogos++;
                    if ($jogo->scoreHome > $jogo->scoreAway)
                    {
                        $numeroGolsSofridos+= $jogo->scoreAway;
                        $numeroGolsMarcados += $jogo->scoreHome;
                        $numeroVitorias++;
                        $numeroPontos += 3;
                    }
                    if ($jogo->scoreHome == $jogo->scoreAway)
                    {
                        $numeroGolsSofridos+= $jogo->scoreHome;
                        $numeroGolsMarcados += $jogo->scoreHome;
                        $numeroPontos += 1;
                    }
                    if ($jogo->scoreHome < $jogo->scoreAway)
                    {
                        $numeroGolsMarcados += $jogo->scoreHome;
                        $numeroGolsSofridos+= $jogo->scoreHome;
                    }
                }
                if ($t == $jogo->away_id)
                {
                    $numeroJogos++;
                    if ($jogo->scoreHome < $jogo->scoreAway)
                    {
                        $numeroGolsSofridos+= $jogo->scoreHome;
                        $numeroGolsMarcados += $jogo->scoreAway;
                        $numeroVitorias++;
                        $numeroPontos += 3;
                    }
                    if ($jogo->scoreHome == $jogo->scoreAway)
                    {
                        $numeroGolsSofridos+= $jogo->scoreAway;
                        $numeroGolsMarcados += $jogo->scoreAway;
                        $numeroPontos += 1;
                    }
                    if ($jogo->scoreHome > $jogo->scoreAway)
                    {
                        $numeroGolsMarcados += $jogo->scoreAway;
                        $numeroGolsSofridos+= $jogo->scoreAway;
                    }
                }
            }

            //Atribui os valores à sua respectiva propriedade
            $classificacao->golsSofridos = $numeroGolsSofridos;
            $classificacao->vitorias = $numeroVitorias;
            $classificacao->pontos = $numeroPontos;
            $classificacao->golsMarcados = $numeroGolsMarcados;
            $classificacao->saldo = $numeroGolsMarcados-$numeroGolsSofridos;
            $classificacao->jogos = $numeroJogos;

            array_push($classi, $classificacao);

        }
        //Transforma numa coleção laravel para utilizar a ordenação
        $collection = collect($classi);

        //Ordena seguindo criterios de desempate: pontos->vitorias->saldo

        $sorted = $collection->sortByDesc('saldo')->sortBy('vitorias')->sortByDesc('pontos');
        $sorted->values()->all();


        //carrega lista de campeonatos para exibir na view
        $campeonatos = Campeonato::all();

        return view('classificacao.index', compact('campeonatos','jogos','sorted','nomeTime'));
    }
}
