<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function index()
    {
        $query = Admin::query();

        $admins = $query->orderByDesc('created_at')->paginate(9);

        return view('gerenciador-admins', [
            'admins' => $admins,
        ]);
    }

    public function show($id)
    {
        $admin = Admin::where('id', $id)->first();

        return view('admin-show', [
            'admin' => $admin,
        ]);
    }

    public function create()
    {
        return view('create-admin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'cep' => ['required', 'string', 'max:20'],
            'logradouro' => ['required', 'string', 'max:255'],
            'bairro' => ['required', 'string', 'max:255'],
            'cidade' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', 'max:2'],
            'telefone' => ['required', 'string', 'max:25'],
            'data_de_nascimento'=> ['required', 'date'],
            'cpf' => ['required', 'string', 'max:11'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        $admin = new Admin();
        if ($request->hasFile('foto')) {
            $arquivo = $request->file('foto');
            $nomeArquivo = uniqid() . '-msflix' . $arquivo->getClientOriginalExtension();
            $arquivo->move(public_path('admin'), $nomeArquivo);

            $admin->foto = 'admin/' . $nomeArquivo;
        } else {
            $admin->foto = null;
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->cep = $request->cep;
        $admin->logradouro = $request->logradouro;
        $admin->bairro = $request->bairro;
        $admin->cidade = $request->cidade;
        $admin->estado = $request->estado;
        $admin->telefone = $request->telefone;
        $admin->data_de_nascimento = $request->data_de_nascimento;
        $admin->cpf = $request->cpf;
        $admin->criado_por_id = Auth::id();

        $admin->save();

         return redirect()->route('gerenciador.admins')->with('success', 'Administrador criado com sucesso!');

        return redirect()->back()->withInput()->with('error', 'Ocorreu um erro ao criar o administrador. Por favor, tente novamente.');
    }
}

