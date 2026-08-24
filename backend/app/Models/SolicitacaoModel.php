<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Camada: MODEL
 * Responsabilidade: única e exclusivamente acessar o banco de dados.
 * Não contém regra de negócio — isso fica no Service.
 */
class SolicitacaoModel extends Model
{
    protected $table = 'solicitacoes';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'protocolo',
        'nome_solicitante',
        'cpf',
        'email',
        'tipo',
        'status',
        'criado_em',
    ];
}
