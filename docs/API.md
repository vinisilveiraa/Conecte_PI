# API Documentation

Base URL

---

# Autenticação

## POST /register

Cria novo usuário.

### Request
{
"name": "João",
"email": "joao@email.com
",
"password": "123456"
}

---

## POST /login

Realiza login.

---

# Usuários

## GET /users/me

Retorna dados do usuário logado.

---

# Cuidadores

## GET /caregivers

Lista cuidadores disponíveis.

---

## GET /caregivers/{id}

Detalhes do cuidador.

---

# Propostas

## POST /proposals

Envia proposta para cuidador.

---

## GET /proposals

Lista propostas do usuário.

---

# Chat

## GET /chat/{proposal_id}

Retorna histórico do chat.

---

# Pagamentos

## POST /payments

Realiza pagamento.

---

# Avaliações

## POST /reviews

Cria avaliação.
