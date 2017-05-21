DROP TABLE users, offence, participation, suspect_note,
suspect, address_note, address, location, tables CASCADE;

CREATE EXTENSION pgcrypto;

CREATE TABLE IF NOT EXISTS tables (
  id    SERIAL PRIMARY KEY,
  name  TEXT,
  label INT
);

CREATE TABLE IF NOT EXISTS users (
  id       SERIAL PRIMARY KEY,
  login    VARCHAR(50),
  password VARCHAR(128),
  session  VARCHAR(64),
  label    INT
);

CREATE TABLE IF NOT EXISTS location (
  id          SERIAL PRIMARY KEY,
  longitude   DOUBLE PRECISION,
  latitude    DOUBLE PRECISION,
  description TEXT NULL
);

CREATE VIEW location_view AS
  SELECT
    *,
    'lat: ' || latitude :: TEXT || ', lon: ' || longitude :: TEXT
      AS name
  FROM location;

CREATE TABLE IF NOT EXISTS address (
  id           SERIAL PRIMARY KEY,
  street       VARCHAR(45),
  plate_number INT NULL,
  house_number INT,
  postal_code  VARCHAR(45),
  town         VARCHAR(45),
  country      VARCHAR(45),
  location_id  INT
);

CREATE VIEW address_view AS
  SELECT
    *,
    country :: TEXT || ', ' || town :: TEXT || ', ' || street :: TEXT
      AS name
  FROM address;

CREATE TABLE IF NOT EXISTS address_note (
  id         SERIAL PRIMARY KEY,
  date       DATE,
  title      VARCHAR(50),
  note       TEXT,
  address_id INT
);

CREATE TABLE IF NOT EXISTS suspect (
  id            SERIAL PRIMARY KEY,
  first_name    VARCHAR(45),
  last_name     VARCHAR(45),
  sex           INT,
  date_of_birth DATE,
  address_id    INT
);

CREATE VIEW suspect_view AS
  SELECT
    *,
    first_name :: TEXT || ' ' || last_name :: TEXT
      AS name
  FROM suspect;

CREATE TABLE IF NOT EXISTS suspect_note (
  id         SERIAL PRIMARY KEY,
  time       DATE,
  title      VARCHAR(50),
  note       TEXT,
  suspect_id INT
);

CREATE TABLE IF NOT EXISTS offence (
  id          SERIAL PRIMARY KEY,
  date        DATE,
  description TEXT NULL,
  location_id INT
);

CREATE VIEW offence_view AS
  SELECT
    *,
    'commited on: ' || date :: TEXT
      AS name
  FROM offence;

CREATE TABLE IF NOT EXISTS participation (
  id          SERIAL PRIMARY KEY,
  description TEXT NULL,
  suspect_id  INT,
  offence_id  INT
);
