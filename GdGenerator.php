<?php
error_reporting(E_ALL);
class GdGenerator {
    public function generate($userName, $correct) {
        $image = imagecreatetruecolor(905, 1280);
        $backColor = imagecolorallocate($image, 50, 50, 50); //цвет для фона
        $textColor = imagecolorallocate($image, 51, 0, 204); //цвет для текста
        $fontFile = __DIR__ . '/assets/1.ttf';  // файл шрифта
        $imBox = imagecreatefrompng(__DIR__ . '/assets/certificate.png');  //создаем картинку из png файла
        imagefill($image, 0, 0, $backColor);  //заливаем картинку фоновым цветом
        imagecopy($image, $imBox, 0, 0, 0, 0, 905, 1280);   // dst_im, src_im, dst_x, dst_y, src_x, src_y, src_w, src_h
        imagettftext($image, 80, 0, 260, 540, $textColor, $fontFile, $userName);   // $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text
        imagettftext($image, 60, 0, 180, 800, $textColor, $fontFile, $correct);
        header('Content-type: image/png');
        imagepng($image);   // псоле этой строки в браузер уходит картинка
        imagedestroy($image);
        imagedestroy($imBox);
    }
}