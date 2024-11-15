@extends('layouts.darkMode')
@section('content_header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/custom-dark-mode.css') }}">

    <h1>Veículos Disponíveis</h1>
    <form action="{{ route('solicitar.index') }}" method="GET">
        <input class="btn btn-novo" name="search" placeholder="Buscar veículo" value="{{ request('search') }}">
        <button type="submit" class="btn btn-novo">Buscar</button>
    </form>
@stop

@section('content')
   <div class="content">
    @if (session('sucess')) 
        <div class="alert alert-success" role="alert">
           {{ session('sucess') }}
        </div>
   </div>
   @endif
   <table class="table table-bordered table-hover">
       <thead>
           <tr>
                <th>Veículos:</th>
                <th>Placa:</th>
                <th>Reserva:</th>
                
        </thead>
        <tbody>
            @foreach ($veiculos as $veiculo)
            @if ($veiculo->funcionamento == 0)
            <tr>
                <td>{{ $veiculo->marca}} - {{ $veiculo->modelo }}</td>
                <td>{{ $veiculo->placa}}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('solicitar.create', $veiculo->id) }}">Solicitar</a>
                </td>
                    </tr>
                    @endif
                    @endforeach
        </tbody>
        @stop