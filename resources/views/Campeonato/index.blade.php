@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Campeonatos</h1>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <tr>
                <th>No</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
            <a href="{{route('campeonato.create')}}" class="btn btn-info pull-right">Nova Competição</a><br><br>
            <?php $no=1; ?>
            @foreach($campeonatos as $campeonato)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$campeonato->name}}</td>

                    <td>
                        <form class="" action="{{route('campeonato.destroy',$campeonato->id)}}" method="post">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="{{route('campeonato.edit',$campeonato->id)}}" class="btn btn-primary">Edit</a>
                            <input type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que quer deletar esse item?');" name="name" value="delete">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    </div>
@stop