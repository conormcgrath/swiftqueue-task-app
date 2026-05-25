-- Users table
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Tasks table
DROP TABLE IF EXISTS tasks;
CREATE TABLE tasks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    due_date DATE NOT NULL,
    status VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (id, name, email, password)
VALUES (
    1,
    'Test User',
    'test@test.com',
    '$2y$10$m7dvxSykpGWlI2A3m5.90uOOkwwVRxh/06C8rxhUF3sgxqqB1AQOq'
);

INSERT INTO tasks (id, name, due_date, status, user_id)
VALUES
(1, 'Review project', '2026-05-30', 'active', 1),
(2, 'Prepare plan', '2026-05-28', 'active', 1),
(3, 'Build project', '2026-05-29', 'completed', 1);