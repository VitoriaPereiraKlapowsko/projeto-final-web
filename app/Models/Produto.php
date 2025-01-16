<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'caminho', 'unidade_de_medida_id', 'categoria_id', 'quantidade', 'estoque', 'descricao', 'valor_unitario'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function unidadeDeMedida()
    {
        return $this->belongsTo(UnidadeDeMedida::class);
    }
}
