
SET time_zone = '-8:00';
CREATE TABLE users (
  idUsers int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  uidUsers TINYTEXT NOT NULL,
  emailUsers TINYTEXT NOT NULL,
  pwdUsers LONGTEXT NOT NULL,
  firstName TINYTEXT NOT NULL,
  lastName TINYTEXT NOT NULL,
  userBirthday date NOT NULL,
  phoneNumber bigint(11) NOT NULL,
  securityQuestion1 TINYTEXT NOT NULL,
  securityQuestion2 TINYTEXT NOT NULL,
  securityAnswer1 TINYTEXT NOT NULL,
  securityAnswer2 TINYTEXT NOT NULL,
  UserActivation_code TINYTEXT NOT NULL,
  Email_Status TINYTEXT NOT NULL,
  LoginCount int(10) NOT NULL,
  Date date NOT NULL,
  OldDate date NOT NULL,

);
