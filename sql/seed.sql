TRUNCATE TABLE Users, Offences, Participations, SuspectNotes,
Suspects, AddressNotes, Addresses, Locations, Tables;

INSERT INTO Tables (name, label) VALUES
  ('Addresses', 2),
  ('AddressNotes', 3),
  ('Locations', 1),
  ('Offences', 3),
  ('Participations', 4),
  ('SuspectNotes', 4),
  ('Suspects', 3),
  ('Tables', 0),
  ('Users', 0);

INSERT INTO Users (login, label, password, session) VALUES
  ('admin', 0, MD5('admin'), NULL),
  ('aj', 2, MD5('aj'), NULL);

INSERT INTO Locations (longitude, latitude, description) VALUES
  (50, 60, 'opis1'),
  (20, 89, 'opis2'),
  (80, 10, 'opis3');

INSERT INTO Addresses (location_id) VALUES
  (1),
  (2),
  (3);
