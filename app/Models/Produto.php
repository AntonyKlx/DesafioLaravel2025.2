<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Categoria;
use App\Models\User;

class Produto extends Model
{

    use HasFactory;
    protected $table = 'produto';
    protected $primaryKey = 'id';

    protected $fillable = [
        'foto',
        'nome',
        'preco',
        'descricao',
        'quantidade',
        'categoria_id',
        'anunciante_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id_categoria');
    }

     public function user()
    {
        return $this->belongsTo(User::class, 'anunciante_id');
    }

}
