<?

$myfile = fopen("list.html", "w+");
$txt=' ';
fwrite($myfile, $txt);
//echo fread($myfile,filesize("list.html"));
fclose($myfile);

?>