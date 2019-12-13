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

DROP TABLE IF EXISTS blacklist;
CREATE TABLE blacklist (
  email VARCHAR(255),
  PRIMARY KEY (email)
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
  FOREIGN KEY (tournamentID) REFERENCES tournaments(id) ON DELETE CASCADE,
  FOREIGN KEY (organiserID) REFERENCES members(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS tournamentCompetitors;
CREATE TABLE tournamentCompetitors (
  tournamentID INT,
  competitorID INT,
  initrating INT,
  UNIQUE (tournamentID, competitorID),
  FOREIGN KEY (tournamentID) REFERENCES tournaments(id) ON DELETE CASCADE,
  FOREIGN KEY (competitorID) REFERENCES members(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS tournamentMatches;
CREATE TABLE tournamentMatches (
  id INT NOT NULL AUTO_INCREMENT,
  tournamentID INT NOT NULL,
  roundNum INT NOT NULL,
  matchDate DATETIME NOT NULL,
  competitorID1 INT,
  competitorID2 INT,
  winner INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (competitorID1) REFERENCES members(id) ON DELETE CASCADE,
  FOREIGN KEY (competitorID2) REFERENCES members(id) ON DELETE CASCADE,
  FOREIGN KEY (tournamentID) REFERENCES tournaments(id) ON DELETE CASCADE
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
INSERT INTO members (fName, lName, email, address, phoneNum, gender, dob, rating, role, hashed_password)
VALUES ('Demetrius', 'Levenworth', 'Levenworth@kcl.ac.uk', '111 Halloumi Street', '077777777', 'Other', '1998-01-01', 1600, 'System Admin', '$2y$10$f2bv37dQwmvj.l/tkh/nG.aFzQ8OII7yzuNbApuR6d63650CJ/4wu');
INSERT INTO members (fName, lName, email, address, phoneNum, gender, dob, rating, role, hashed_password)
VALUES ('Serge', 'LeMans', 'lemans@kcl.ac.uk', '111 Halloumi Street', '0777332574', 'Other', '1998-01-01', 1500, 'Officer', '$2y$10$rvav2vjDh2d5umrLE2zyYuPxwAz4JE2yoV9IZ3Az7TkAyj5ErWpU.');
INSERT INTO members (fName, lName, email, address, phoneNum, gender, dob, rating, role, hashed_password)
VALUES ('Xena', 'Wobbles', 'Wobbles@kcl.ac.uk', '111 Halloumi Street', '0747332574', 'Other', '1998-01-01', 1400, 'Member', '$2y$10$rvav2vjDh2d5umrLE2zyYuPxwAz4JE2yoV9IZ3Az7TkAyj5ErWpU.');
INSERT INTO members (fName, lName, email, address, phoneNum, gender, dob, rating, role, hashed_password)
VALUES ('Contessa', 'Raylene', 'Raylene@kcl.ac.uk', '111 Camembert Street', '0747332574', 'Other', '1998-01-01', 1400, 'Member', '$2y$10$cJTVB5pyJUpz.z/dTRQyFuPhrkXA/kLg7h52TSdfNlnzbih5CRmFy');
INSERT INTO members (fName, lName, email, address, phoneNum, gender, dob, rating, role, hashed_password)
VALUES ('Dolly', 'Unicycle', 'Unicycle@kcl.ac.uk', '111 Camembert Street', '0747332574', 'Other', '1998-01-01', 1400, 'Officer', '$2y$10$a66q8wvlWqhjUm4FxHNysOVu8kFn9cCjQOjBayrq01JCImKYsgdPu');

INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('Coffee Morning', 'Come to the cafe and enjoy a hot drink while meeting society members', '2019-12-05 10:00:00', '2019-11-18 00:00:00', '2019-12-05 12:00:00');
INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('Pub Quiz', 'Get to know society members with a little friendly competition', '2019-12-07 17:00:00', '2019-11-18 00:00:00', '2019-12-07 21:00:00');
INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('Awards Ceremony', 'Come and celebrate the achievements of our society members', '2020-04-01 14:00:00', '2020-02-01 00:00:00', '2020-04-01 21:00:00');
INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('Meet&Greet w/ Magnus Carlsen', 'Enjoy an excellent presentation, as well as a meet and greet, with chess legend Magnus Carlsen', '2020-01-14 15:30:00', '2020-01-01 00:00:00', '2020-02-01 00:00:00');
INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('Yearly Meeting', 'Join us in deciding the future of the chess society! All members have the right to vote.', '2020-09-03 12:00:00', '2019-12-01 00:00:00', '2020-09-05 00:00:00');
INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('Masterclass', 'Want to become the next Magnus Carlsen? Sign up for this Masterclass to learn every quirk about chess!', '2020-01-21 17:30:00', '2020-12-15 00:00:00', '2020-01-28 21:00:00');
INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('Feeding the homeless', 'Homeless people are starving, so bring coffee and biscuits', '2021-11-30 10:00:00', '2020-02-01 00:00:00', '2022-01-01 23:59:00');
INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('Learn How to Cook', 'Gordon Ramsay is visiting KCLCS, and he\'ll show us where the lamb sauce is', '2019-12-31 23:49:00', '2019-12-01 00:00:00', '2020-04-01 21:00:00');
INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('Dissolve the government', 'In their never-ending quest to babysit each and every British citizen, the government has decided that chess is a taxable offense.', '2023-06-01 14:00:00', '2018-02-01 00:00:00', '2025-04-01 21:00:00');
INSERT INTO societyEvents (name, description, eventDate, releaseDate, expiryDate)
VALUES ('The End Times', 'The end is nigh, and the doors to hell stand open', '2029-12-01 00:00:00', '2019-12-24 00:00:00', '2029-12-31 21:00:00');




INSERT INTO news (title, authorID, description, releaseDate, expiryDate)
VALUES ('Congratulations Hubert Schoen!', 4, 'Thanks to all who participated in the tournament yesterday, and a special congratulations to our 3 winners:
3rd place: Shumeng Liu
2nd place: Seth Warren
1st place: Hubert Schoen
Hope everyone had a good time yesterday! Just as a heads up next week will be the last session of the semester! So, if you haven''t been able to come at all this semester or have missed a few sessions make sure come next week and have some fun before the semester ends!', '2019-11-27 19:27:00', '2020-01-01 00:00:00');
INSERT INTO news (title, authorID, description, releaseDate, expiryDate)
VALUES ('Upcoming tournament!', 4, 'Hey guys!
Hope you had a great week and weekend! Congratulations to all of you who played in the 20/20 for performing so well and if you haven''t had enough of chess tournaments we will be organising another one tomorrow!

At tomorrow''s session, we will have another blitz tournament with the time control of 5 minutes! Please arrive around 6:15pm to sign up for the tournament! Last signups are at 6:30pm so make sure to come before that! This will be the last tournament of the semester so please come and have a go at winning our awesome prizes! ', '2019-11-25 18:23:00', '2019-12-25 00:00:00');
INSERT INTO news (title, authorID, description, releaseDate, expiryDate)
VALUES ('London Chess Classic', 4, 'Hi everyone!
The London Chess Classic (the final part of the grand chess tour) is coming up soon! It will be from Dec 2nd to the 8th! This is a huge chess event because the famous Magnus Carlsen will be in it! 

If you are interested, you can play in it yourself! There are many different types, it includes the classic (time limit of 90mins), the rapid (15mins with increment), and the blitz (3 mins with increment). A few people from the committee last year and this year will be playing in it! This is a great opportunity for those of you who''ve never played in a tournament to go and try it out and for those of you who are more experienced a great chance to play and win some money!!!', '2019-11-21 12:49:00', '2019-12-10 00:00:00');

INSERT INTO news (title, authorID, description, releaseDate, expiryDate)
VALUES ('Nominations for society of the year!', 4, 'Hi everyone! 
  We are nominated for the KCLSU award of society of the year. If you would like to vote for us, please do so. It really helps.', '2019-12-13 12:49:00', '2019-12-31 00:00:00');
INSERT INTO news (title, authorID, description, releaseDate, expiryDate)
VALUES ('Thank you for your service!', 4, 'As of today, our beloved president is stepping down. It has been a good 3 years, and we wish you all the Best
  in your continued adventures. We are now without a leader!', '2019-11-25 11:13:47', '2020-12-10 00:00:00');
INSERT INTO news (title, authorID, description, releaseDate, expiryDate)
VALUES ('Take to the streets!', 4, 'Today we march in unwavering support of the global communist revolution. The Bourgeoisie must be sent to the GULAGS!', 
  '2021-05-21 19:23:00', '2025-12-10 00:00:00');
INSERT INTO news (title, authorID, description, releaseDate, expiryDate)
VALUES ('The chess society is expanding', 4, 'We are glad to announce that the LSE Chess Society has bought the KCL Chess society. From now on, all members must transfer to LSE to remain in
  our society.', '2019-12-01 23:00:00', '2019-12-27 00:00:00');


INSERT INTO tournaments(name, signupDeadline)
VALUES ('King\'s Blitz Blast', '2019-11-13');
INSERT INTO tournaments(name, signupDeadline)
VALUES ('The Grandest Of The Grandmasters', '2019-12-10');
INSERT INTO tournaments(name, signupDeadline)
VALUES ('Quest of the Best Beginner', '2019-12-21');
INSERT INTO tournaments(name, signupDeadline)
VALUES ('Junior Chess Championships', '2019-12-31');
INSERT INTO tournaments(name, signupDeadline)
VALUES ('Northwick Park Five', '2020-01-13');
INSERT INTO tournaments(name, signupDeadline)
VALUES ('King\'s Open Championships', '2020-01-26');
INSERT INTO tournaments(name, signupDeadline)
VALUES ('UoL Masters', '2020-02-01');
INSERT INTO tournaments(name, signupDeadline)
VALUES ('LSE Showmatch', '2020-03-04');






