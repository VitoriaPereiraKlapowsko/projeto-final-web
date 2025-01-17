@extends('layouts.app')

@section('title', 'Baixa Registrada')

@section('content')
<h1>Baixa Registrada</h1>

<p><strong>Cliente:</strong> {{ $baixa->cliente->nome }}</p>
<p><strong>Produto:</strong> {{ $baixa->produto->nome }}</p>
<p><strong>Quantidade:</strong> {{ $baixa->quantidade }}</p>
<p><strong>Valor Total:</strong> R$ {{ $baixa->valor_total }}</p>
<p><strong>Data e Hora:</strong> {{ $baixa->data_hora }}</p>

<div>
    <h3>QR Code:</h3>
    {!! $qrCode !!}
</div>

<a href="{{ route('baixas.create') }}" class="btn btn-secondary mt-3">Registrar Nova Baixa</a>
@endsection
