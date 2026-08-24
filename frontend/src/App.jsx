import { useEffect, useState } from 'react';
import SolicitacaoForm from './components/SolicitacaoForm';
import SolicitacaoList from './components/SolicitacaoList';
import { listarSolicitacoes } from './services/api';

export default function App() {
  const [solicitacoes, setSolicitacoes] = useState([]);
  const [carregando, setCarregando] = useState(true);

  useEffect(() => {
    carregarSolicitacoes();
  }, []);

  async function carregarSolicitacoes() {
    try {
      const dados = await listarSolicitacoes();
      setSolicitacoes(dados);
    } catch (e) {
      console.error(e);
    } finally {
      setCarregando(false);
    }
  }

  function handleNovaSolicitacao(nova) {
    setSolicitacoes((anteriores) => [nova, ...anteriores]);
  }

  return (
    <div className="app">
      <header>
        <h1>Sistema de Solicitações Públicas</h1>
        <p className="disclaimer">Projeto fictício de portfólio — dados de demonstração.</p>
      </header>

      <main>
        <SolicitacaoForm aoCriar={handleNovaSolicitacao} />
        <section>
          <h2>Solicitações registradas</h2>
          {carregando ? <p>Carregando...</p> : <SolicitacaoList solicitacoes={solicitacoes} />}
        </section>
      </main>
    </div>
  );
}
