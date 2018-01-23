<?php
if (isset($_POST) && isset($_FILES) && isset($_FILES['testfile'])) {
    $file_name = $_FILES['testfile']['name'];
    $tmp_file = $_FILES['testfile']['tmp_name'];
    $uploads_dir = 'test2/';
    $path_info = pathinfo($uploads_dir . $file_name);
    if ($path_info['extension'] === 'json') {
        move_uploaded_file($tmp_file, $uploads_dir . $file_name);
        //echo 'Спасибо, Ваш тест загружен!';
        header('Location: ' . 'list.php');
    }else{
        echo 'Извините, нужен файл с расширением JSON';
    }
}
?>
    <!doctype html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Загрузить тест</title>
    </head>
    <body>

    <form method="post" enctype=multipart/form-data>
        <input type=file name=testfile>
        <input type=submit value=Загрузить>
    </form>

    <ul>
        <li><a href="admin.php">Загрузить тест</a></li>
        <li><a href="list.php">Список тестов</a></li>
    </ul>
    </body>
    </html>

