-- =====================================================
-- SCHEMA
-- =====================================================
CREATE DATABASE IF NOT EXISTS conecte
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE conecte;

-- =====================================================
-- TABLE: users
-- =====================================================
CREATE TABLE users (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  telefone VARCHAR(50) NOT NULL,
  cpf VARCHAR(20) NOT NULL UNIQUE,
  rg VARCHAR(30) NOT NULL,
  senha VARCHAR(255) NOT NULL,
  foto VARCHAR(255) NULL,
  role ENUM('client','caregiver') NOT NULL,

  email_verified_at TIMESTAMP NULL,
  remember_token VARCHAR(100) NULL,

  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  deleted_at TIMESTAMP NULL
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: clients
-- =====================================================
CREATE TABLE clients (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,

  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,

  CONSTRAINT fk_clients_user
    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: caregivers
-- =====================================================
CREATE TABLE caregivers (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  coren VARCHAR(100) NULL,
  certificado_cuidador VARCHAR(255) NULL,
  bio TEXT NULL,
  estrela INT DEFAULT 0,
  verificado BOOLEAN DEFAULT FALSE,

  user_id BIGINT UNSIGNED NOT NULL,

  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,

  CONSTRAINT fk_caregivers_user
    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: specialties
-- =====================================================
CREATE TABLE specialties (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL UNIQUE,
  descricao TEXT NOT NULL,

  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: caregiver_specialty (pivot)
-- =====================================================
CREATE TABLE caregiver_specialty (
  caregiver_id BIGINT UNSIGNED NOT NULL,
  specialty_id BIGINT UNSIGNED NOT NULL,

  preco_minimo DECIMAL(10,2) NOT NULL,

  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,

  PRIMARY KEY (caregiver_id, specialty_id),

  CONSTRAINT fk_cs_caregiver
    FOREIGN KEY (caregiver_id)
    REFERENCES caregivers(id)
    ON DELETE CASCADE,

  CONSTRAINT fk_cs_specialty
    FOREIGN KEY (specialty_id)
    REFERENCES specialties(id)
    ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: addresses
-- =====================================================
CREATE TABLE addresses (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

  numero VARCHAR(20) DEFAULT 's/n',
  logradouro VARCHAR(255) NOT NULL,
  bairro VARCHAR(255) NOT NULL,
  cidade VARCHAR(255) NOT NULL,
  cep VARCHAR(10) NOT NULL,
  estado CHAR(2) NOT NULL,

  latitude DECIMAL(10,7) NOT NULL,
  longitude DECIMAL(10,7) NOT NULL,

  user_id BIGINT UNSIGNED NOT NULL,

  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,

  CONSTRAINT fk_addresses_user
    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: proposals
-- =====================================================
CREATE TABLE proposals (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

  valor_servico DECIMAL(10,2) NOT NULL,

  data_inicio DATETIME NOT NULL,
  data_fim DATETIME NOT NULL,

  descricao_servico TEXT NOT NULL,
  endereco_servico VARCHAR(255) NOT NULL,

  status ENUM('pending','accepted','rejected','completed','cancelled')
  DEFAULT 'pending',

  estrela INT NULL,

  client_id BIGINT UNSIGNED NOT NULL,
  caregiver_id BIGINT UNSIGNED NOT NULL,

  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,

  CONSTRAINT fk_proposals_client
    FOREIGN KEY (client_id)
    REFERENCES clients(id)
    ON DELETE CASCADE,

  CONSTRAINT fk_proposals_caregiver
    FOREIGN KEY (caregiver_id)
    REFERENCES caregivers(id)
    ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: payments
-- =====================================================
CREATE TABLE payments (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

  proposal_id BIGINT UNSIGNED NOT NULL,

  amount DECIMAL(10,2) NOT NULL,
  platform_fee DECIMAL(10,2) NOT NULL,
  caregiver_amount DECIMAL(10,2) NOT NULL,

  status ENUM(
    'pending',
    'paid',
    'held',
    'released',
    'refunded',
    'canceled'
  ) NOT NULL,

  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,

  CONSTRAINT fk_payments_proposal
    FOREIGN KEY (proposal_id)
    REFERENCES proposals(id)
    ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLE: reviews
-- =====================================================
CREATE TABLE reviews (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

  proposal_id BIGINT UNSIGNED NOT NULL,
  reviewer_id BIGINT UNSIGNED NOT NULL,
  reviewed_id BIGINT UNSIGNED NOT NULL,

  avaliacao TINYINT NOT NULL,
  comentario TEXT NULL,

  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,

  CONSTRAINT fk_reviews_proposal
    FOREIGN KEY (proposal_id)
    REFERENCES proposals(id)
    ON DELETE CASCADE,

  CONSTRAINT fk_reviews_reviewer
    FOREIGN KEY (reviewer_id)
    REFERENCES users(id)
    ON DELETE CASCADE,

  CONSTRAINT fk_reviews_reviewed
    FOREIGN KEY (reviewed_id)
    REFERENCES users(id)
    ON DELETE CASCADE,

  UNIQUE (proposal_id, reviewer_id)
) ENGINE=InnoDB;
