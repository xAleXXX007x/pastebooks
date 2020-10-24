<?php
  require_once '../settings.php';

  $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
  $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

  if ($PASSWORD_ENCODE_SUGAR != '') {
    $pass = md5($pass.$PASSWORD_ENCODE_SUGAR);
  }

  $mysql = new mysqli('localhost', 'root', 'root', 'books');
  if($mysql) {
    $result = $mysql->query("SELECT * FROM `$USERS_TABLE` WHERE `$LOGIN_COLUMN` = '$login' AND `$PASSWORD_COLUMN` = '$pass'");
    $user = $result->fetch_assoc();

    if ($result->num_rows == 0) {
      echo "Пользователь не найден";
      exit();
    }

    setcookie('user', $user['id'], time() + $COOKIE_TIME, '/');

    header("Location: ../index.php");
    $mysql->close();
  } else {
    echo "Ошибка подключения к БД";
  }
