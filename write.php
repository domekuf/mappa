<?
$testo=$_GET['testo'];
$class=$_GET['class'];
$rot=$_GET['rot'];


$myfile = fopen("list.html", "a");
$txt='<div class="btn btn-'.$class.' draggable '.(trim($rot)=='true'?'vertical':'').'"><i class="glyphicon glyphicon-pushpin "> </i> '.$testo.'</div>';
fwrite($myfile, $txt);
//echo fread($myfile,filesize("list.html"));
fclose($myfile);

?>