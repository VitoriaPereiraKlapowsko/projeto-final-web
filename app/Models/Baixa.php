<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baixa extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'produto_id', 'quantidade', 'valor_total', 'data_hora'];

    public function cliente()
    {
        // O método belongsTo indica que este modelo "Baixa" pertence ao modelo "Cliente"
        return $this->belongsTo(Cliente::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
