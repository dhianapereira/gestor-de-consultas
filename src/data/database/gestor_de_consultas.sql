CREATE DATABASE gestor_de_consultas;

USE gestor_de_consultas;

CREATE TABLE patient (
  cpf VARCHAR(14) NOT NULL,
  full_name VARCHAR(100) NOT NULL,
  genre VARCHAR(50) NOT NULL,
  date_of_birth DATE NOT NULL,
  mother_name VARCHAR(100) NOT NULL,
  companion VARCHAR(100) NOT NULL,
  address VARCHAR(100) NOT NULL,
  naturalness VARCHAR(50) NOT NULL,
  photograph VARCHAR(100) NOT NULL,
  active  BOOLEAN DEFAULT 1,
  CONSTRAINT patient_pk PRIMARY KEY (cpf)
);

CREATE TABLE doctor ( 
  id INT(11) NOT NULL AUTO_INCREMENT, 
  name VARCHAR(100) NOT NULL,
  genre VARCHAR(50) NOT NULL,
  specialty VARCHAR(100) NOT NULL,
  active BOOLEAN DEFAULT 1, 
  CONSTRAINT user_pk PRIMARY KEY (id) 
);

CREATE TABLE room ( 
  id INT(11) NOT NULL AUTO_INCREMENT,
  type VARCHAR(100) NOT NULL,
  status BOOLEAN DEFAULT 0,  
  CONSTRAINT room_pk PRIMARY KEY (id) 
);

CREATE TABLE medical_appointment (
  id INT(11) NOT NULL AUTO_INCREMENT,
  cpf_patient_fk VARCHAR(14) NOT NULL,
  id_doctor_fk INT(11) NOT NULL,
  id_room_fk INT(11) NOT NULL,
  time TIME NOT NULL,
  date DATE NOT NULL,
  arrival_time TIME,
  status VARCHAR(50) NOT NULL,
  CONSTRAINT medical_appointment_pk PRIMARY KEY (id),
  CONSTRAINT medical_appointment_fk1 FOREIGN KEY (cpf_patient_fk)
  REFERENCES patient (cpf), 
  CONSTRAINT medical_appointment_fk2 FOREIGN KEY (id_doctor_fk)
  REFERENCES doctor (id),
  CONSTRAINT medical_appointment_fk3 FOREIGN KEY (id_room_fk)
  REFERENCES room (id)
);

CREATE TABLE user ( 
  cpf VARCHAR(14) NOT NULL,
  name VARCHAR(100) NOT NULL, 
  genre VARCHAR(50) NOT NULL,
  date_of_birth DATE NOT NULL,
  naturalness VARCHAR(50) NOT NULL,
  responsibility VARCHAR(50) NOT NULL,
  address VARCHAR(100) NOT NULL,
  username VARCHAR(100),
  password VARCHAR(100),
  active BOOLEAN DEFAULT 1,  
  CONSTRAINT user_pk PRIMARY KEY (cpf) 
);


INSERT INTO user (cpf, name, genre, date_of_birth, naturalness, 
address, responsibility, username, password) 
VALUES ("123.123.123-12", "Administrador", "Feminino", "1999-05-14",
"Brasileiro(a)", "Endereço", "Administrador", "admin", "123");