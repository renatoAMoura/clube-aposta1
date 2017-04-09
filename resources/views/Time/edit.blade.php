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
                <form class="" action="{{route('time.update',$time->id)}}" method="post">
                    <input name="_method" type="hidden" value="PATCH">
                    {{csrf_field()}}
                    <br>
                    <label>Nome: </label>
                    <div class="form-group{{ ($errors->has('name')) ? $errors->first('name') : '' }}">
                        <input type="text" name="name" class="form-control" placeholder="Nome da competição" value="{{$time->name}}">
                        {!! $errors->first('name','<p class="help-block">:message</p>') !!}
                    </div>
                    <label>País: </label>
                    <div class="form-group{{ ($errors->has('country')) ? $errors->first('country') : '' }}">
                        <input type="text" name="country" class="form-control" placeholder="País da equipe" value="{{$time->country}}">
                        {!! $errors->first('country','<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Salvar Alterações">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop