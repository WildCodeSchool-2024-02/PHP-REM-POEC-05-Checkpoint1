DROP TABLE IF EXISTS bribe;
CREATE TABLE bribe (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    payment INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO bribe (name, payment) VALUES
    ('John Doe', 500),
    ('David Wilson', 900);
