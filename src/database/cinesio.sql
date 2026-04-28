-- 1. Création des tables (Structuration de la BDD liée au MLD)
CREATE TABLE genre (
    id SERIAL PRIMARY KEY,
    nom TEXT NOT NULL
);

CREATE TABLE pays (
    id SERIAL PRIMARY KEY,
    nom TEXT NOT NULL,
    initiale CHAR(3) NOT NULL
);

CREATE TABLE film (
    id SERIAL PRIMARY KEY,
    titre TEXT NOT NULL,
    date_sortie DATE NOT NULL,
    duree INT NOT NULL,
    synopsis TEXT NOT NULL,
    image TEXT NOT NULL,
    id_genre INT NOT NULL REFERENCES genre(id),
    id_pays INT NOT NULL REFERENCES pays(id)
);

-- 2. Insertion des données
-- Les genres
INSERT INTO genre (nom) VALUES
('Science-Fiction'), ('Drame'), ('Thriller'), ('Comédie'), ('Action'), ('Crime'), ('Animation');

-- Les pays
INSERT INTO pays (nom, initiale) VALUES
('USA', 'USA'), ('Corée du Sud', 'KOR'), ('France', 'FRA'), ('Japon', 'JPN');

-- Les films (Données issues du catalogue TP-1 avec les clés étrangères associées)
INSERT INTO film (titre, date_sortie, duree, synopsis, image, id_genre, id_pays) VALUES
('Inception', '2010-07-21', 148, 'Un voleur qui infiltre les rêves doit implanter une idée dans l''esprit d''un héritier.', 'https://placehold.co/500x750/4f46e5/ffffff?text=Inception', 1, 1),
('Le Parrain', '1972-03-24', 175, 'La montée en puissance d''une famille mafieuse à New York.', 'https://placehold.co/500x750/4f46e5/ffffff?text=Le+Parrain', 2, 1),
('Parasite', '2019-06-05', 132, 'Une famille pauvre s''immisce dans le quotidien d''une famille riche.', 'https://placehold.co/500x750/ef4444/ffffff?text=Parasite', 3, 2),
('Interstellar', '2014-11-05', 169, 'Un voyage spatial pour sauver l''humanité à travers un trou de ver.', 'https://placehold.co/500x750/4f46e5/ffffff?text=Interstellar', 1, 1),
('Le Fabuleux Destin d''Amélie Poulain', '2001-04-25', 122, 'Une jeune serveuse décide de changer la vie des gens autour d''elle.', 'https://placehold.co/500x750/10b981/ffffff?text=Le+Fabuleux+Destin+d''Amélie+Poulain', 4, 3),
('The Dark Knight', '2008-08-13', 152, 'Batman affronte le Joker, un criminel qui veut semer l''anarchie.', 'https://placehold.co/500x750/4f46e5/ffffff?text=The+Dark+Knight', 5, 1),
('Pulp Fiction', '1994-10-26', 154, 'Les vies de plusieurs criminels s''entrecroisent dans un Los Angeles violent.', 'https://placehold.co/500x750/4f46e5/ffffff?text=Pulp+Fiction', 6, 1),
('Your Name', '2016-12-28', 106, 'Deux adolescents que tout oppose échangent leurs corps de façon inexpliquée.', 'https://placehold.co/500x750/a855f7/ffffff?text=Your+Name', 7, 4),
('La Haine', '1995-05-31', 98, '24 heures dans la vie de trois jeunes d''une cité après une émeute.', 'https://placehold.co/500x750/10b981/ffffff?text=La+Haine', 2, 3),
('Le Voyage de Chihiro', '2001-07-20', 125, 'Une petite fille se retrouve coincée dans un monde d''esprits magiques.', 'https://placehold.co/500x750/a855f7/ffffff?text=Le+Voyage+de+Chihiro', 7, 4);



