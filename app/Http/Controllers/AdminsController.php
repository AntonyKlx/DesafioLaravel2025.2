<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'email' => ['required', 'string', 'max:255', 'unique:admins,email'],
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
            $admin->foto = 'images/PerfilDefault.png';
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
        $admin->criado_por_id = Auth::guard('adm')->id();

        $admin->save();

         return redirect()->route('gerenciador.admins');
    }

    public function edit(Admin $admin)
    {
        return view('edit-admin', [
            'admin' => $admin,
        ]);
    }

    public function update(Request $request, Admin $admin)
    {
        if($admin->id != Auth::id() && $admin->criado_por_id != Auth::id()){
            return redirect()->route('gerenciador.admins');
        }

        $validatedData = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255', Rule::unique('admins', 'email')->ignore($admin->id),],
            'password' => ['nullable', 'string', 'max:255'],
            'cep' => ['nullable', 'string', 'max:20'],
            'logradouro' => ['nullable', 'string', 'max:255'],
            'bairro' => ['nullable', 'string', 'max:255'],
            'cidade' => ['nullable', 'string', 'max:255'],
            'estado' => ['nullable', 'string', 'max:2'],
            'telefone' => ['nullable', 'string', 'max:25'],
            'data_de_nascimento'=> ['nullable', 'date'],
            'cpf' => ['nullable', 'string', 'max:11'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

         if (empty($validatedData['password'])) {
            unset($validatedData['password']);
        } else {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $data = $validatedData;

        if ($request->hasFile('foto')) {
            if ($admin->foto && file_exists(public_path($admin->foto))) {
                unlink(public_path($admin->foto));
            }
            $arquivo = $request->file('foto');
            $nomeArquivo = uniqid() . '-msflix.' . $arquivo->getClientOriginalExtension();
            $arquivo->move(public_path('admin'), $nomeArquivo);
            $data['foto'] = 'admin/' . $nomeArquivo;
        } else {
            $data['foto'] = $admin->foto;
        }

        $admin->update($data);

        return redirect()->route('gerenciador.admins');
    }

    public function destroy($id){
        $admin = Admin::find($id);

         if ($admin->foto) {
            $foto = public_path($admin->foto);

            if (file_exists($foto)) {
                unlink($foto);
            }
        }

        $admin->delete();
        return redirect()->route('gerenciador.admins');
    }
}

