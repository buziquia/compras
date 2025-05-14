@foreach ($produtos as $produto)
<tr>
    <td>{{ $produto->nome }}</td>
    <td>{{ $produto->preco }}</td>
    <td>{{ $produto->estoque->variacao }}</td>
    <td>{{ $produto->estoque->quantidade }}</td>
    <td>
        <a href="{{ route('produtos.edit', $produto->id) }}">Editar</a>
        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Excluir</button>
        </form>
        <form action="{{ route('carrinho.adicionar', $produto->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Comprar</button>
        </form>
    </td>
</tr>
@endforeach
