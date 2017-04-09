@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Times</h1>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <tr>
                    <th>No</th>
                    <th>Nome</th>
                    <th>País</th>
                    <th>Ações</th>
                </tr>
                <a href="{{route('time.create')}}" class="btn btn-info pull-right">Novo Time</a><br><br>
                <?php $no=1; ?>
                @foreach($times as $time)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$time->name}}</td>
                        <td>{{$time->country}}</td>
                        <td>
                            <form class="" action="{{route('time.destroy',$time->id)}}" method="post">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <a href="{{route('time.edit',$time->id)}}" class="btn btn-primary">Edit</a>
                                <input type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que quer deletar esse item?');" name="name" value="delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>


@stop