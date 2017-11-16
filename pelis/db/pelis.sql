-- TABLA GENEROS
DROP TABLE IF EXISTS generos CASCADE;

CREATE TABLE generos
(
      id     BIGSERIAL PRIMARY KEY
    , nombre VARCHAR(255)
);



-- TABLA PELICULAS
DROP TABLE IF EXISTS peliculas CASCADE;

CREATE TABLE peliculas
(
      id       BIGSERIAL     PRIMARY KEY
    , titulo   VARCHAR(255)  NOT NULL
    , anyo     NUMERIC(4)    CONSTRAINT
                             ck_numeros_positivos
                             CHECK (anyo > 0)
    , argumento VARCHAR(255) NOT NULL
);


-- TABLA PELICULAS-GENEROS
DROP TABLE IF EXISTS peliculas_generos CASCADE;

CREATE TABLE peliculas_generos
(
      pelicula_id BIGINT REFERENCES peliculas (id)
                       ON DELETE CASCADE
                       ON UPDATE CASCADE
    , genero_id   BIGINT REFERENCES generos (id)
                       ON DELETE CASCADE
                       ON UPDATE CASCADE
    ,             PRIMARY KEY (pelicula_id, genero_id)
);

-- INSERT

INSERT INTO peliculas (titulo, anyo, argumento)
values ('Spiderman homecoming', 2017, 'Spiderman es más jóven y más fuerte.'),
        ('Crudo', 2016, 'Adolescente que come carne cruda.'),
        ('3MSC', 2009, 'Dos jóvenes que se enamoran locamente');

INSERT INTO generos (nombre)
values ('Acción'), ('Comedia'), ('Drama'), ('Terror'), ('Animación'), ('Suspense'),
('Romance'), ('Ciencia ficción'), ('Fantasía'), ('Suspense');

INSERT INTO peliculas_generos (pelicula_id, genero_id)
values (1, 1), (1, 8), (2, 6), (2, 4), (3,7), (3,1);
