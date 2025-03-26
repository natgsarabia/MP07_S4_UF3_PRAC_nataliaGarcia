CREATE DATABASE if not exists  mp07s4uf3 ;
USE mp07s4uf3;
CREATE TABLE if not exists usuaris ( 
id INT AUTO_INCREMENT PRIMARY KEY, 
nom VARCHAR(50), 
email VARCHAR(100), 
edat INT 
);

INSERT INTO usuaris (nom, email, edat) VALUES 
('Anna', 'anna@example.com', 30), 
('Joan', 'joan@example.com', 22), 
('Marta', 'marta@example.com', 27),
('Maria', 'maria@example.com', 25),
('Pablo', 'pablo@example.com', 33);