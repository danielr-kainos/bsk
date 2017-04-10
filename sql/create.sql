DROP TABLE Users, Offences, Participations, SuspectNotes,
Suspects, AddressNotes, Addresses, Locations, Tables CASCADE;

CREATE TABLE IF NOT EXISTS Tables (
  id    SERIAL PRIMARY KEY,
  name  TEXT,
  label INT
);

CREATE TABLE IF NOT EXISTS Users (
  id       SERIAL PRIMARY KEY,
  login    VARCHAR(50),
  password VARCHAR(128),
  session  VARCHAR(64),
  label    INT
);

CREATE TABLE IF NOT EXISTS Locations (
  id          SERIAL PRIMARY KEY,
  longitude   DOUBLE PRECISION,
  latitude    DOUBLE PRECISION,
  description TEXT NULL
);

CREATE VIEW Location_View AS
  SELECT
    *,
    'lat: ' || latitude :: TEXT || ', lon: ' || longitude :: TEXT
      AS name
  FROM Locations;

CREATE TABLE IF NOT EXISTS Addresses (
  id           SERIAL PRIMARY KEY,
  street       VARCHAR(45),
  plate_number INT NULL,
  house_number INT,
  postal_code  VARCHAR(45),
  town         VARCHAR(45),
  country      VARCHAR(45),
  location_id  INT
);

CREATE VIEW Address_View AS
  SELECT
    *,
    country :: TEXT || ', ' || town :: TEXT || ', ' || street :: TEXT
      AS name
  FROM Addresses;

CREATE TABLE IF NOT EXISTS AddressNotes (
  id         SERIAL PRIMARY KEY,
  date       TIMESTAMP,
  title      VARCHAR(50),
  note       TEXT,
  address_id INT
);

CREATE TABLE IF NOT EXISTS Suspects (
  id            SERIAL PRIMARY KEY,
  first_name    VARCHAR(45),
  last_name     VARCHAR(45),
  sex           INT,
  date_of_birth DATE,
  address_id    INT
);

CREATE VIEW Suspect_View AS
  SELECT
    *,
    first_name :: TEXT || ' ' || last_name :: TEXT
      AS name
  FROM Suspects;

CREATE TABLE IF NOT EXISTS SuspectNotes (
  id         SERIAL PRIMARY KEY,
  time       TIMESTAMP,
  title      VARCHAR(50),
  note       TEXT,
  suspect_id INT
);

CREATE TABLE IF NOT EXISTS Offences (
  id          SERIAL PRIMARY KEY,
  date        DATE,
  description TEXT NULL,
  location_id INT
);

CREATE VIEW Offence_View AS
  SELECT
    *,
    'commited on: ' || date :: TEXT
      AS name
  FROM Offences;

CREATE TABLE IF NOT EXISTS Participations (
  id          SERIAL PRIMARY KEY,
  description TEXT NULL,
  suspect_id  INT,
  offence_id  INT
);
