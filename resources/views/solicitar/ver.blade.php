@extends('layouts.darkMode')

@section('content_header')
    <h1>Solicitação para o dia {{$solicitacao->data_inicial}} (se aprovado)</h1>
@stop

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-body">
                <h3>Placa do veículo:   {{ $solicitacao->veiculo->placa }}</h3>
                <p><strong>Marca:</strong> {{ $solicitacao->veiculo->marca }}</p>
                <p><strong>Modelo:</strong> {{ $solicitacao->veiculo->modelo }}</p>
                <p><strong>Motivo de utilização:</strong> {{ $solicitacao->motivo }}</p>
                <p><strong>Hora de retirada (se aprovado):</strong> {{ $solicitacao->hora_inicial }}</p>
                <p><strong>Data de devolução (se aprovado):</strong> {{ $solicitacao->data_final }}</p>
                <p><strong>Observação/ões do veículo:</strong> {{ $solicitacao->veiculo->observacao }}</p>
                <p><strong>Quantos KM faltam para a revisão:</strong> {{ $solicitacao->veiculo->km_revisao }}</p>
                    <p><strong>QR Code: </strong></p>
                    <img src="{{ asset('qrcodes/' . $solicitacao->veiculo->qr_code) }}" alt="QR Code do veículo">
            </div>
            <div class="card-footer">
            <a href="{{ route('solicitar.start', $solicitar->veiculo->id) }}" class="btn btn-info btn-sm">Iniciar</a>

                    <form action="{{ url('veiculos/'.$solicitacao->veiculo->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                    </form>
            </div>
        </div>
    </div>
@endsection