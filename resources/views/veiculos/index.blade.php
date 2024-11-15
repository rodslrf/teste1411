@extends('layouts.darkMode')
@section('content_header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/custom-dark-mode.css') }}">

    <h1>Veículos</h1>
    @if (auth()->user()->cargo == 0)
        <a class="btn btn-novo" href="{{ route('veiculos.create') }}">Novo Veículo</a>

        <form action="{{ route('veiculos.index') }}" method="GET">
            <input class="btn btn-novo" name="search" placeholder="Buscar veículo" value="{{ request('search') }}">
            <button type="submit" class="btn btn-novo">Buscar</button>
        </form>
    @else 
        <form action="{{ route('veiculos.index') }}" method="GET">
            <input class="btn btn-novo" name="search" placeholder="Buscar veículo" value="{{ request('search') }}">
            <button type="submit" class="btn btn-novo">Buscar</button>
        </form>
    @endif

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
                <th>Funcionamento:</th>
                <th>Gererciamento:</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($veiculos as $veiculo)
            <tr>
                <td>{{ $veiculo->marca}} - {{ $veiculo->modelo }}</td>
                <td>{{ $veiculo->placa}}</td>
<script>
    function toggleFuncionamento(veiculoId, isChecked) {
        fetch(`/veiculos/${veiculoId}/mudarStatus`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                funcionamento: isChecked ? 0 : 1 
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const toast = document.createElement('div');
                toast.className = 'alert alert-success position-fixed top-0 end-0 m-3';
                toast.innerHTML = 'Status atualizado com sucesso!';
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
            } else {
                throw new Error(data.message);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            document.getElementById(`funcionamento_${veiculoId}`).checked = !isChecked;
            
            const toast = document.createElement('div');
            toast.className = 'alert alert-danger position-fixed top-0 end-0 m-3';
            toast.innerHTML = 'Erro ao atualizar status!';
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        });
    }
</script>
                <td>
                @if (auth()->user()->cargo == 0) 
                            <label class="toggle-switch">
                                <input type="checkbox" 
                                    id="funcionamento_{{ $veiculo->id }}" 
                                        {{ $veiculo->funcionamento ? '' : 'checked' }} 
                                            onchange="toggleFuncionamento({{ $veiculo->id }}, this.checked)">
                                                <div class="toggle-switch-background">
                                                    <div class="toggle-switch-handle"></div>
                                                </div>
                            </label>
                            </td>
                            <td>
                            <a href="{{ route('veiculos.show', $veiculo->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('veiculos.edit', $veiculo->id) }}" class="btn btn-info btn-sm">Editar</a>
                            <form action="{{ route('veiculos.destroy', $veiculo->id) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Certeza que deseja excluir?')">Excluir</button>
                            </form>
                        </td>
                    @else
                        @if ($veiculo->funcionamento == 0)
                            <div class="carro1">
                            <i class="fas fa-car"></i>
                            </div>
                        @else 
                            <div class="carro2">
                            <i class="fas fa-car"></i>
                            </div>
                        @endif
                    <td>
                        <a href="{{ route('veiculos.show', $veiculo->id) }}" class="btn btn-info btn-sm">Ver</a>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
        @stop