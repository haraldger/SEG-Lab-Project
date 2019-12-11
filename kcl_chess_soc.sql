DROP TABLE IF EXISTS members;
CREATE TABLE members (
  memberID INT NOT NULL AUTO_INCREMENT,
  fName VARCHAR(255),
  lName VARCHAR(255),
  address VARCHAR(255),
  phoneNum VARCHAR(255),
  gender ENUM ('Male','Female','Other'),
  dob DATE,
  rating INT,
  role ENUM ('Member', 'Officer', 'System Admin') DEFAULT 'Member',
  PRIMARY KEY (memberID)
);
 
DROP TABLE IF EXISTS societyEvents;
CREATE TABLE societyEvents (
  eventID INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  description VARCHAR(255),
  eventDate DATETIME,
  releaseDate DATETIME,
  expiryDate DATETIME,
  PRIMARY KEY (eventID)
);

DROP TABLE IF EXISTS news;
CREATE TABLE news (
  newsID INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255),
  authorID int,
  description VARCHAR(255),
  releaseDate DATETIME,
  expiryDate DATETIME,
  PRIMARY KEY (newsID),
  FOREIGN KEY (authorID) REFERENCES members(memberID)
);

DROP TABLE IF EXISTS tournaments;
CREATE TABLE tournaments (
  tournamentID INT NOT NULL AUTO_INCREMENT,
  signupDeadline DATETIME,
  PRIMARY KEY (tournamentID)
);

DROP TABLE IF EXISTS tournamentOrganisers;
CREATE TABLE tournamentOrganisers (
  tournamentID INT,
  organiserID INT,
  PRIMARY KEY (tournamentID, organiserID),
  FOREIGN KEY (tournamentID) REFERENCES tournaments(tournamentID),
  FOREIGN KEY (organiserID) REFERENCES members(memberID)
);

DROP TABLE IF EXISTS tournamentCompetitors;
CREATE TABLE tournamentCompetitors (
  tournamentID INT,
  competitorID INT,
  PRIMARY KEY (tournamentID, competitorID),
  FOREIGN KEY (tournamentID) REFERENCES tournaments(tournamentID),
  FOREIGN KEY (competitorID) REFERENCES members(memberID)
);

DROP TABLE IF EXISTS tournamentMatches;
CREATE TABLE tournamentMatches (
  matchID INT NOT NULL AUTO_INCREMENT,
  tournamentID INT,
  matchDate DATETIME,
  competitorID1 INT,
  competitorID2 INT,
  winner INT,
  PRIMARY KEY (matchID),
  FOREIGN KEY (competitorID1) REFERENCES members(memberID),
  FOREIGN KEY (competitorID2) REFERENCES members(memberID)
);


INSERT INTO members (fName, lName, address, phoneNum, gender, dob, rating, role)
VALUES ('John', 'Smith', '123 Fake Street London', '07123456789', 'Male', '1995-01-01', 100, 'Member');
INSERT INTO members (fName, lName, address, phoneNum, gender, dob, rating, role)
VALUES ('Alice', 'Johnson', '456 Fake Street London', '07987654321', 'Female', '1994-12-12', 150, 'System Admin');
INSERT INTO members (fName, lName, address, phoneNum, gender, dob, rating, role)
VALUES ('Riley', 'Thompson', '789 Fake Street London', '07192837465', 'Other', '1995-01-01', 130, 'Officer');

INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('Coffee Morning', 'Come to the cafe and enjoy a hot drink while meeting society members', '2019-12-05 10:00:00', '2019-11-18 00:00:00', '2019-12-05 12:00:00');
INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('Pub Quiz', 'Get to know society members with a little friendly competition', '2019-12-07 17:00:00', '2019-11-18 00:00:00', '2019-12-07 21:00:00');
INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('Awards Ceremony', 'Come and celebrate the achievements of our society members', '2020-04-01 14:00:00', '2020-02-01 00:00:00', '2020-04-01 21:00:00');

INSERT INTO news (title, authorID, description, releaseDate, expiryDate)
VALUES ('This is a Headline', 1, 'This is the contents of the news post.', '2019-11-15 08:00:00', '2020-01-01 00:00:00');
