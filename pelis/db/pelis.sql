-- TABLA GENEROS
DROP TABLE IF EXISTS generos CASCADE;

CREATE TABLE generos
(
      id     BIGSERIAL    PRIMARY KEY
    , nombre VARCHAR(255) UNIQUE
);



-- TABLA PELICULAS
DROP TABLE IF EXISTS peliculas CASCADE;

CREATE TABLE peliculas
(
      id        BIGSERIAL     PRIMARY KEY
    , titulo    VARCHAR(255)  NOT NULL
    , anyo      NUMERIC(4)    CONSTRAINT
                              ck_anyos_positivos
                              CHECK (anyo > 0)
    , duracion  SMALLINT      DEFAULT 0
                              CONSTRAINT
                              ck_numeros_positivos
                              CHECK (duracion > 0)
    , sinopsis  VARCHAR(255)
    , genero_id BIGINT        REFERENCES generos (id)
                              ON DELETE NO ACTION
                              ON UPDATE CASCADE



);


-- TABLA PELICULAS-GENEROS
/**
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
**/
-- INSERT



INSERT INTO generos (nombre)
values ('Acción'), ('Comedia'), ('Drama'), ('Terror'), ('Animación'), ('Suspense'),
('Romance'), ('Ciencia ficción'), ('Fantasía');

INSERT INTO peliculas (titulo, anyo, duracion, sinopsis, genero_id)
values ('Spiderman homecoming', 2016, 90, 'Spiderman más jóven y fuerte', 8),
        ('Tres metros sobre el cielo', 2009, 120, 'Dos jóvenes que se enamoran', 7),
        ('IT', 2017, 120, 'Terror del payaso', 4);
