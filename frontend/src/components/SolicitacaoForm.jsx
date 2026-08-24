import { useState } from 'react';
import { criarSolicitacao } from '../services/api';

const TIPOS = [
  { valor: 'segunda_via_documento', label: 'Segunda via de documento' },
  { valor: 'agendamento_atendimento', label: 'Agendamento de atendimento' },
  { valor: 'certidao_negativa', label: 'Certidão negativa' },
];

export default function SolicitacaoForm({ aoCriar }) {
  const [dados, setDados] = useState({
    nome_solicitante: '',
    cpf: '',
    email: '',
    tipo: TIPOS[0].valor,
  });
  const [erro, setErro] = useState(null);
  const [enviando, setEnviando] = useState(false);

  function atualizarCampo(campo, valor) {
    setDados((anterior) => ({ ...anterior, [campo]: valor }));
  }

  async function handleSubmit(evento) {
    evento.preventDefault();
    setErro(null);
    setEnviando(true);

    try {
      const nova = await criarSolicitacao(dados);
      aoCriar(nova);
      setDados({ nome_solicitante: '', cpf: '', email: '', tipo: TIPOS[0].valor });
    } catch (e) {
      setErro(e.message);
    } finally {
      setEnviando(false);
    }
  }

  return (
    <form onSubmit={handleSubmit} className="solicitacao-form">
      <h2>Nova solicitação</h2>

      {erro && <p className="erro">{erro}</p>}

      <label>
        Nome completo
        <input
          type="text"
          value={dados.nome_solicitante}
          onChange={(e) => atualizarCampo('nome_solicitante', e.target.value)}
          required
        />
      </label>

      <label>
        CPF
        <input
          type="text"
          value={dados.cpf}
          onChange={(e) => atualizarCampo('cpf', e.target.value)}
          placeholder="000.000.000-00"
          required
        />
      </label>

      <label>
        E-mail
        <input
          type="email"
          value={dados.email}
          onChange={(e) => atualizarCampo('email', e.target.value)}
          required
        />
      </label>

      <label>
        Tipo de solicitação
        <select value={dados.tipo} onChange={(e) => atualizarCampo('tipo', e.target.value)}>
          {TIPOS.map((t) => (
            <option key={t.valor} value={t.valor}>
              {t.label}
            </option>
          ))}
        </select>
      </label>

      <button type="submit" disabled={enviando}>
        {enviando ? 'Enviando...' : 'Enviar solicitação'}
      </button>
    </form>
  );
}
