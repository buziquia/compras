<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Estoque;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('estoque')->get();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'variacao' => 'nullable|string|max:255',
            'quantidade' => 'required|integer|min:0',
        ]);

        $produto = Produto::create([
            'nome' => $request->nome,
            'preco' => $request->preco,
        ]);

        Estoque::create([
            'produto_id' => $produto->id,
            'variacao' => $request->variacao,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function edit($id)
    {
        $produto = Produto::with('estoque')->findOrFail($id);
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'variacao' => 'nullable|string|max:255',
            'quantidade' => 'required|integer|min:0',
        ]);

        $produto = Produto::findOrFail($id);
        $produto->update([
            'nome' => $request->nome,
            'preco' => $request->preco,
        ]);

        $estoque = Estoque::where('produto_id', $produto->id)->first();
        $estoque->update([
            'variacao' => $request->variacao,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->estoque()->delete();
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
}

