<?php
session_start();
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
    echo 'Только метод POST';
    exit;
}
function mb_ucfirst($string, $enc = 'UTF-8')
{
    return mb_strtoupper(mb_substr($string, 0, 1, $enc), $enc) .
        mb_substr($string, 1, mb_strlen($string, $enc), $enc);
}
if (isset($_POST['userName'])) {
    $_SESSION['userName'] = mb_ucfirst( mb_strtolower( trim( htmlspecialchars($_POST['userName']) ) ) );
}
$tests = $_SESSION['tests'];
$correct = 0;
$wrong = 0;
for ($i=0; $i < count($tests); $i++) {
    if (isset($_POST["ans$i"])) {
        // echo $_POST["ans$i"] . " - " . $tests[$i]['correct'] . "<br>" ; //  - проверка
        if ( $_POST["ans$i"] == $tests[$i]['correct'] ) {
            $correct++;
        } else {
            $wrong++;
        }
    }
}
// echo $_SESSION['userName'] . ' вы ответили правильно на ' . $correct . ' вопрос(а)';
include_once __DIR__ . '/../src/GdGenerator.php';
$imgGenerator = new GdGenerator();
if ($correct <= 3) {
    echo "Вы ответили правильно на $correct вопрос(а) <br>";
    echo "Но этого недостаточно для получения сертификата. Пройдите тест заново";
    ?>
    <a class="back" href="test.php?testName=<?php echo $_SESSION['testName']?>">
        <input type="button" value="вернуться к выбору теста">
    </a>

    <?php
}
elseif ($correct === 4) {
    $correct = 'Хорошо';
    $imgGenerator->generate($_SESSION['userName'], $correct);
}
else {
    $correct = 'Отлично';
    $imgGenerator->generate($_SESSION['userName'], $correct);
}
?>