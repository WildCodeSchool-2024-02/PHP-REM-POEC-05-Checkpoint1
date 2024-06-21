DROP TABLE IF EXISTS checkpoint1;
CREATE DATABASE checkpoint1;
USE checkpoint1;

CREATE TABLE bribe (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  payment INT
)engine=innodb CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO bribe (name, payment) VALUES
('John Doe', 500),
('Jane Smith', 750),
('Officer McClane', 1000);

