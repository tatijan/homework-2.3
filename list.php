<?php
error_reporting(E_ALL);
$list = glob('../Tests/*');
if (empty($list)) {
    header("Refresh: 2; url='admin.php'");
    echo 'ни одного теста не загружено';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        * {
            margin: 20px;
        }
    </style>
</head>
<body>

<h1>Выберите тест</h1>

<form action="test.php" method="GET">
    <label> Выберите номер теста </label>
    <select name="testName" id="testName" size="10">
        <?php
        foreach($list as $id => $file):
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $baseName = pathinfo($file, PATHINFO_BASENAME) ?>
            <option value="<?= $baseName ?>"> Тест <?= $fileName ?> </option>;
        <?php endforeach ?>
    </select>
    <input type="submit" value="Send">
</form>

<a href="admin.php">
    <input type="button" value="вернуться к загрузке файлов">
</a>
</body>
</html>