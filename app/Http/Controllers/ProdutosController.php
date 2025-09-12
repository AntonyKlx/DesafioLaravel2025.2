<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        // $termoDePesquisa = $request->input('pesquisa');
        $query = Produto::query();
        // if($termoDePesquisa){
        //     $query->where('nome', 'like', '%' . $termoDePesquisa . '%');
        // }
        $user = Auth::user();

        if (isAdminLoggedIn()) {
            $produtos = $query->orderByDesc('created_at')->paginate(9);
        } else {
            $produtos = Produto::where('anunciante_id', $user->id)->paginate(9);
        }

        return view('gerenciador-produtos', [
            'produtos' => $produtos,
        ]);
    }

    public function show($id)
    {
        $produto = Produto::where('id', $id)->first();
        //dd($produtos->id);

        return view('gerenciador-show', [
            'produto' => $produto,
        ]);
    }

    public function create()
    {
        $categorias = Categoria::all();

        return view('create-produto', [
            'categorias' => $categorias
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'preco' => ['required', 'numeric', 'min:0'],
            'descricao' => ['nullable', 'string'],
            'quantidade' => ['required', 'integer', 'min:0'],
            'categoria_id' => ['required', 'exists:categoria,id_categoria'],
            'foto' => ['required', 'image', 'max:2048'],
        ]);

        $produto = new Produto();
        if ($request->hasFile('foto')) {
            $arquivo = $request->file('foto');
            $nomeArquivo = uniqid() . '-msflix' . $arquivo->getClientOriginalExtension();
            $arquivo->move(public_path('produtos'), $nomeArquivo);

            $produto->foto = 'produtos/' . $nomeArquivo;
        }

        $produto->nome = $request->nome;
        $produto->preco = $request->preco;
        $produto->descricao = $request->descricao;
        $produto->quantidade = $request->quantidade;
        $produto->categoria_id = $request->categoria_id;
        $produto->anunciante_id = Auth::id();

        $produto->save();

        return redirect()->route('gerenciador.produtos');
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::all();
        return view('edit-produto', [
            'produto' => $produto,
            'categorias' => $categorias
        ]);
    }

    public function update(Request $request, Produto $produto)
    {
        $preco = str_replace(',', '.', $request->preco);
        $validatedData = $request->validate([
            'nome' => ['nullable', 'string', 'max:255'],
            'preco' => ['nullable', 'numeric', 'min:0'],
            'descricao' => ['nullable', 'string'],
            'quantidade' => ['nullable', 'integer', 'min:0'],
            'categoria_id' => ['nullable', 'exists:categoria,id_categoria'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = $validatedData;

        if ($request->hasFile('foto')) {
            if ($produto->foto && file_exists(public_path($produto->foto))) {
                unlink(public_path($produto->foto));
            }
            $arquivo = $request->file('foto');
            $nomeArquivo = uniqid() . '-msflix.' . $arquivo->getClientOriginalExtension();
            $arquivo->move(public_path('produtos'), $nomeArquivo);
            $data['foto'] = 'produtos/' . $nomeArquivo;
        } else {
            $data['foto'] = $produto->foto;
        }

        $produto->update($data);

        return redirect()->route('gerenciador.produtos');
    }

    public function destroy($id){
        $produto = Produto::find($id);

         if ($produto->foto) {
            $foto = public_path($produto->foto);

            if (file_exists($foto)) {
                unlink($foto);
            }
        }

        $produto->delete();
        return redirect()->route('gerenciador.produtos');
    }
};
