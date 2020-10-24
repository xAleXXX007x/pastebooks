<?php
  require_once 'settings.php';
  require_once 'lib/parsedown.php';

  $parsedown = new Parsedown();
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <title>Создать документ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="container mt-4">
      <?php
        if (isset($_GET['id'])) {
          $dir = $TEXT_DIR;
          $path = $dir.$_GET['id'].'.txt';

          if (file_exists($path)) {
            $text = file_get_contents($path);
            echo $parsedown->text($text);
          } else {
            echo "Файл не найден.";
          }
        } else {
          echo "Файл не найден.";
        }
      ?>
    </div>
  </body>
</html>
