CREATE DATABASE dbmang;

USE dbmang;

DROP TABLE IF EXISTS courseInfo;

CREATE TABLE courseInfo (
  courseNum INT(11),
  courseName VARCHAR(100),
  startTime VARCHAR(5),
  endTime VARCHAR(5),
  roomID VARCHAR(6),
  PRIMARY KEY (courseNum),
  FOREIGN KEY(roomID) REFERENCES classroomInfo(roomID)
  ON DELETE SET NULL
  ON UPDATE CASCADE
);

CREATE TABLE classroomInfo (
  roomID INT(6) PRIMARY KEY,
  roomNum INT(3),
  location VARCHAR(100),
  capacity INT(3),
  courseNum INT(11)
);

insert into courseInfo values
('7700201', 'American Sign Language III', '15:30', '16:45', 'Pol434'),
('3460316', 'Data Structures', '12:15', '13:30', 'CAS134'),
('3470461', 'Applied Statistics', '14:00', '15:15', 'CAS140'),
('3460475', 'Database Management', '15:30', '16:45', 'CAS134');

insert into classroomInfo values
('Pol', '434', 'Polsky', '30'),
('CAS', '134', 'College of Arts & Sciences', '30'),
('CAS', '134', 'College of Arts & Sciences', '30');


