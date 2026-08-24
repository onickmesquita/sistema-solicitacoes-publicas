<?php

namespace App\Controllers;

use App\Requests\SolicitacaoRequest;
use App\Services\SolicitacaoService;
use CodeIgniter\RESTful\ResourceController;

/**
 * Camada: CONTROLLER
 * Responsabilidade: orquestrar a requisição — recebe input, delega validação
 * ao Request, delega regra de negócio ao Service e formata a resposta.
 * Não acessa o banco diretamente e não contém lógica de negócio.
 */
class SolicitacaoController extends ResourceController
{
    protected SolicitacaoService $service;

    public function __construct()
    {
        $this->service = new SolicitacaoService();
    }

    public function index()
    {
        $solicitacoes = $this->service->listarTodas();

        return $this->respond($solicitacoes, 200);
    }

    public function show($id = null)
    {
        $solicitacao = $this->service->buscarPorId((int) $id);

        if (! $solicitacao) {
            return $this->failNotFound('Solicitação não encontrada.');
        }

        return $this->respond($solicitacao, 200);
    }

    public function create()
    {
        $request = new SolicitacaoRequest($this->request->getJSON(true));

        if (! $request->validar()) {
            return $this->failValidationErrors($request->getErros());
        }

        $novaSolicitacao = $this->service->criar($request->getDadosValidados());

        return $this->respondCreated($novaSolicitacao);
    }

    public function update($id = null)
    {
        $request = new SolicitacaoRequest($this->request->getJSON(true));

        if (! $request->validarAtualizacaoStatus()) {
            return $this->failValidationErrors($request->getErros());
        }

        $atualizada = $this->service->atualizarStatus((int) $id, $request->getDadosValidados());

        if (! $atualizada) {
            return $this->failNotFound('Solicitação não encontrada.');
        }

        return $this->respond($atualizada, 200);
    }

    public function delete($id = null)
    {
        $sucesso = $this->service->cancelar((int) $id);

        if (! $sucesso) {
            return $this->failNotFound('Solicitação não encontrada.');
        }

        return $this->respondDeleted(['id' => $id]);
    }
}
