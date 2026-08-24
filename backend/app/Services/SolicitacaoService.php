<?php

namespace App\Services;

use App\Models\SolicitacaoModel;

/**
 * Camada: SERVICE
 * Responsabilidade: concentrar a REGRA DE NEGÓCIO (ex: gerar protocolo,
 * definir status inicial, checar transições de status válidas).
 * O Controller nunca fala diretamente com o Model — sempre passa por aqui.
 * Isso segue o princípio de Inversão de Dependência (SOLID) e facilita
 * testes unitários, já que a regra de negócio fica isolada do HTTP e do BD.
 */
class SolicitacaoService
{
    private SolicitacaoModel $model;

    public function __construct()
    {
        $this->model = new SolicitacaoModel();
    }

    public function listarTodas(): array
    {
        return $this->model->orderBy('criado_em', 'DESC')->findAll();
    }

    public function buscarPorId(int $id): ?array
    {
        return $this->model->find($id);
    }

    public function criar(array $dados): array
    {
        $dados['protocolo'] = $this->gerarProtocolo();
        $dados['status'] = 'em_analise';
        $dados['criado_em'] = date('Y-m-d H:i:s');

        $id = $this->model->insert($dados, true);

        return $this->model->find($id);
    }

    public function atualizarStatus(int $id, array $dados): ?array
    {
        $solicitacao = $this->model->find($id);

        if (! $solicitacao) {
            return null;
        }

        $this->model->update($id, ['status' => $dados['status']]);

        return $this->model->find($id);
    }

    public function cancelar(int $id): bool
    {
        $solicitacao = $this->model->find($id);

        if (! $solicitacao) {
            return false;
        }

        return $this->model->delete($id);
    }

    /**
     * Gera um número de protocolo fictício no formato ANO-XXXXXX.
     */
    private function gerarProtocolo(): string
    {
        return date('Y') . '-' . str_pad((string) random_int(1, 999999), 6, '0', STR_PAD_LEFT);
    }
}
