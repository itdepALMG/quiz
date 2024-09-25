<?php
  $host = 'localhost';
  $port = '3309'; // Replace with your port number if different
  $db = 'ch';
  $user = 'root';
  $pass = '12345';
  $charset = 'utf8mb4';

  $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
  $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
  ];