const STATUS_LABEL = {
  em_analise: 'Em análise',
  aprovada: 'Aprovada',
  rejeitada: 'Rejeitada',
  concluida: 'Concluída',
};

export default function SolicitacaoList({ solicitacoes }) {
  if (solicitacoes.length === 0) {
    return <p>Nenhuma solicitação cadastrada ainda.</p>;
  }

  return (
    <table className="solicitacao-list">
      <thead>
        <tr>
          <th>Protocolo</th>
          <th>Solicitante</th>
          <th>Tipo</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        {solicitacoes.map((s) => (
          <tr key={s.id}>
            <td>{s.protocolo}</td>
            <td>{s.nome_solicitante}</td>
            <td>{s.tipo}</td>
            <td>
              <span className={`status status-${s.status}`}>
                {STATUS_LABEL[s.status] || s.status}
              </span>
            </td>
          </tr>
        ))}
      </tbody>
    </table>
  );
}
