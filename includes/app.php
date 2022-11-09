<?php
require  __DIR__.'./../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createimmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require 'config/database.php';

//Conectar a la base de datos
$db = conectarDb();

use Dotenv\Dotenv;
use Model\ActiveRecord;


ActiveRecord::setDB($db);




