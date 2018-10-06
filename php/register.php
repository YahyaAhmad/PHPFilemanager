<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT']);
if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']))
{
    $data = [ 'status' => 'failed' ,'message' => 'Invalid Request. Make sure to fill the required data.' ];
    die(json_encode($data));
}

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

//Check for the input if it's valid.
CheckUsername($username);
CheckPassword($password);
CheckEmail($email);

//Connect to the database.
require('connect.php');

//Check if username already exists.
UsernameExisted($username,$con);

//If everything is okay, register the user.
RegisterUser($username,$password,$email,$con);

$data = [ 'status' => 'success' ,'message' => 'Successfully created.' ];
die(json_encode($data));

?>







<?php


function CheckUsername($username){
    global $username;
    if(strlen($username) < 3)
    {
        $data = [ 'status' => 'failed' ,'message' => 'User should have 3 letter or more.' ];
        die(json_encode($data)); 
    }

    $pattern = '~[^\w\s]~'; //Regex to check if username has special characters.
    if(preg_match($pattern,$username)){
        $data = [ 'status' => 'failed', 'message' => 'User should not have special characters.' ];
        die(json_encode($data)); 
    }


}

function CheckPassword($password){

    if(strlen($password)<5){
        $data = [ 'status' => 'failed' ,'message' => 'Password should have 5 letters or more' ];
        die(json_encode($data));
    }

}

function CheckEmail($email){

    $pattern = '~^(([^<>!\-()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,})|[\w\s])$~';
    if(!preg_match($pattern,$email)){
        $data = [ 'status' => 'failed' ,'message' => 'Invalid Email.' ];
        die(json_encode($data));
    }
}

function UsernameExisted($username,$con){

    $sql = "Select * from users where Username = '{$username}';";
    $result = $con->query($sql);
    if(mysqli_num_rows($result)>0){
        $data = [ 'status' => 'failed' ,'message' => 'Username already exists.' ];
        die(json_encode($data));    
    }

}

function RegisterUser($username,$password,$email,$con){

    $sql = "Insert into users(Username,Password,Email) values('{$username}','{$password}','{$email}');";
    $con->query($sql);
    mkdir(ROOTPATH."/filemanager/directories/{$username}");
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    

}

?>