# Modelo de Dados

---

# Tabela Users

| Campo | Tipo |
|------|------|
id | bigint
name | varchar
email | varchar
password | varchar
role | enum
created_at | timestamp

---

# Tabela Caregivers

| Campo | Tipo |
|------|------|
id | bigint
user_id | bigint
bio | text
min_price | decimal
rating | decimal

---

# Tabela Specialties

| Campo | Tipo |
|------|------|
id | bigint
name | varchar

---

# Tabela Caregiver_Specialties

| Campo | Tipo |
|------|------|
caregiver_id | bigint
specialty_id | bigint

---

# Tabela Proposals

| Campo | Tipo |
|------|------|
id | bigint
client_id | bigint
caregiver_id | bigint
description | text
address | varchar
date | datetime
price | decimal
status | varchar

---

# Tabela Payments

| Campo | Tipo |
|------|------|
id | bigint
proposal_id | bigint
amount | decimal
platform_fee | decimal
status | varchar

---

# Tabela Reviews

| Campo | Tipo |
|------|------|
id | bigint
client_id | bigint
caregiver_id | bigint
rating | int
comment | text
