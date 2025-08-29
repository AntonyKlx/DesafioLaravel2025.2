<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'adm';

    protected $primaryKey = 'id_adm';


    protected $fillable = [
        'nome',
        'email',
        'senha',
        'cep',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'complemento',
        'telefone',
        'data_de_nascimento',
        'cpf',
        'foto',
    ];

    protected $hidden = [
        'senha',
    ];

    protected $casts = [
        'data_de_nascimento' => 'date',
    ];
}
