DROP TABLE IF EXISTS jugadores CASCADE;

CREATE TABLE jugadores
(
      id     BIGSERIAL PRIMARY KEY
    , nombre CHAR
);



DROP TABLE IF EXISTS fichas CASCADE;

CREATE TABLE fichas
(
     id      BIGSERIAL PRIMARY KEY
   , simbolo CHAR
);




DROP TABLE IF EXISTS celdas CASCADE;

CREATE TABLE celdas
(
     id BIGSERIAL PRIMARY KEY
  ,  numero SMALLINT NOT NULL
);




DROP TABLE IF EXISTS partida CASCADE;

CREATE TABLE partida
(
      id         BIGSERIAL
    , jugador_id BIGINT REFERENCES jugadores (id)
                        ON DELETE CASCADE
                        ON UPDATE CASCADE
    , ficha_id   BIGINT REFERENCES fichas (id)
                        ON DELETE CASCADE
                        ON UPDATE CASCADE

    , celda_id    BIGINT REFERENCES celdas (id)
                        ON DELETE CASCADE
                        ON UPDATE CASCADE

    , PRIMARY KEY (id, jugador_id, ficha_id, celda_id)
);


-- INSERT

INSERT INTO jugadores (nombre)
values ('U'), ('S');

INSERT INTO fichas (simbolo)
values ('X'), ('O');

INSERT INTO celdas (numero)
values (1), (2), (3), (4), (5), (6), (7), (8), (9);
