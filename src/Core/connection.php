<?php

$config  = require __DIR__ . '/../../config/database.php';

try {

    $pdo = new PDO('sqlite:' . $config['sqlite']['database']);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;

} catch (PDOException $e) {

    die('Database connection failed: ' . $e->getMessage());
}