<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = ['nome_produto', 'valor_produto', 'cod_marca', 'estoque', 'cod_cidade'];

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'cod_marca');
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cod_cidade');
    }
}
