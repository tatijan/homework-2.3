<?php
$file_list = glob('test2/*.json');
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список тестов</title>
</head>
<body>

<?php
foreach ($file_list as $key => $file) {
    $file_test = file_get_contents($file);
    $decode_file = json_decode($file_test, true);
    //var_dump($decode_file);
    foreach ($decode_file as $test) {
        $question = $test['question'];
        echo "<a href=\"test.php?test=$key\">$question</a><br>";
    }
}
?>

<ul>
    <li><a href="admin.php">Загрузить тест</a></li>
    <li><a href="list.php">Список тестов</a></li>
</ul>

</body>
</html>

