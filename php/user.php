<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT']);
session_start();

//Check if user is logged in.
CheckUsername();

//Check if there is a command.
CheckCommand();

$q = $_GET['q'];
$username = $_SESSION['username'];
$path = str_replace('root', ROOTPATH."/filemanager/directories/{$username}", $_GET['path']);

if($q == "getfiles"){

    GetFiles($username,$path);

}

if($q == "download"){
    Download($username,$path);
}

if($q == 'delete'){
    Delete($username,$path);
}


?>




<?php

function CheckUsername(){
    if(empty($_SESSION['username']) || empty($_SESSION['password'])){
        die ("PERMESSION DENIED!");
    }
}

function CheckCommand(){
    if(empty($_GET['q'])){
        die ("No written command!");
    }
}


function GetFiles($username,$path){


        $files = array_diff(scandir($path), array('.', '..'));
        $data = [];
        foreach ($files as $file) {
            $type = '';
            if(is_dir($path.'/'.$file))
                $type = 'dir';
            else
                $type = 'file';

            array_push($data,["name" => $file, "type" => $type]);
        }
        
        echo json_encode($data);


    


}

function Download($username, $path){

    if(file_exists($path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($path).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        flush(); // Flush system output buffer
        readfile($path);
        exit;
    }
}

function Delete($username,$path){

    if(is_dir($path))
        {
            DeleteDirectoryRec($path);
        }
    else
        unlink($path);
    exit;
}

function DeleteDirectoryRec($path){
    $files = glob($path . '/*');
            foreach ($files as $file){
                echo $file;
                if (is_dir($file))
                    DeleteDirectoryRec($file); //Recursive.
                else
                    unlink($file);

            }
            rmdir($path);
}

?>