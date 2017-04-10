@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Classificação</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form class="" action="{{route('classificacao.store')}}" method="post">
                    {{csrf_field()}}
                    <br>
                        <label>Selecione uma competição
                            <select name="competition_id" class="form-control input-sm">
                                <option value=""></option>
                                @foreach($campeonatos as $cam)
                                    <ul class="dropdown-menu" role="menu">
                                        <option value="{{$cam->id}}">{{$cam->name}}</option>
                                    </ul>
                                @endforeach
                            </select>
                        </label>
                    <br>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Carregar Classificaçao">
            </div>
                </form>
            </div>
        </div>

        <div class="row">
            <table class="table table-striped">
                <tr>
                    <th>Posição</th>
                    <th>Equipe</th>
                    <th>Pontos</th>
                    <th>Jogos</th>
                    <th>Vitórias</th>
                    <th>Gols Pró</th>
                    <th>Gols Contra</th>
                    <th>Saldo</th>
                </tr>
                <?php $no=1; ?>
                @foreach($sorted as $sort)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$sort->nome}}</td>
                        <td>{{$sort->pontos}}</td>
                        <td>{{$sort->jogos}}</td>
                        <td>{{$sort->vitorias}}</td>
                        <td>{{$sort->golsMarcados}}</td>
                        <td>{{$sort->golsSofridos}}</td>
                        <td>{{$sort->saldo}}</td>
                    </tr>
                @endforeach

            </table>
        </div>

    </div>
    @stop
