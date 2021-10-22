CREATE DATABASE dbmang;

USE dbmang;

DROP TABLE IF EXISTS courseInfo;

CREATE TABLE courseInfo (
  courseNum INT(11),
  courseName VARCHAR(100),
  startTime TIME,
  endTime Time,
  PRIMARY KEY (courseNum)
);

insert into courseInfo values
(
  VALUES ('7700 201', 'American Sign Language III', '3:30', '4:45');
  VALUES ('3460 316', 'Data Structures', '12:15', '1:30');
  VALUES ('3470 461', 'Applied Statistics', '2:00', '3:15');
  VALUES ('3460 475', 'Database Management', '3:30', '4:45');

);
