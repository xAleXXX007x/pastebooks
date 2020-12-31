<?php
  require_once '../settings.php';

  $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
  $password = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

  $mysql = new mysqli($DB_ADDRESS, $DB_USER, $DB_PASSWORD, $DB_NAME);

  if($mysql) {
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    $result = $mysql->query("SELECT * FROM `$USERS_TABLE` WHERE `$LOGIN_COLUMN` = '$login'");
    $user = $result->fetch_assoc();
    $mysql->close();
    
    if ($result->num_rows == 0 || !password_verify($password, $user[$PASSWORD_COLUMN])) {
      echo 'Incorrect login or password';
      exit();
    }

    if ($user[$BANNED_COLUMN] != 0) {
      echo 'The Ban Hammer has spoken!';
      exit();
    }

    setcookie('user', $user['id'], time() + $COOKIE_TIME, '/');

    header("Location: ../index.php");
    $mysql->close();
  } else {
    echo "Ошибка подключения к БД";
  }
