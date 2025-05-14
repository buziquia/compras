<form action="{{ route('produtos.store') }}" method="POST">
    @csrf
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required>

    <label for="preco">Preço:</label>
    <input type="number" step="0.01" name="preco" required>

    <label for="variacao">Variação:</label>
    <input type="text" name="variacao">

    <label for="quantidade">Estoque:</label>
    <input type="number" name="quantidade" required>

    <button type="submit">Salvar</button>
</form>
