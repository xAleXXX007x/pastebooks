<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <?php
      if (!isset($_COOKIE['user'])):
    ?>
      <title>Авторизация</title>
    <?php else: ?>
      <title>Профиль</title>
    <?php endif; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="container mt-4">
      <?php
        if (!isset($_COOKIE['user'])):
      ?>
      <h1 align="center">Авторизация</h1>
	  <p>Для авторизации вам нужно вбить пару логин/пароль любого из ваших активных персонажей.</p>
      <form action="php/login.php" method="POST">
        <input type="text" class="form-control" name="login" id="login" placeholder="Логин"><br>
        <input type="password" class="form-control" name="pass" id="pass" placeholder="Пароль"><br>
        <button class="btn btn-primary" type="submit">Войти</button>
      </form>

      <?php else: ?>
		<a href="php/exit.php" class="btn btn-primary main-button">Выйти</a>
		<a href="create.php" class="btn btn-primary main-button">Создать документ</a>
      <?php endif; ?>
    </div>
  </body>
</html>
