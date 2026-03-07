# Arquitetura do Sistema

---

# Visão Geral

A aplicação seguirá arquitetura **cliente-servidor** com separação entre frontend e backend.

---

# Camadas do Sistema

---

# Frontend

Responsável por:

- interface do usuário
- consumo da API
- notificações em tempo real

Tecnologias:

- React
- Typescript

---

# Backend

Responsável por:

- lógica de negócio
- autenticação
- gerenciamento de pagamentos
- comunicação entre usuários

Tecnologia:

Laravel

---

# Banco de Dados

## MySQL

Armazena:

- usuários
- propostas
- pagamentos
- avaliações

## MongoDB

Armazena:

- mensagens de chat
- histórico de comunicação

---

# Serviços Externos

## Stripe

Processamento de pagamento.

---

# Comunicação em Tempo Real

Tecnologia recomendada:

- WebSockets
- Laravel Echo
