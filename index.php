<?php

session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password'])){

    header("Location: user",true,301);
    die();

}
else{
    header("Location: login.php",true,301);
    die();
}

?>