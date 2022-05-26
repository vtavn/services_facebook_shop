<?php
$data = file_get_contents("token.txt");
$data = explode("\n", $data);
foreach ($data as $value) {
	if (!preg_match('/EAAAAAY/', $value, $match)) {
		echo  $value.'</br>';

//$fp = fopen('loc.txt', 'a+');
		//fwrite($fp, $value."\n");
		//fclose($fp);
}
	}
	?>