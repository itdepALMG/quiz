<?php
  $host = 'localhost';
  $port = '3309'; // Replace with your port number if different
  $db = 'u674432606_quiz_db';
  $user = 'u674432606_quiz_db';
  $pass = 'quiz_dbALMG1';
  $charset = 'utf8mb4';

  $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
  $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
  ];
