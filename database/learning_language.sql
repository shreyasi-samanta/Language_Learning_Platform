CREATE DATABASE language_learning;
USE language_learning;

-- =========================================
-- USERS TABLE
-- =========================================

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================
-- LANGUAGES TABLE
-- =========================================

CREATE TABLE languages (
    language_id INT AUTO_INCREMENT PRIMARY KEY,
    language_name VARCHAR(50) NOT NULL,
    description TEXT
);

-- =========================================
-- LESSONS TABLE
-- =========================================

CREATE TABLE lessons (
    lesson_id INT AUTO_INCREMENT PRIMARY KEY,
    language_id INT NOT NULL,
    lesson_title VARCHAR(255) NOT NULL,
    lesson_type ENUM('Vocabulary','Grammar','Reading') NOT NULL,
    content TEXT NOT NULL,

    FOREIGN KEY (language_id)
    REFERENCES languages(language_id)
    ON DELETE CASCADE
);

-- =========================================
-- QUIZ QUESTIONS TABLE
-- =========================================

CREATE TABLE quiz_questions (
    question_id INT AUTO_INCREMENT PRIMARY KEY,
    language_id INT NOT NULL,

    question TEXT NOT NULL,

    option_a VARCHAR(255) NOT NULL,
    option_b VARCHAR(255) NOT NULL,
    option_c VARCHAR(255) NOT NULL,
    option_d VARCHAR(255) NOT NULL,

    correct_answer ENUM('A','B','C','D') NOT NULL,

    FOREIGN KEY (language_id)
    REFERENCES languages(language_id)
    ON DELETE CASCADE
);

-- =========================================
-- QUIZ RESULTS TABLE
-- =========================================

CREATE TABLE quiz_results (
    result_id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,
    language_id INT NOT NULL,

    score INT NOT NULL,
    total_questions INT NOT NULL,

    attempt_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id)
    REFERENCES users(user_id)
    ON DELETE CASCADE,

    FOREIGN KEY (language_id)
    REFERENCES languages(language_id)
    ON DELETE CASCADE
);

-- =========================================
-- PROGRESS TABLE
-- =========================================

CREATE TABLE progress (
    progress_id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,
    lesson_id INT NOT NULL,

    status ENUM('Pending','Completed') DEFAULT 'Pending',

    completion_date DATETIME NULL,

    FOREIGN KEY (user_id)
    REFERENCES users(user_id)
    ON DELETE CASCADE,

    FOREIGN KEY (lesson_id)
    REFERENCES lessons(lesson_id)
    ON DELETE CASCADE
);

-- =========================================
-- LEADERBOARD TABLE
-- =========================================

CREATE TABLE leaderboard (
    leaderboard_id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,
    total_score INT DEFAULT 0,

    FOREIGN KEY (user_id)
    REFERENCES users(user_id)
    ON DELETE CASCADE
);