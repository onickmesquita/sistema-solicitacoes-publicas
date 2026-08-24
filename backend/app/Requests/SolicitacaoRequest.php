<?php

namespace App\Requests;

/**
 * Camada: REQUEST
 * Responsabilidade: validar e sanitizar os dados de entrada ANTES de
 * chegarem ao Service. Isolar a validação aqui evita que regra de
 * negócio e validação de input se misturem no Controller.
 */
class SolicitacaoRequest
{
    private array $dados;
    private array $erros = [];
    private array $tiposPermitidos = [
        'segunda_via_documento',
        'agendamento_atendimento',
        'certidao_negativa',
    ];

    public function __construct(array $dados)
    {
        $this->dados = $dados;
    }

    public function validar(): bool
    {
        $this->erros = [];

        if (empty($this->dados['nome_solicitante']) || mb_strlen($this->dados['nome_solicitante']) < 3) {
            $this->erros['nome_solicitante'] = 'Informe o nome completo (mínimo 3 caracteres).';
        }

        if (empty($this->dados['cpf']) || ! $this->cpfValido($this->dados['cpf'])) {
            $this->erros['cpf'] = 'CPF inválido.';
        }

        if (empty($this->dados['tipo']) || ! in_array($this->dados['tipo'], $this->tiposPermitidos, true)) {
            $this->erros['tipo'] = 'Tipo de solicitação inválido.';
        }

        if (empty($this->dados['email']) || ! filter_var($this->dados['email'], FILTER_VALIDATE_EMAIL)) {
            $this->erros['email'] = 'E-mail inválido.';
        }

        return empty($this->erros);
    }

    public function validarAtualizacaoStatus(): bool
    {
        $this->erros = [];
        $statusPermitidos = ['em_analise', 'aprovada', 'rejeitada', 'concluida'];

        if (empty($this->dados['status']) || ! in_array($this->dados['status'], $statusPermitidos, true)) {
            $this->erros['status'] = 'Status inválido.';
        }

        return empty($this->erros);
    }

    private function cpfValido(string $cpf): bool
    {
        $cpf = preg_replace('/\D/', '', $cpf);

        return strlen($cpf) === 11;
    }

    public function getDadosValidados(): array
    {
        return $this->dados;
    }

    public function getErros(): array
    {
        return $this->erros;
    }
}
