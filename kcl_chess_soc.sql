DROP TABLE IF EXISTS members;
CREATE TABLE members (
  id INT NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  address VARCHAR(255),
  phone_number VARCHAR(255),
  gender ENUM ('Male','Female','Other'),
  date_of_birth DATE,
  rating INT,
  role ENUM ('Member', 'Officer', 'System Admin') DEFAULT 'Member',
  email VARCHAR(255) NOT NULL,
  username VARCHAR(255) NOT NULL,
  hashed_password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);
 
DROP TABLE IF EXISTS societyEvents;
CREATE TABLE societyEvents (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  description VARCHAR(255) NOT NULL,
  eventDate DATETIME NOT NULL,
  releaseDate DATETIME NOT NULL,
  expiryDate DATETIME NOT NULL,
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS news;
CREATE TABLE news (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  authorID int,
  description VARCHAR(255) NOT NULL,
  releaseDate DATETIME NOT NULL,
  expiryDate DATETIME NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (authorID) REFERENCES members(id)  ON DELETE SET NULL
);

DROP TABLE IF EXISTS tournaments;
CREATE TABLE tournaments (
  id INT NOT NULL AUTO_INCREMENT,
  signupDeadline DATETIME NOT NULL,
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS tournamentOrganisers;
CREATE TABLE tournamentOrganisers (
  tournamentID INT,
  organiserID INT,
  PRIMARY KEY (tournamentID, organiserID),
  FOREIGN KEY (tournamentID) REFERENCES tournaments(id),
  FOREIGN KEY (organiserID) REFERENCES members(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS tournamentCompetitors;
CREATE TABLE tournamentCompetitors (
  tournamentID INT,
  competitorID INT,
  PRIMARY KEY (tournamentID, competitorID),
  FOREIGN KEY (tournamentID) REFERENCES tournaments(id),
  FOREIGN KEY (competitorID) REFERENCES members(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS tournamentMatches;
CREATE TABLE tournamentMatches (
  id INT NOT NULL AUTO_INCREMENT,
  tournamentID INT,
  matchDate DATETIME NOT NULL,
  competitorID1 INT,
  competitorID2 INT,
  winner INT,
  PRIMARY KEY (id),
  FOREIGN KEY (competitorID1) REFERENCES members(id) ON DELETE SET NULL,
  FOREIGN KEY (competitorID2) REFERENCES members(id) ON DELETE SET NULL
);


INSERT INTO members (first_name, last_name, address, phone_number, gender, date_of_birth, rating, role, email, username, hashed_password)
VALUES ('John', 'Smith', '123 Fake Street London', '07123456789', 'Male', '1995-01-01', 1000, 'Member', 'jsmith@gmail.com', 'jsmith', 'qwertyuiop');
INSERT INTO members (first_name, last_name, address, phone_number, gender, date_of_birth, rating, role, email, username, hashed_password)
VALUES ('Alice', 'Johnson', '456 Fake Street London', '07987654321', 'Female', '1994-12-12', 1500, 'System Admin', 'ajohnson@gmail.com', 'ajohnson', 'asdfghjkl');
INSERT INTO members (first_name, last_name, address, phone_number, gender, date_of_birth, rating, role, email, username, hashed_password)
VALUES ('Riley', 'Thompson', '789 Fake Street London', '07192837465', 'Other', '1995-01-01', 1300, 'Officer', 'rthompson@gmail.com', 'rthompson', 'zxcvbnm');

INSERT INTO societyEvents (title, description, eventDate, releaseDate, expiryDate)
VALUES ('Coffee Morning', 'Come to the cafe and enjoy a hot drink while meeting society members', '2019-12-05 10:00:00', '2019-11-18 00:00:00', '2019-12-05 12:00:00');
INSERT INTO societyEvents (title, description, eventDate, releaseDate, expiryDate)
VALUES ('Pub Quiz', 'Get to know society members with a little friendly competition', '2019-12-07 17:00:00', '2019-11-18 00:00:00', '2019-12-07 21:00:00');
INSERT INTO societyEvents (title, description, eventDate, releaseDate, expiryDate)
VALUES ('Awards Ceremony', 'Come and celebrate the achievements of our society members', '2020-04-01 14:00:00', '2020-02-01 00:00:00', '2020-04-01 21:00:00');

INSERT INTO news (title, authorID, description, releaseDate, expiryDate)
VALUES ('This is a Headline', 1, 'This is the contents of the news post.', '2019-11-15 08:00:00', '2020-01-01 00:00:00');
