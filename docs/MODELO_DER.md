# DER — Diagrama Entidade Relacionamento

## Plataforma de Conexão de Cuidadores

Este documento descreve o **modelo conceitual de dados** da plataforma responsável por conectar clientes e cuidadores profissionais.

O modelo foi projetado para suportar:

- cadastro de usuários
- cadastro de cuidadores
- especialidades
- propostas de serviço
- pagamentos
- avaliações
- comunicação via chat

---

# 1. Entidades do Sistema

As principais entidades do sistema são:

- Users
- Clients
- Caregivers
- Specialties
- CaregiverSpecialties
- Proposals
- Payments
- Reviews
- Addresses
- Messages

---

# 2. Entidade Users

Representa todos os usuários do sistema.

## Atributos

| Campo | Tipo | Descrição |
|------|------|-----------|
id | bigint | identificador único
name | varchar | nome do usuário
email | varchar | email único
password | varchar | senha criptografada
phone | varchar | telefone
role | enum | client ou caregiver
created_at | timestamp | data de criação
updated_at | timestamp | data de atualização

## Chave Primária
PK: id

---

# 3. Entidade Clients

Representa usuários que contratam serviços.

## Atributos

| Campo | Tipo |
|------|------|
id | bigint
user_id | bigint

## Chaves
PK: id
FK: user_id → users.id

---

# 4. Entidade Caregivers

Representa profissionais cuidadores.

## Atributos

| Campo | Tipo |
|------|------|
id | bigint
user_id | bigint
bio | text
min_price | decimal
rating | decimal
verified | boolean

## Chaves
PK: id
FK: user_id → users.id

---

# 5. Entidade Specialties

Lista de especialidades dos cuidadores.

Exemplos:

- cuidador de idosos
- técnico de enfermagem
- cuidados paliativos
- acompanhante hospitalar

## Atributos

| Campo | Tipo |
|------|------|
id | bigint
name | varchar

## Chaves
PK: id

---

# 6. Entidade CaregiverSpecialties

Tabela de relacionamento entre cuidadores e especialidades.

Um cuidador pode possuir várias especialidades.

## Atributos

| Campo | Tipo |
|------|------|
caregiver_id | bigint
specialty_id | bigint

## Chaves
PK: caregiver_id, specialty_id
FK: caregiver_id → caregivers.id
FK: specialty_id → specialties.id

---

# 7. Entidade Addresses

Endereços de usuários.

## Atributos

| Campo | Tipo |
|------|------|
id | bigint
user_id | bigint
street | varchar
number | varchar
city | varchar
state | varchar
zipcode | varchar
latitude | decimal
longitude | decimal

## Chaves
PK: id
FK: user_id → users.id

---

# 8. Entidade Proposals

Representa propostas enviadas por clientes para cuidadores.

## Atributos

| Campo | Tipo |
|------|------|
id | bigint
client_id | bigint
caregiver_id | bigint
description | text
address | varchar
service_date | datetime
price | decimal
status | enum
created_at | timestamp

## Status possíveis

- pending
- accepted
- rejected
- completed
- cancelled

## Chaves
PK: id
FK: client_id → clients.id
FK: caregiver_id → caregivers.id

---

# 9. Entidade Payments

Representa pagamentos realizados na plataforma.

## Atributos

| Campo | Tipo |
|------|------|
id | bigint
proposal_id | bigint
amount | decimal
platform_fee | decimal
caregiver_amount | decimal
status | enum
created_at | timestamp

## Status

- pending
- escrow
- released
- refunded

## Chaves
PK: id
FK: proposal_id → proposals.id

---

# 10. Entidade Reviews

Avaliações entre clientes e cuidadores.

## Atributos

| Campo | Tipo |
|------|------|
id | bigint
proposal_id | bigint
reviewer_id | bigint
reviewed_id | bigint
rating | int
comment | text
created_at | timestamp

## Chaves
PK: id
FK: proposal_id → proposals.id
FK: reviewer_id → users.id
FK: reviewed_id → users.id

---

# 11. Entidade Messages (MongoDB)

As mensagens do chat serão armazenadas em **MongoDB**.

Estrutura do documento:
{
_id: ObjectId,
proposal_id: number,
sender_id: number,
message: string,
created_at: datetime
}

---

# 12. Relacionamentos

## Users → Clients
1 : 1

Um usuário pode ser um cliente.

---

## Users → Caregivers
1 : 1

Um usuário pode ser um cuidador.

---

## Caregivers → Specialties
N : N

Um cuidador pode ter várias especialidades.

---

## Clients → Proposals
1 : N

Um cliente pode criar várias propostas.

---

## Caregivers → Proposals
1 : N

Um cuidador pode receber várias propostas.

---

## Proposals → Payments
1 : 1

Cada proposta possui um pagamento associado.

---

## Proposals → Reviews
1 : N

Uma proposta pode gerar avaliações.

---

# 13. Modelo Conceitual Final

Resumo das entidades:
Users
├── Clients
├── Caregivers
│ └── CaregiverSpecialties
│ └── Specialties
│
├── Addresses
│
└── Reviews

Clients
└── Proposals
└── Payments
└── Messages (MongoDB)

---

# 14. Observações de Projeto

Decisões importantes:

1. **Users centraliza autenticação**
2. **Clients e Caregivers especializam usuários**
3. **Chat separado em MongoDB**
4. **Pagamentos vinculados a propostas**
5. **Sistema preparado para crescimento**

---

# 15. Evoluções Futuras

Possíveis novas entidades:

- video_calls
- disputes
- emergency_requests
- subscriptions
- insurance

