@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <h1>Jogos</h1>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <tr>
                    <th>No</th>
                    <th>Competicao</th>
                    <th>Home</th>
                    <th>Away</th>
                    <th>Score Home</th>
                    <th>Score Away</th>
                    <th>Ações</th>
                </tr>
                <a href="{{route('jogo.create')}}" class="btn btn-info pull-right">Novo Jogo</a><br><br>
                <?php $no=1; ?>
                @foreach($jogos as $jogo)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$jogo->Campeonato->name}}</td>
                        <td>{{$jogo->TimeHome->name}}</td>
                        <td>{{$jogo->TimeAway->name}}</td>
                        <td>{{$jogo->scoreHome}}</td>
                        <td>{{$jogo->scoreAway}}</td>
                        <td>
                            <form class="" action="{{route('jogo.destroy',$jogo->id)}}" method="post">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <a href="{{route('jogo.edit',$jogo->id)}}" class="btn btn-primary">Edit</a>
                                <input type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que quer deletar esse item?');" name="name" value="delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop