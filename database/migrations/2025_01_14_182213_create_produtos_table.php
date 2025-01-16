<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();  // Cria o ID do produto
            $table->string('nome');  // Nome do produto
            $table->string('caminho'); // Para o caminho ou URL da imagem
            $table->foreignId('unidade_de_medida_id')->constrained('unidades_de_medida')->onDelete('cascade');  // Chave estrangeira para a unidade de medida
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');  // Chave estrangeira para a categoria
            $table->integer('quantidade');  // Quantidade do produto
            $table->integer('estoque');  // Estoque do produto
            $table->text('descricao');  // Descrição do produto
            $table->decimal('valor_unitario', 10, 2);  // Valor unitário do produto
            $table->timestamps();  // Campos created_at e updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
