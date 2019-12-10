DROP TABLE IF EXISTS members;
CREATE TABLE members (
  id INT NOT NULL AUTO_INCREMENT,
  fName VARCHAR(255) NOT NULL,
  lName VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  address VARCHAR(255) NOT NULL,
  phoneNum VARCHAR(255) NOT NULL,
  gender ENUM ('Male','Female','Other') NOT NULL,
  dob DATE NOT NULL,
  rating INT NOT NULL,
  role ENUM ('Member', 'Officer', 'System Admin') DEFAULT 'Member',
  hashed_password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);
 
DROP TABLE IF EXISTS societyEvents;
CREATE TABLE societyEvents (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  description VARCHAR(255) NOT NULL,
  eventDate DATETIME NOT NULL,
  releaseDate DATETIME NOT NULL,
  expiryDate DATETIME NOT NULL,
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS news;
CREATE TABLE news (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255),
  authorID int,
  description text,
  releaseDate DATETIME NOT NULL,
  expiryDate DATETIME NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (authorID) REFERENCES members(id)  ON DELETE SET NULL
);

DROP TABLE IF EXISTS tournaments;
CREATE TABLE tournaments (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  signupDeadline DATETIME NOT NULL,
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS tournamentOrganisers;
CREATE TABLE tournamentOrganisers (
  tournamentID INT,
  organiserID INT,
  UNIQUE (tournamentID, organiserID),
  FOREIGN KEY (tournamentID) REFERENCES tournaments(id),
  FOREIGN KEY (organiserID) REFERENCES members(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS tournamentCompetitors;
CREATE TABLE tournamentCompetitors (
  tournamentID INT,
  competitorID INT,
  UNIQUE (tournamentID, competitorID),
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
  winner INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (competitorID1) REFERENCES members(id),
  FOREIGN KEY (competitorID2) REFERENCES members(id),
  FOREIGN KEY (tournamentID) REFERENCES members(id)
);


INSERT INTO members (fName, lName, email, address, phoneNum, gender, dob, rating, role, hashed_password)
VALUES ('John', 'Smith', 'john@kcl.ac.uk','123 Fake Street London', '07123456789', 'Male', '1995-01-01', 1777, 'Member', '$we33ewmdks');
INSERT INTO members (fName, lName, email, address, phoneNum, gender, dob, rating, role, hashed_password)
VALUES ('Alice', 'Johnson', 'alice@kcl.ac.uk', '456 Fake Street London', '07987654321', 'Female', '1994-12-12', 1555, 'System Admin', '$3DSKM3e');
INSERT INTO members (fName, lName, email, address, phoneNum, gender, dob, rating, role, hashed_password)
VALUES ('Riley', 'Thompson', 'riley@kcl.ac.uk', '789 Fake Street London', '07192837465', 'Other', '1995-01-01', 1400, 'Officer', '$SK3DEDd3');
INSERT INTO members (fName, lName, email, address, phoneNum, gender, dob, rating, role, hashed_password)
VALUES ('Lucy', 'Juicy', 'lucy.juicy@kcl.ac.uk', '789 London Street Morocco', '07192837465', 'Other', '1995-01-01', 1300, 'Officer', '$SK3DEDd3');
INSERT INTO members (fName, lName, email, address, phoneNum, gender, dob, rating, role, hashed_password)
VALUES ('Cassie', 'Barrett', 'Cassie@kcl.ac.uk', '789 London Street Morocco', '07192837465', 'Other', '1995-01-01', 2000, 'Officer', '$SK3DEDd3');
INSERT INTO members (fName, lName, email, address, phoneNum, gender, dob, rating, role, hashed_password)
VALUES ('Kyle', 'Rios', 'Kyle@kcl.ac.uk', '91 DJ Yolo Street', '07192837465', 'Other', '1995-01-01', 1900, 'Officer', '$SK3DEDd3');
INSERT INTO members (fName, lName, email, address, phoneNum, gender, dob, rating, role, hashed_password)
VALUES ('Kennedy', 'Trevino', 'Kennedy@kcl.ac.uk', '91 DJ Yolo Street', '07192837465', 'Other', '1995-01-01', 1600, 'Officer', '$SK3DEDd3');
INSERT INTO members (fName, lName, email, address, phoneNum, gender, dob, rating, role, hashed_password)
VALUES ('Gracelyn', 'Hampton', 'Gracelyn@kcl.ac.uk', '91 DJ Yolo Street', '07192837465', 'Other', '1995-01-01', 1100, 'Officer', '$SK3DEDd3');

INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('Coffee Morning', 'Come to the cafe and enjoy a hot drink while meeting society members', '2019-12-05 10:00:00', '2019-11-18 00:00:00', '2019-12-05 12:00:00');
INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('Pub Quiz', 'Get to know society members with a little friendly competition', '2019-12-07 17:00:00', '2019-11-18 00:00:00', '2019-12-07 21:00:00');
INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('Awards Ceremony', 'Come and celebrate the achievements of our society members', '2020-04-01 14:00:00', '2020-02-01 00:00:00', '2020-04-01 21:00:00');

INSERT INTO news (title, authorID, description, releaseDate, expiryDate)
VALUES ('Congratulations Hubert Schoen!', 1, 'Thanks to all who participated in the tournament yesterday, and a special congratulations to our 3 winners:
3rd place: Shumeng Liu
2nd place: Seth Warren
1st place: Hubert Schoen
Hope everyone had a good time yesterday! Just as a heads up next week will be the last session of the semester! So, if you haven''t been able to come at all this semester or have missed a few sessions make sure come next week and have some fun before the semester ends!', '2019-11-27 19:27:00', '2020-01-01 00:00:00');
INSERT INTO news (title, authorID, description, releaseDate, expiryDate)
VALUES ('Upcoming tournament!', 1, 'Hey guys!
Hope you had a great week and weekend! Congratulations to all of you who played in the 20/20 for performing so well and if you haven''t had enough of chess tournaments we will be organising another one tomorrow!

At tomorrow''s session, we will have another blitz tournament with the time control of 5 minutes! Please arrive around 6:15pm to sign up for the tournament! Last signups are at 6:30pm so make sure to come before that! This will be the last tournament of the semester so please come and have a go at winning our awesome prizes! ', '2019-11-25 18:23:00', '2019-12-25 00:00:00');
INSERT INTO news (title, authorID, description, releaseDate, expiryDate)
VALUES ('London Chess Classic', 1, 'Hi everyone!
The London Chess Classic (the final part of the grand chess tour) is coming up soon! It will be from Dec 2nd to the 8th! This is a huge chess event because the famous Magnus Carlsen will be in it! 

If you are interested, you can play in it yourself! There are many different types, it includes the classic (time limit of 90mins), the rapid (15mins with increment), and the blitz (3 mins with increment). A few people from the committee last year and this year will be playing in it! This is a great opportunity for those of you who''ve never played in a tournament to go and try it out and for those of you who are more experienced a great chance to play and win some money!!!', '2019-11-21 12:49:00', '2019-12-10 00:00:00');

INSERT INTO tournaments(name, signupDeadline)
VALUES ('The Grandest Of The Grandmasters', '2019-12-10');
INSERT INTO tournaments(name, signupDeadline)
VALUES ('Quest of the Best Beginner', '2019-12-21');
