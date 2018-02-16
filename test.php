<?php
session_start();
error_reporting(E_ALL);
if (isset($_GET['testName'])) {
    $_SESSION['testName'] = $_GET['testName'];
    $testName = $_SESSION['testName'];
    if (file_exists('../Tests/' . $testName)) {
        $JSONfile = file_get_contents('../Tests/' . $testName);
        $_SESSION['tests'] = json_decode($JSONfile, true);
        $tests = $_SESSION['tests'];
    } else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        header("Refresh: 2; url='list.php'");
        echo 'Такого теста нет' . PHP_EOL;
        exit;
    }
} else {
    header("Refresh: 2; url='list.php'");
    echo 'Тест не выбран!!' . PHP_EOL;
    exit;
}
$count = 1;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        body {
            width: 800px;
            margin-left: 100px;
        }
        ul {
            width: 100%;
            list-style-type: none;
        }
        li {
            border-bottom: 1px solid rgba(0,0,0,0.2);
        }
        .back {
            display: block;
            padding-top: 30px;
        }
    </style>
</head>
<body>
<form action="check.php" method="POST">
    <h4>
        <?php if (empty($_SESSION['userName'] )): ?>
            <label for="userName">Введите свое имя</label>
            <input type="text" name="userName" required>
        <?php else :
            echo $_SESSION['userName'];
            ?>
        <?php endif ?>
    </h4>
    <h3>Выберите правильные ответы</h3>
    <ul>
        <?php
        for ($i=0; $i < count($tests); $i++) : ?>
            <li>
                <p>Вопрос №<?= $count++ . '. ' . $tests[$i]['question'] ?> </p>
                <p class="variants">
                    <?php foreach ($tests[$i]['answer'] as $key => $value) : ?>
                        <input type="radio" name="ans<?=$i?>" value="<?=$key?>" required> <?= $value ?> <br>
                    <?php endforeach ?>
                </p>
            </li>
        <?php endfor ?>
        <input type="submit" name="submit" value="Проверить">
    </ul>
</form>

<p>Правильные ответы все 1-ые</p>
<a class="back" href="list.php">
    <input type="button" value="вернуться к выбору теста">
</a>
</body>
</html>