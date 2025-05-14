@extends('layouts.app')

@section('content')
<h1>Carrinho de Compras</h1>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table>
    <thead>
        <tr>
            <th>Produto</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Total</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($carrinho as $id => $item)
        <tr>
            <td>{{ $item['nome'] }}</td>
            <td>R$ {{ number_format($item['preco'], 2, ',', '.') }}</td>
            <td>{{ $item['quantidade'] }}</td>
            <td>R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}</td>
            <td>
                <form action="{{ route('carrinho.remover', $id) }}" method="POST">
                    @csrf
                    <button type="submit">Remover</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<p><strong>Subtotal:</strong> R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
<p><strong>Frete:</strong> R$ {{ number_format($frete, 2, ',', '.') }}</p>
<p><strong>Total:</strong> R$ {{ number_format($total, 2, ',', '.') }}</p>
@endsection
