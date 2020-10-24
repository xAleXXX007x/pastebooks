<?php
  require_once 'settings.php';
  require_once 'lib/encoding.php';
  require_once 'lib/parsedown.php';

  if (isset($_COOKIE['user'])) {
    $parsedown = new Parsedown();

    if (isset($_POST['save'])) {
      $dir = $TEXT_DIR;

      $id = uniqueLink($_COOKIE['user']);

      if (file_exists($dir.$id.'.txt')) {
        $id = $id.'1';
      }

      file_put_contents($dir.$id.'.txt', $_POST['text']);
      header("Location: view.php?id=".$id);
    }
  }
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
        if (!isset($_COOKIE['user'])):
      ?>
      
      <?php else: ?>
        <div class="container mt-4">
          <div class="row">
            <div class="col">
              <form method="POST">
                <textarea class="form-control" id="text" name="text"><?php if (isset($_POST['text'])) { echo $_POST['text']; }?></textarea><br>
                <div class="row">
                  <div class="col">
                    <button class="btn btn-secondary" type="submit" name="preview" value='1'>Предпросмотр</button>
                  </div>
                  <div class="col">
                    <button class="btn btn-primary" type="submit" name="save" value='1'>Сохранить</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col">
              <?php
                if (isset($_POST['text'])) { echo $parsedown->text($_POST['text']); }
              ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </body>
</html>
