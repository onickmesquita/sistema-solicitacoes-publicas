const API_URL = 'http://localhost:8080/api/solicitacoes';

export async function listarSolicitacoes() {
  const resposta = await fetch(API_URL);
  if (!resposta.ok) throw new Error('Erro ao buscar solicitações.');
  return resposta.json();
}

export async function criarSolicitacao(dados) {
  const resposta = await fetch(API_URL, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(dados),
  });

  if (!resposta.ok) {
    const erro = await resposta.json();
    throw new Error(erro.messages?.error || 'Erro ao criar solicitação.');
  }

  return resposta.json();
}

export async function atualizarStatus(id, status) {
  const resposta = await fetch(`${API_URL}/${id}`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ status }),
  });

  if (!resposta.ok) throw new Error('Erro ao atualizar status.');
  return resposta.json();
}
