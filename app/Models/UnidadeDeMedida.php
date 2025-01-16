<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadeDeMedida extends Model
{
    use HasFactory;
    protected $table = 'unidades_de_medida';
    protected $fillable = ['abreviatura', 'descricao'];
}
