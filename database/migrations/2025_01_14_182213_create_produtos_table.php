<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id(); 
            $table->string('nome');  
            $table->string('caminho'); 
            $table->foreignId('unidade_de_medida_id')->constrained('unidades_de_medida')->onDelete('cascade');  
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade'); 
            $table->integer('quantidade');  
            $table->integer('estoque'); 
            $table->text('descricao');  
            $table->decimal('valor_unitario', 10, 2); 
            $table->timestamps(); 
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
