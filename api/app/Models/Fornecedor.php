<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'fornecedor';

    protected $fillable = [
        'nome',
        'cpf_cnpj',
        'contato',
        'endereco',
        'tipo_servico',
        'representante',
    ];
}
