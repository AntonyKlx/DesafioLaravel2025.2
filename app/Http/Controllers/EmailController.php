<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\EnviaEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        return view('enviar-email', [
            'user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_email' => ['required', 'email', 'exists:users,email'],
            'conteudo' => ['required', 'string', 'min:5'],
        ]);

        $destinatario = User::where('email', $request->input('user_email'))->first();
        if ($destinatario) {
            Mail::to($destinatario->email)->send(new EnviaEmail($request->input('conteudo')));
            return redirect()->back()->with('success', 'Email enviado!');
        }
    }
}
