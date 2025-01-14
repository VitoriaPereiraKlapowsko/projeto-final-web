<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = ['cliente_id', 'cep', 'rua', 'bairro', 'cidade', 'estado', 'numero', 'complemento'];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
