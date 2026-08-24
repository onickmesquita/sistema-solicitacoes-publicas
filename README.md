# Sistema de Solicitações Públicas (Demo)

> ⚠️ **Projeto fictício de portfólio.** Recriado do zero, com dados e nomes inventados, para demonstrar a mesma arquitetura e stack utilizadas em um sistema real de estágio (setor público), sem reutilizar nenhum código ou informação daquele projeto.

## 🎯 Objetivo

Sistema onde um cidadão fictício pode abrir, listar e acompanhar "solicitações" (ex: pedidos de documentos, agendamentos) junto a um órgão público. O foco do projeto é demonstrar:

- Arquitetura em camadas no backend (Route → Controller → Request → Service → Model)
- Validação de formulários no frontend e backend
- Integração PHP (API) + React (SPA)
- Princípios SOLID aplicados na prática

## 🏗️ Arquitetura

```
Requisição HTTP
      │
      ▼
   [Route]        →  define o endpoint e método HTTP
      │
      ▼
 [Controller]      →  recebe a requisição, delega validação e chama o Service
      │
      ▼
  [Request]        →  valida e sanitiza os dados de entrada
      │
      ▼
  [Service]        →  contém a regra de negócio (ex: gerar protocolo, checar status)
      │
      ▼
   [Model]         →  acessa o banco de dados (MySQL)
```

Essa separação segue o princípio de **Responsabilidade Única (SRP)**: cada camada faz uma coisa só, o que facilita manutenção, testes e onboarding de outros devs.

## 🛠️ Stack

**Backend:** PHP 8 + CodeIgniter 4, MySQL
**Frontend:** React + Vite

## 📁 Estrutura do repositório

```
sistema-solicitacoes-publicas/
├── backend/
│   └── app/
│       ├── Config/Routes.php
│       ├── Controllers/SolicitacaoController.php
│       ├── Requests/SolicitacaoRequest.php
│       ├── Services/SolicitacaoService.php
│       ├── Models/SolicitacaoModel.php
│       └── Database/Migrations/CreateSolicitacoesTable.php
└── frontend/
    └── src/
        ├── App.jsx
        ├── components/SolicitacaoForm.jsx
        ├── components/SolicitacaoList.jsx
        └── services/api.js
```

## 🚀 Como rodar (ambiente local)

**Backend** (requer PHP 8+, Composer e CodeIgniter 4 instalados):
```bash
cd backend
composer install
php spark migrate
php spark serve
```

**Frontend:**
```bash
cd frontend
npm install
npm run dev
```

## 📌 Próximos passos (roadmap DevSecOps)

- [ ] Adicionar autenticação (JWT)
- [ ] Dockerfile para backend e frontend
- [ ] Pipeline CI/CD (GitHub Actions): lint + testes automáticos a cada push
- [ ] Análise estática de segurança (ex: PHPStan + dependency check)
