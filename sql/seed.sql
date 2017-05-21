TRUNCATE TABLE users, offence, participation, suspect_note,
suspect, address_note, address, location, tables;

INSERT INTO tables (id, name, label) VALUES
  (0, 'address', 2),
  (1, 'address_note', 3),
  (2, 'location', 1),
  (3, 'offence', 3),
  (4, 'participation', 4),
  (5, 'suspect_note', 4),
  (6, 'suspect', 3),
  (7, 'tables', 0),
  (8, 'users', 0);
SELECT setval(pg_get_serial_sequence('tables', 'id'), coalesce(max(id)+1,1), false) FROM tables;

INSERT INTO users (id, login, label, password, session) VALUES
  (0, 'admin', 0, crypt('Admin!', gen_salt('bf', 8)), NULL),
  (1, 'poziom1', 1, crypt('Poziom1!', gen_salt('bf', 8)), NULL),
  (2, 'poziom2', 2, crypt('Poziom2!', gen_salt('bf', 8)), NULL),
  (3, 'poziom3', 3, crypt('Poziom3!', gen_salt('bf', 8)), NULL),
  (4, 'poziom4', 4, crypt('Poziom4!', gen_salt('bf', 8)), NULL),
  (5, 'poziom5', 5, crypt('Poziom5!', gen_salt('bf', 8)), NULL);
SELECT setval(pg_get_serial_sequence('users', 'id'), coalesce(max(id)+1,1), false) FROM users;

INSERT INTO location (id, longitude, latitude, description) VALUES
  (0, 52.8790, 18.7948, 'Baza ISIS w Ciechocinku'),
  (1, 54.4416, 18.5601, 'Mieszkanie potencjalnego zamachowca'),
  (2, 33.8688, 151.2093, 'Sydney'),
  (3, 50.9375, 6.9603, 'Turecka dzielnica w Kolonii'),
  (4, 38.9072, 77.0369, 'Bialy dom'),
  (5, 12.1696, 68.9900, 'Curacao');
SELECT setval(pg_get_serial_sequence('location', 'id'), coalesce(max(id)+1,1), false) FROM location;

INSERT INTO address (id, location_id, street, house_number, plate_number, postal_code, town, country) VALUES
  (0, 0, 'Kolejowa', 11, 24, '87-720', 'Ciechocinek', 'Poland'),
  (1, 0, 'Kolejowa', 11, 25, '87-720', 'Ciechocinek', 'Poland'),
  (2, 0, 'Kolejowa', 11, 26, '87-720', 'Ciechocinek', 'Poland'),
  (3, 1, 'Grottgera', 4, 7, '81-809', 'Sopot', 'Poland'),
  (4, 3, 'Helenenstrasse', 14, NULL, '50667', 'Cologne', 'Germany'),
  (5, 3, 'Helenenstrasse', 15, NULL, '50667', 'Cologne', 'Germany'),
  (6, 3, 'Helenenstrasse', 16, NULL, '50667', 'Cologne', 'Germany');
SELECT setval(pg_get_serial_sequence('address', 'id'), coalesce(max(id)+1,1), false) FROM address;

INSERT INTO address_note (id, address_id, date, title, note) VALUES
  (0, 3, '1999-01-08', 'Zgloszenie', 'Otrzymalismy zgloszenie o potencjalnym zamachowcu zamieszkalym pod tym adresem'),
  (1, 3, '1999-01-11', 'Obserwacja 1', 'Obserwacja lokalizacji nie wykazuje niczego dziwnego'),
  (2, 3, '1999-01-18', 'Obserwacja 2', 'Obserwacja lokalizacji nie wykazuje niczego dziwnego'),
  (3, 3, '1999-01-24', 'Obserwacja 3', 'Obserwacja lokalizacji nie wykazuje niczego dziwnego'),
  (4, 3, '1999-01-24', 'Koniec obserwacji', 'Zakonczono obserwacje terenu ze wzgledu na brak nietypowych zachowan'),
  (5, 0, '2006-02-24', 'Przeszukanie', 'W wyniku przeszukania znaleziono 40 ton szarego mydla'),
  (6, 6, '2016-07-01', 'Przeszukanie', 'Podczas przeszukania wylegitymowano 141 nielegalnych, tureckich imigrantow');
SELECT setval(pg_get_serial_sequence('address_note', 'id'), coalesce(max(id)+1,1), false) FROM address_note;

INSERT INTO suspect (id, address_id, first_name, last_name, sex, date_of_birth) VALUES
  (0, 0, 'Adam', 'Nowak', 1, '1984-01-01'),
  (1, 0, 'Barbara', 'Nowak', 0, '1986-04-02'),
  (2, 1, 'Piotr', 'Kowalski', 1, '1981-07-21'),
  (3, 5, 'Mohammad', 'Afir', 1, '1972-09-09'),
  (4, 6, 'Mohammad', 'Iris', 1, '1979-12-30'),
  (5, 6, 'Mohammad', 'Irfan', 1, '1998-07-29');
SELECT setval(pg_get_serial_sequence('suspect', 'id'), coalesce(max(id)+1,1), false) FROM suspect;

INSERT INTO suspect_note (id, suspect_id, time, title, note) VALUES
  (0, 5, '2017-05-16', 'Rozpoznanie', 'W zasadzie niegrozny'),
  (1, 3, '2017-05-17', 'Rozpoznanie', 'Potencjalny terrorysta'),
  (2, 4, '2017-05-17', 'Rozpoznanie', 'Znany terrorysta, lekko przyglupi');
SELECT setval(pg_get_serial_sequence('suspect_note', 'id'), coalesce(max(id)+1,1), false) FROM suspect_note;

INSERT INTO offence (id, location_id, date, description) VALUES
  (0, 0, '2017-01-01', 'Bardzo grozny zamach w sylwestra'),
  (1, 3, '2015-01-01', 'Udaremniona proba wysadzenia sklepu monopolowego');
SELECT setval(pg_get_serial_sequence('offence', 'id'), coalesce(max(id)+1,1), false) FROM offence;

INSERT INTO participation (id, suspect_id, offence_id, description) VALUES
  (0, 1, 0, 'Glowny organizator'),
  (1, 4, 1, 'Glowny organizator i planista'),
  (2, 3, 1, 'Prawa raczka organizatora');
SELECT setval(pg_get_serial_sequence('participation', 'id'), coalesce(max(id)+1,1), false) FROM participation;
