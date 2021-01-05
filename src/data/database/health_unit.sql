CREATE DATABASE health_unit;
USE health_unit;


CREATE TABLE `patient` (
  `cpf` VARCHAR(14) NOT NULL,
  `full_name` VARCHAR(100) NOT NULL,
  `genre` VARCHAR(50) NOT NULL,
  `date_of_birth` VARCHAR(10) NOT NULL,
  `mother_name` VARCHAR(100) NOT NULL,
  `companion` VARCHAR(100) NOT NULL,
  `address` VARCHAR(100) NOT NULL,
  `naturalness` VARCHAR(50) NOT NULL,
  CONSTRAINT `patient_pk` PRIMARY KEY (`cpf`)
);

CREATE TABLE `symptom` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cpf_patient_fk` VARCHAR(14) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
   CONSTRAINT `symptom_pk` PRIMARY KEY (`id`),
   CONSTRAINT `symptom_fk` FOREIGN KEY (`cpf_patient_fk`)
   REFERENCES `patient` (`cpf`)
);


CREATE TABLE `medical_records` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cpf_patient_fk` VARCHAR(14) NOT NULL,
  `result` FLOAT NOT NULL,
  `gravity` VARCHAR(50) NOT NULL,
  `start_date` VARCHAR(10) NOT NULL,
  CONSTRAINT `medical_records_pk` PRIMARY KEY (`id`),
  CONSTRAINT `medical_records_fk` FOREIGN KEY (`cpf_patient_fk`)
  REFERENCES `patient` (`cpf`)
);

CREATE TABLE `doctor` ( 
  `id` INT(11) NOT NULL AUTO_INCREMENT, 
  `name` VARCHAR(100) NOT NULL,
  `genre` VARCHAR(50) NOT NULL,
  `specialty` VARCHAR(100) NOT NULL, 
  CONSTRAINT `user_pk` PRIMARY KEY (`id`) 
);

CREATE TABLE `medical_appointment` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cpf_patient_fk` VARCHAR(14) NOT NULL,
  `id_doctor_fk` INT(11) NOT NULL,
  `time` VARCHAR(20) NOT NULL,
  `date` VARCHAR(10) NOT NULL,
  `arrival_time` VARCHAR(20),
  `realized` BOOLEAN NOT NULL,
  CONSTRAINT `medical_appointment_pk` PRIMARY KEY (`id`),
  CONSTRAINT `medical_appointment_fk1` FOREIGN KEY (`cpf_patient_fk`)
  REFERENCES `patient` (`cpf`), 
  CONSTRAINT `medical_appointment_fk2` FOREIGN KEY (`id_doctor_fk`)
  REFERENCES `doctor` (`id`) 
);

CREATE TABLE `user` ( 
  `id` INT(11) NOT NULL AUTO_INCREMENT, 
  `name` VARCHAR(100) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL, 
  `responsibility` VARCHAR(50) NOT NULL, 
  CONSTRAINT `user_pk` PRIMARY KEY (`id`) 
);