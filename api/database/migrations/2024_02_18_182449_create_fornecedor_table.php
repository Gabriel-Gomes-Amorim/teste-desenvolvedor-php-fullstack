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
        Schema::create('fornecedor', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome')->nullable(false);
            $table->string('cpf_cnpj')->unique()->nullable(false);
            $table->string('contato')->nullable(false);
            $table->string('endereco')->nullable(false);
            $table->string('tipo_servico')->nullable(false);
            $table->string('representante')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedor');
    }
};
