CREATE DATABASE IF NOT EXISTS restmovie;

USE restmovie;

CREATE TABLE movies (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  title VARCHAR(255),
  link VARCHAR(255),
  picture VARCHAR(255),
  type VARCHAR(255),
  actors VARCHAR(255),
  directors VARCHAR(255),
  released_at DATETIME DEFAULT NOW(),
  created_at DATETIME DEFAULT NOW(),
  updated_at DATETIME DEFAULT NOW()
);

INSERT INTO movies (title, link)
VALUES
('Inception', ''),
('Shutter Island', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=132039.html');
