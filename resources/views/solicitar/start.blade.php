@extends('layouts.darkMode')

@section('content_header')
    <h1>Solicitação Do dia {{$solicitacao->data_inicial}} em progresso</h1>
@stop

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-body">
                <h3><strong>Data da retirada:</strong> {{ $solicitacao->data_inicial }}</h3>
                <h3><strong>Hora de retirada:</strong> {{ $solicitacao->hora_inicial }}</h3>
                <p><strong>Placa do veículo: {{ $solicitacao->veiculo->placa }}</strong></p>
                <p><strong>Marca:</strong> {{ $solicitacao->veiculo->marca }}</p>
                <p><strong>Modelo:</strong> {{ $solicitacao->veiculo->modelo }}</p>
                <p><strong>Data de devolução:</strong> {{ $solicitacao->data_final }}</p>
                <p><strong>Quantos KM faltam para a revisão:</strong> {{ $solicitacao->veiculo->km_revisao }}</p>

                <a href="{{ route('solicitar.index', $solicitacao->veiculo->id) }}" class="btn btn-info btn-sm">Finalizar utilização do veículo</a>
        </div>
    </div>
@endsection