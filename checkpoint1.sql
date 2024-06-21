DROP TABLE IF EXISTS bribe;
CREATE TABLE bribe (
  id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom  VARCHAR(255) NOT NULL,
  payement INT 
) 
engine=innodb CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO bribe (id, nom, payement) VALUES
(1, 'Armand', 100),
(2, 'Rebecca', 70),
(3, 'Hebert', 85),
(4, 'Ribeiro', 30),
(5, 'Savary', 90);
