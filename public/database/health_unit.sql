-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22-Ago-2020 às 19:30
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `health_unit`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `medical_record`
--

CREATE TABLE `medical_record` (
  `id` int(11) NOT NULL,
  `cpf_patient_fk` varchar(14) NOT NULL,
  `result` float NOT NULL,
  `gravity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `patient`
--

CREATE TABLE `patient` (
  `cpf` varchar(14) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `date_of_birth` varchar(10) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `naturalness` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `symptom`
--

CREATE TABLE `symptom` (
  `id` int(11) NOT NULL,
  `cpf_patient_fk` varchar(14) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medical_record`
--
ALTER TABLE `medical_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medical_record_fk` (`cpf_patient_fk`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`cpf`);

--
-- Indexes for table `symptom`
--
ALTER TABLE `symptom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `symptom_fk` (`cpf_patient_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medical_record`
--
ALTER TABLE `medical_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `symptom`
--
ALTER TABLE `symptom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `medical_record`
--
ALTER TABLE `medical_record`
  ADD CONSTRAINT `medical_record_fk` FOREIGN KEY (`cpf_patient_fk`) REFERENCES `patient` (`cpf`);

--
-- Limitadores para a tabela `symptom`
--
ALTER TABLE `symptom`
  ADD CONSTRAINT `symptom_fk` FOREIGN KEY (`cpf_patient_fk`) REFERENCES `patient` (`cpf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
