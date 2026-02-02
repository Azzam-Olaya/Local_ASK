-- Création de la base de données
CREATE DATABASE Local_ASK;

-- Se connecter à la base de données
\c Local_ASK;


-- =========================
-- TABLE users
-- =========================
CREATE TABLE users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL CHECK (role IN ('admin', 'user')),
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- =========================
-- TABLE questions
-- =========================
CREATE TABLE questions (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,

    -- localisation
    city VARCHAR(100) NOT NULL,
    latitude DECIMAL(9,6) NOT NULL,
    longitude DECIMAL(9,6) NOT NULL,

    user_id BIGINT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_questions_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
);

-- =========================
-- TABLE responses
-- =========================
CREATE TABLE responses (
    id BIGSERIAL PRIMARY KEY,
    body TEXT NOT NULL,
    user_id BIGINT NOT NULL,
    question_id BIGINT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_responses_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_responses_question
        FOREIGN KEY (question_id)
        REFERENCES questions(id)
        ON DELETE CASCADE
);

-- =========================
-- TABLE favorites
-- =========================
CREATE TABLE favorites (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL,
    question_id BIGINT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_favorites_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_favorites_question
        FOREIGN KEY (question_id)
        REFERENCES questions(id)
        ON DELETE CASCADE,

    CONSTRAINT unique_favorite UNIQUE (user_id, question_id)
);
