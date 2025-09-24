<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    public function index()
    {
        $query = User::query();

        if(isAdminLoggedIn()){
            $users = $query->orderByDesc('created_at')->paginate(9);
        } else {
            //$users = User::where()
        }

        return view('gerenciador-usuarios', [
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();

        return view('user-show', [
            'user' => $user,
        ]);
    }

    public function create()
    {
        return view('create-user');
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
            'complemento' => ['required', 'string', 'max:255'],
            'telefone' => ['required', 'string', 'max:25'],
            'data_de_nascimento'=> ['required', 'date'],
            'cpf' => ['required', 'string', 'max:11'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        $user = new User();
        if ($request->hasFile('foto')) {
            $arquivo = $request->file('foto');
            $nomeArquivo = uniqid() . '-msflix' . $arquivo->getClientOriginalExtension();
            $arquivo->move(public_path('user'), $nomeArquivo);

            $user->foto = 'user/' . $nomeArquivo;
        } else {
            $user->foto = null;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->cep = $request->cep;
        $user->logradouro = $request->logradouro;
        $user->bairro = $request->bairro;
        $user->cidade = $request->cidade;
        $user->estado = $request->estado;
        $user->complemento = $request->complemento;
        $user->telefone = $request->telefone;
        $user->data_de_nascimento = $request->data_de_nascimento;
        $user->cpf = $request->cpf;
        $user->saldo = 0;

        $user->save();

        return redirect()->route('gerenciador.usuarios');
    }

    public function edit(User $user)
    {
        return view('edit-user', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'max:255'],
            'cep' => ['nullable', 'string', 'max:20'],
            'logradouro' => ['nullable', 'string', 'max:255'],
            'bairro' => ['nullable', 'string', 'max:255'],
            'cidade' => ['nullable', 'string', 'max:255'],
            'estado' => ['nullable', 'string', 'max:2'],
            'complemento' => ['nullable', 'string', 'max:255'],
            'telefone' => ['nullable', 'string', 'max:25'],
            'data_de_nascimento'=> ['nullable', 'date'],
            'cpf' => ['nullable', 'string', 'max:11'],
            'saldo' => ['nullable', 'numeric', 'min:0'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = $validatedData;

        if ($request->hasFile('foto')) {
            if ($user->foto && file_exists(public_path($user->foto))) {
                unlink(public_path($user->foto));
            }
            $arquivo = $request->file('foto');
            $nomeArquivo = uniqid() . '-msflix.' . $arquivo->getClientOriginalExtension();
            $arquivo->move(public_path('user'), $nomeArquivo);
            $data['foto'] = 'user/' . $nomeArquivo;
        } else {
            $data['foto'] = $user->foto;
        }

        $user->update($data);

        return redirect()->route('gerenciador.usuarios');
    }

    public function destroy($id){
        $user = User::find($id);

         if ($user->foto) {
            $foto = public_path($user->foto);

            if (file_exists($foto)) {
                unlink($foto);
            }
        }

        $user->delete();
        return redirect()->route('gerenciador.usuarios');
    }
}
