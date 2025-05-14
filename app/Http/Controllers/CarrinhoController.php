<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class CarrinhoController extends Controller
{
    public function adicionar(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            $carrinho[$id]['quantidade']++;
        } else {
            $carrinho[$id] = [
                "nome" => $produto->nome,
                "preco" => $produto->preco,
                "quantidade" => 1,
            ];
        }

        session()->put('carrinho', $carrinho);
        return redirect()->back()->with('success', 'Produto adicionado ao carrinho!');
    }

    public function remover($id)
    {
        $carrinho = session()->get('carrinho');

        if (isset($carrinho[$id])) {
            unset($carrinho[$id]);
            session()->put('carrinho', $carrinho);
        }

        return redirect()->back()->with('success', 'Produto removido do carrinho!');
    }

    public function mostrar()
    {
        $carrinho = session()->get('carrinho', []);
        $subtotal = 0;

        foreach ($carrinho as $item) {
            $subtotal += $item['preco'] * $item['quantidade'];
        }

        $frete = $this->calcularFrete($subtotal);
        $total = $subtotal + $frete;

        return view('carrinho.mostrar', compact('carrinho', 'subtotal', 'frete', 'total'));
    }

    private function calcularFrete($subtotal)
    {
        if ($subtotal >= 52.00 && $subtotal <= 166.59) {
            return 15.00;
        } elseif ($subtotal > 200.00) {
            return 0.00;
        } else {
            return 20.00;
        }
    }
}

