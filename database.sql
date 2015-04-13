DROP DATABASE IF EXISTS restmovie;

CREATE DATABASE IF NOT EXISTS restmovie;

USE restmovie;

CREATE TABLE movies (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  title VARCHAR(255),
  link VARCHAR(255),
  picture VARCHAR(255),
  remote_id VARCHAR(255),
  actors VARCHAR(255),
  directors VARCHAR(255),
  released_at DATETIME DEFAULT NOW(),
  created_at DATETIME DEFAULT NOW(),
  updated_at DATETIME DEFAULT NOW(),

CONSTRAINT
  remote_id UNIQUE (remote_id)
);

INSERT INTO `movies` (`title`, `link`, `picture`, `remote_id`, `actors`, `directors`, `released_at`)
VALUES
	('Drive', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=135082.html', 'http://fr.web.img1.acsta.net/medias/nmedia/18/83/93/95/19803697.jpg', '135082', 'Ryan Gosling, Carey Mulligan, Bryan Cranston, Albert Brooks, Oscar Isaac', 'Nicolas Winding Refn', '2015-04-13 12:00:00'),
	('Inception', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=143692.html', 'http://fr.web.img2.acsta.net/medias/nmedia/18/72/34/14/19476654.jpg', '143692', 'Leonardo DiCaprio, Marion Cotillard, Ellen Page, Cillian Murphy, Michael Caine', 'Christopher Nolan', '2015-04-13 12:00:18'),
	('American Sniper', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=208041.html', 'http://fr.web.img4.acsta.net/pictures/14/10/14/09/50/570218.jpg', '208041', 'Bradley Cooper, Sienna Miller, Luke Grimes, Jake McDorman, Kevin Lacz', 'Clint Eastwood', '2015-04-13 12:01:07'),
	('Law Abiding Citizen', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=134690.html', 'http://fr.web.img1.acsta.net/medias/nmedia/18/72/55/36/19593496.jpg', '134690', 'Gerard Butler, Jamie Foxx, Leslie Bibb, Bruce McGill, Colm Meaney', 'F. Gary Gray', '2015-04-13 12:01:23'),
	('Invincible', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=28434.html', 'http://fr.web.img4.acsta.net/medias/nmedia/00/02/41/89/69220919_af.jpg', '28434', 'Tim Roth, Jouko Ahola, Max Raabe, Jacob Wein, Gustav Peter Wöhler', 'Werner Herzog', '2015-04-13 12:02:35'),
	('Interstellar', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=114782.html', 'http://fr.web.img1.acsta.net/pictures/14/09/24/12/08/158828.jpg', '114782', 'Matthew McConaughey, Anne Hathaway, Michael Caine, John Lithgow, Jessica Chastain', 'Christopher Nolan', '2015-04-13 12:06:26'),
	('Pourquoi j\'ai pas mangé mon père', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=57732.html', 'http://fr.web.img5.acsta.net/pictures/15/03/18/14/19/421450.jpg', '57732', 'Jamel Debbouze, Mélissa Theuriau, Arié Elmaleh, Patrice Thibaud, Christian Hecq', 'Jamel Debbouze', '2015-04-13 12:06:42'),
	('Django Unchained', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=190918.html', 'http://fr.web.img6.acsta.net/medias/nmedia/18/90/08/59/20366454.jpg', '190918', 'Jamie Foxx, Christoph Waltz, Leonardo DiCaprio, Kerry Washington, Samuel L. Jackson', 'Quentin Tarantino', '2015-04-13 12:06:57'),
	('Forrest Gump', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=10568.html', 'http://fr.web.img5.acsta.net/medias/nmedia/18/63/30/77/18686566.jpg', '10568', 'Tom Hanks, Gary Sinise, Robin Wright, Mykelti Williamson, Sally Field', 'Robert Zemeckis', '2015-04-13 12:07:05'),
	('Schindler\'s List', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=9393.html', 'http://fr.web.img5.acsta.net/medias/nmedia/18/66/03/76/18979736.jpg', '9393', 'Liam Neeson, Ben Kingsley, Ralph Fiennes, Caroline Goodall, Jonathan Sagall', 'Steven Spielberg', '2015-04-13 12:07:41'),
	('Intouchables', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=182745.html', 'http://fr.web.img1.acsta.net/medias/nmedia/18/82/69/17/19806656.jpg', '182745', 'François Cluzet, Omar Sy, Anne Le Ny, Audrey Fleurot, Clothilde Mollet', 'Eric Toledano, Olivier Nakache', '2015-04-13 12:08:08'),
	('The Godfather', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=1628.html', 'http://fr.web.img4.acsta.net/medias/nmedia/18/35/57/73/18660716.jpg', '1628', 'Marlon Brando, Al Pacino, James Caan, Robert Duvall, Sterling Hayden', 'Francis Ford Coppola', '2015-04-13 12:08:22'),
	('The Lord of the Rings: The Return of the King', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=39187.html', 'http://fr.web.img3.acsta.net/medias/nmedia/18/35/14/33/18366630.jpg', '39187', 'Elijah Wood, Sean Astin, Viggo Mortensen, Ian McKellen, Liv Tyler', 'Peter Jackson', '2015-04-13 12:08:41'),
	('The Lion King', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=10862.html', 'http://fr.web.img6.acsta.net/medias/nmedia/18/85/97/82/19858447.jpg', '10862', 'Matthew Broderick, Jonathan Taylor, James Earl Jones, Madge Sinclair, Rowan Atkinson', 'Roger Allers, Rob Minkoff', '2015-04-13 12:08:53'),
	('Gladiator', 'http://www.allocine.fr/film/fichefilm_gen_cfilm=24944.html', 'http://fr.web.img1.acsta.net/medias/nmedia/18/68/64/41/19254510.jpg', '24944', 'Russell Crowe, Joaquin Phoenix, Connie Nielsen, Oliver Reed, Richard Harris', 'Ridley Scott', '2015-04-13 12:09:09');
