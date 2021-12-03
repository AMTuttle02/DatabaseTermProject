CREATE DATABASE dbmang;

USE dbmang;

DROP TABLE IF EXISTS courseInfo;
DROP TABLE IF EXISTS classroomInfo;
DROP TABLE IF EXISTS userInput;
DROP TABLE IF EXISTS accounts;

CREATE TABLE courseInfo (
  courseNum INT(11),
  courseName VARCHAR(100),
  startTime TIME(0),
  endTime TIME(0),
  roomID VARCHAR(100),
  Monday BOOL,
  Tuesday BOOL,
  Wednesday BOOL,
  Thursday BOOL,
  Friday BOOL,
  PRIMARY KEY (startTime, endTime, roomID, Monday, Tuesday, Wednesday, Thursday, Friday),
  FOREIGN KEY(roomID) REFERENCES classroomInfo(roomID)
  ON DELETE SET NULL
  ON UPDATE CASCADE
);

CREATE TABLE classroomInfo (
  roomID VARCHAR(6) PRIMARY KEY,
  roomNum INT(3),
  location VARCHAR(100),
  capacity INT(3)
);

CREATE TABLE userInput (
  userID INT(7),
  startTime TIME(0),
  endTime TIME(0),
  roomID VARCHAR(100),
  Monday BOOL,
  Tuesday BOOL,
  Wednesday BOOL,
  Thursday BOOL,
  Friday BOOL,
  PRIMARY KEY (startTime, endTime, roomID, Monday, Tuesday, Wednesday, Thursday, Friday),
  FOREIGN KEY(roomID) REFERENCES classroomInfo(roomID)
  ON DELETE SET NULL
  ON UPDATE CASCADE
);

CREATE TABLE `accounts` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  	`username` varchar(50) NOT NULL,
  	`password` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `accounts` (`id`, `username`, `password`) VALUES 
(1, '4673822', '$2y$10$JjOAuTgUOGYfAWdy.qtIU.DdjMcXca5Zub6WvKByfT2gEU.spv/yS'),
(2, '4190601', '$2y$10$JjOAuTgUOGYfAWdy.qtIU.DdjMcXca5Zub6WvKByfT2gEU.spv/yS'),
(3, '4673824', '$2y$10$JjOAuTgUOGYfAWdy.qtIU.DdjMcXca5Zub6WvKByfT2gEU.spv/yS');

insert into courseInfo values
('7700201', 'American Sign Language III', '15:30', '16:45', 'POL434', '1', '0', '1', '0', '0'),
('3460316', 'Data Structures', '12:15', '13:30', 'CAS134', '1', '0', '1', '0', '0'),
('3470461', 'Applied Statistics', '14:00', '15:15', 'CAS140', '1', '0', '1', '0', '0'),
('3460475', 'Database Management', '15:30', '16:45', 'CAS134', '1', '0', '1', '0', '0');

insert into classroomInfo values
('POL434', '434', 'Polsky', '30'),
('CAS134', '134', 'College of Arts & Sciences', '30'),
('CAS140', '140', 'College of Arts & Sciences', '100');

insert into userInput values
('4673822', '09:00', '10:00', 'CAS134', '0', '1', '0', '0', '0');
