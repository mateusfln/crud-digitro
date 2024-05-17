<?php

use App\Model\Database;
require_once('vendor/autoload.php');
require_once('src/config/env.php');

$conn = Database::getInstance();

$conn->getConnection()->exec(
    "CREATE TABLE funcionarios (
        id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        ds_nome VARCHAR(255) NOT NULL,
        dt_nascimento DATE NOT NULL,
        ds_cpf VARCHAR(11) NOT NULL,
        ds_email VARCHAR(255) NOT NULL,
        estadocivil_id int NOT NULL);

    CREATE TABLE estado_civil (
        id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        ds_estadocivil VARCHAR(255) NOT NULL
        );");

$conn->getConnection()->exec(
    "INSERT INTO estado_civil 
    (ds_estadocivil) 
    VALUES
        ('Casado'), 
        ('Solteiro'), 
        ('Separado'), 
        ('Divorciado'), 
        ('Viúvo')");

$conn->getConnection()->exec(
    "ALTER TABLE funcionarios
    ADD CONSTRAINT fk_estadocivil
    FOREIGN KEY (estadocivil_id)
    REFERENCES estado_civil(id)");

