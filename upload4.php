<?php
// Nelle versioni di PHP precedenti alla 4.1.0 si deve utilizzare  $HTTP_POST_FILES anzichè
// $_FILES.


//$uploaddir = '/var/public/';
//$uploadfile = $uploaddir . basename($_FILES['files']['name']);
echo '<pre>';
$folder=$_POST["folder"];
foreach ($_FILES["files"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["files"]["tmp_name"][$key];
        $name = $_FILES["files"]["name"][$key];
        move_uploaded_file($tmp_name,$_SERVER["DOCUMENT_ROOT"].'/mappa/file.jpg');
    }
}


//if (move_uploaded_file($_FILES['files[]']['tmp_name'], $uploadfile)) {
//    echo "File is valid, and was successfully uploaded.\n";
//    echo  $uploadfile;
//} else {
//    echo "Possibile attacco tramite file upload!\n";
//    echo $uploadfile;
//}
//
//echo 'Alcune informazioni di debug:';
//print_r($_FILES);

print "</pre>";

?>