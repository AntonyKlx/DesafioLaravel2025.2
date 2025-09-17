<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

    }
}
