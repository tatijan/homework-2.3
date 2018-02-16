<?php
if (!empty($_POST['name_form']))
{
    $name = $_POST['name_form'];
    $im = imagecreatetruecolor(480, 480);
    $backColor = imagecolorallocate($im, 255, 224, 221);
    $textColor = imagecolorallocate($im, 129, 15, 90);
    $fontFile = __DIR__ . 'src/assets/FONT.ttf';
    $imBox = imagecreatefromjpeg(__DIR__ . 'src/assets/66.jpeg');
    imagefill($im, 0, 0, $backColor);
    imagecopy($im, $imBox, 10, 10, 0, 0, 1280, 906);
    imagettftext($im, 30, 0, 30, 130, $textColor, $fontFile, $name);
    header('Content-Type: image/jpeg');
    imagejpeg($im);
    imagedestroy($im);
}
