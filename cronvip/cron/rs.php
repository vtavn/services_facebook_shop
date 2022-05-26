<?php
function remove_allFile($dir) {
if ($handle=opendir("$dir")) {
while (false!== ($item=readdir($handle))) {
if ($item!="."&&$item!="..") {
if (is_dir("$dir/$item")) {
remove_directory("$dir/$item");
} else {
unlink("$dir/$item");
}
}
}
closedir($handle);

}
}
remove_allFile("log");

$text = '';
$file = fopen("vipBot.log.txt", "w+");
fwrite($file, $text);
fclose($file);

?>