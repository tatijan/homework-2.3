<?php
$file_list = glob('test2/*.json');
$test = [];
foreach ($file_list as $key => $file) {
    if ($key == $_GET['test']) {
        $file_test = file_get_contents($file_list[$key]);
        $decode_file = json_decode($file_test, true);
        $test = $decode_file;
    }
}
// Проверяем массив test, если пустой, то 404
if (empty($test)) {
    header("HTTP/1.1 404 Not Found");
    exit;
}
$question = $test[0]['question'];
$answers[] = $test[0]['answers'];
// Считаем кол-во правильных ответов
$result_true = 0;
foreach ($answers[0] as $item) {
    if ($item['result'] === true) {
        $result_true++;
    }
}
// Проверяем и считаем правильность введенных ответов
$post_true = 0;
$post_false = 0;
$test_success = 0;
if (!empty($_POST['form_answer'])) {
    foreach ($_POST['form_answer'] as $item) {
        if ($answers[0][$item]['result'] === true) {
            $post_true++;
        }else{
            $post_false++;
        }
    }
    // Сравниваем и выводим результат
    if ($post_true === $result_true && $post_false === 0) {
        $test_success++;
    }elseif ($post_true > 0 && $post_false > 0) {
        echo 'Почти угадали =)';
    }else{
        echo 'Вы ошиблись =(';
    }
}
// создаем сертификат
if (!empty($_POST['name_form']))
{
    $name = $_POST['name_form'];
    $im = imagecreatetruecolor(480, 480);
    $backColor = imagecolorallocate($im, 255, 224, 221);
    $textColor = imagecolorallocate($im, 0, 0, 0);
    $fontFile = 'FONT.ttf';
    $imBox = imagecreatefromjpeg('dip.jpg');
    imagefill($im, 0, 0, $backColor);
    imagecopy($im, $imBox, 0, 0, 0, 0, 565, 800);
    imagettftext($im, 20, 0, 170, 392, $textColor, $fontFile, $name);
    imagettftext($im, 20, 0, 170, 420, $textColor, $fontFile, 'Оценка: отлично');
    imagettftext($im, 15, 0, 385, 745, $textColor, $fontFile, date("d.m.y"));
    imagejpeg($im, 'certificate.jpg');
    imagedestroy($im);
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Тест: <?=$question?></title>
</head>
<body>

<form method="post">
    <fieldset>
        <legend><?=$question?></legend>
        <?php foreach ($answers[0] as $key => $item) : ?>
            <label><input type="checkbox" name="form_answer[]" value="<?=$key;?>"> <?=$item['answer'];?></label>
        <?php endforeach; ?>
    </fieldset>
    <input type="submit" value="Отправить">
</form>


<?php if(!empty($test_success)): ?>
    <form method="post">
        <input type="text" name="name_form" placeholder="Введите ваше имя">
        <button>Отправить</button>
    </form>
<?php endif;?>

<?php if (!empty($_POST['name_form'])): ?>
    <img src="certificate.jpg" alt="Ваш сертификат">
<?php endif;?>



<ul>
    <li><a href="admin.php">Загрузить тест</a></li>
    <li><a href="list.php">Список тестов</a></li>
</ul>



</body>
</html>


