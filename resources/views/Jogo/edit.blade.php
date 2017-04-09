@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Editar Registro</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <form class="" action="{{route('jogo.update',$jogo->id)}}" method="post">
                    <input name="_method" type="hidden" value="PATCH">
                    {{csrf_field()}}
                    <br>
                    <div class="form-group">
                        <label>Competição
                            <select name="competition_id" class="form-control input-sm">
                                <option value="{{$jogo->competition_id}}">{{$jogo->Campeonato->name}}</option>
                                @foreach($campeonatos as $cam)
                                    <ul class="dropdown-menu" role="menu">
                                        <option value="{{$cam->id}}">{{$cam->name}}</option>
                                    </ul>
                                @endforeach
                            </select>
                        </label>
                    </div>


                    <div class="form-group">
                        <label>Home
                            <select name="home_id" class="form-control input-sm">
                                <option value="{{$jogo->home_id}}">{{$jogo->TimeHome->name}}</option>
                                @foreach($times as $time)
                                    <ul class="dropdown-menu" role="menu">
                                        <option value="{{$time->id}}">{{$time->name}}</option>
                                    </ul>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <label>Placar Home: </label>
                    <div class="form-group{{ ($errors->has('scoreHome')) ? $errors->first('scoreHome') : '' }}">
                        <input type="text" name="scoreHome" class="form-control" placeholder="Placar Home" value="{{$jogo->scoreHome}}">
                        {!! $errors->first('scoreHome','<p class="help-block">:message</p>') !!}
                    </div>


                    <div class="form-group">
                        <label>Away
                            <select name="away_id" class="form-control input-sm">
                                <option value="{{$jogo->away_id}}">{{$jogo->TimeAway->name}}</option>
                                @foreach($times as $time)
                                    <ul class="dropdown-menu" role="menu">
                                        <option value="{{$time->id}}">{{$time->name}}</option>
                                    </ul>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <label>Placar Away: </label>
                    <div class="form-group{{ ($errors->has('scoreAway')) ? $errors->first('scoreAway') : '' }}">
                        <input type="text" name="scoreAway" class="form-control" placeholder="Placar Away" value="{{$jogo->scoreAway}}">
                        {!! $errors->first('scoreAway','<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Salvar Alterações">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop