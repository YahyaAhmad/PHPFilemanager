<?php

define('ROOTPATH', $_SERVER['DOCUMENT_ROOT']);
session_start();

CheckUsername();
echo ini_get('upload_max_filesize');
$path = str_replace('root',ROOTPATH."/filemanager/directories/{$_SESSION['username']}",$_POST['path']);
if($_FILES['file']['error']==0)
move_uploaded_file($_FILES['file']['tmp_name'], "{$path}/{$_FILES['file']['name']}");
else
echo $_FILES['file']['error'];
die("Uploaded!");


?>


<?php

function CheckUsername(){
    if(empty($_SESSION['username']) || empty($_SESSION['password'])){
        die ("PERMESSION DENIED!");
    }
}

?>