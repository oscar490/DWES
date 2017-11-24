DROP TABLE IF EXISTS generos CASCADE;

CREATE TABLE generos
(
      id     BIGSERIAL PRIMARY KEY
    , genero VARCHAR(255) NOT NULL UNIQUE
);



DROP TABLE IF EXISTS peliculas CASCADE;

CREATE TABLE peliculas
(
      id        BIGSERIAL    PRIMARY KEY
    , titulo    VARCHAR(255) NOT NULL
    , anyo      NUMERIC(4)
    , sinopsis  TEXT
    , duracion  SMALLINT     DEFAULT 0
                             CONSTRAINT  ck_peliculas_duracion_positiva
                             CHECK (coalesce(duracion, 0) >= 0)
    , genero_id BIGINT       NOT NULL
                             REFERENCES generos (id)
                             ON DELETE NO ACTION
                             ON UPDATE CASCADE

);


-- INSERT

INSERT INTO generos (genero)
VALUES ('Comedia')
      , ('Terror')
      , ('Ciencia-Ficción')
      , ('Drama')
      , ('Aventura');

INSERT INTO peliculas (titulo, anyo, sinopsis, duracion, genero_id)
VALUES ('Los últimos Jedi', 2017, 'Va uno se cae y se muere', 204, 3)
     , ('Los Goonies', 1985, 'Unos niños que se mueren',50, 1)
     , ('Aqui llega Condemor', 1996, 'Mejor no contar nada', 90, 2);




DROP TABLE usuarios CASCADE;

CREATE TABLE usuarios
(
      id       BIGSERIAL    PRIMARY KEY
    , usuario  VARCHAR(255) NOT NULL UNIQUE
                            CONSTRAINT ck_usuario_sin_espacion
                            CHECK (position(' ' in usuario) = 0)
    , password VARCHAR(255) NOT NULL
);

INSERT INTO usuarios (usuario, password)
     VALUES ('pepe', crypt('pepe', gen_salt('bf', 10)))
         ,   ('juan', crypt('juan', gen_salt('bf', 10)));
