# Software Requirements Specification

## Plataforma de Conexão de Cuidadores

Versão: 1.0

---

# 1 Introdução

Este documento descreve os requisitos da plataforma de conexão entre **clientes e cuidadores profissionais**.

---

# 2 Atores

## Cliente

Usuário que contrata cuidadores.

## Cuidador

Profissional que presta serviço de cuidado.

## Administrador

Responsável pela gestão da plataforma.

---

# 3 Requisitos Funcionais

## RF01 Cadastro de Usuários

O sistema deve permitir cadastro de:

- Clientes
- Cuidadores

---

## RF02 Perfil do Cuidador

O cuidador pode cadastrar:

- especialidades
- experiência
- valor mínimo
- descrição profissional

---

## RF03 Busca de Profissionais

O cliente deve poder buscar profissionais filtrando por:

- proximidade
- especialidade
- avaliação
- preço

---

## RF04 Envio de Proposta

A proposta deve conter:

- descrição do paciente
- endereço
- data
- horário
- valor

---

## RF05 Notificações

O cuidador deve receber:

- notificação em tempo real
- notificação por email

---

## RF06 Aceite ou Recusa

O cuidador pode:

- aceitar proposta
- recusar proposta

---

## RF07 Chat

Após o aceite deve ser liberado chat entre cliente e cuidador.

---

## RF08 Pagamento

Pagamento deve ocorrer via Stripe.

Métodos:

- cartão
- pix

---

## RF09 Escrow

Pagamento fica bloqueado até finalização do serviço.

---

## RF10 Avaliação

Após o serviço:

- cliente avalia cuidador
- cuidador avalia cliente

---

# 4 Requisitos Não Funcionais

## Performance

Tempo máximo de resposta:

2 segundos

## Disponibilidade

Uptime mínimo:

99.9%

## Segurança

- criptografia de senha
- HTTPS obrigatório
- proteção contra SQL Injection
- proteção contra XSS

---

# 5 Regras de Negócio

## Taxa da Plataforma

## Liberação de pagamento

Pagamento liberado após:

24 horas
