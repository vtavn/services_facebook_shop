<?php	                                       			
session_start();
$image_width = 150;
$image_height = 34;
$characters_on_image = 4;
$font = '../giaodien/monofont.ttf';
$possible_letters = '0123456789';
$random_dots = 0;
$random_lines = 4;
$captcha_text_color="#000000";
$captcha_noice_color = "#ffffff";

$code = '';
 
$i = 0;
while ($i < $characters_on_image) { 
$code .= substr($possible_letters, mt_rand(0, strlen($possible_letters)-1), 1);
$i++;
}
$font_size = $image_height * 0.80;
$image = @imagecreate($image_width, $image_height);
$background_color = imagecolorallocate($image, 255, 255, 255);
$arr_text_color = hexrgb($captcha_text_color);
$text_color = imagecolorallocate($image, $arr_text_color['red'], 
		$arr_text_color['green'], $arr_text_color['blue']);
$arr_noice_color = hexrgb($captcha_noice_color);
$image_noise_color = imagecolorallocate($image, $arr_noice_color['red'], 
		$arr_noice_color['green'], $arr_noice_color['blue']);
for( $i=0; $i<$random_dots; $i++ ) {
imagefilledellipse($image, mt_rand(0,$image_width),
 mt_rand(0,$image_height), 2, 3, $image_noise_color);
}
for( $i=0; $i<$random_lines; $i++ ) {
imageline($image, mt_rand(0,$image_width), mt_rand(0,$image_height),
 mt_rand(0,$image_width), mt_rand(0,$image_height), $image_noise_color);
}
$textbox = imagettfbbox($font_size, 0, $font, $code); 
$x = ($image_width - $textbox[4])/2;
$y = ($image_height - $textbox[5])/2;
imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code);
header('Content-Type: image/png');
imagejpeg($image);//showing the image
imagedestroy($image);//destroying the image instance
$_SESSION['captcha'] = $code;

function hexrgb ($hexstr){
  $int = hexdec($hexstr);
  return array("red" => 0xFF & ($int >> 0x10),
               "green" => 0xFF & ($int >> 0x8),
               "blue" => 0xFF & $int);
}
?>