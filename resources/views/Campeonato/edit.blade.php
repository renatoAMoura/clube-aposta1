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
        <form class="" action="{{route('campeonato.update',$campeonato->id)}}" method="post">
            <input name="_method" type="hidden" value="PATCH">
            {{csrf_field()}}
            <br>
            <label>Nome: </label>
            <div class="form-group{{ ($errors->has('name')) ? $errors->first('name') : '' }}">
                <input type="text" name="name" class="form-control" placeholder="Nome da competição " value="{{$campeonato->name}}">
                {!! $errors->first('name','<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Salvar Alterações">
            </div>
        </form>
            </div>
    </div>
    </div>
@stop