
<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password'])){
    header("Location: /filemanager/user/",true,302);
    die();
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="styles/main.css">
    <script src="scripts/enum.js"></script>
    <script src="scripts/login.js"></script>
    <link rel="stylesheet" href="styles/bootstrap_edits.css">


</head>

<body>

    <div class="form_container">

        <div class="my_form login border">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-4"><i class="fas fa-user"></i><span>Username</span></div>
                    <div class="col-sm-8"><input id="username" type="text"></div>
                </div>

                <div class="row">
                    <div class="col-sm-4"><i class="fas fa-key"></i><span>Password</span></div>
                    <div class="col-sm-8"><input id="password" type="password"></div>
                </div>
                <div class="row row-margin_1">
                    <div class="col-sm-4">
                        <button onclick="login();">Login</button>
                    </div>
                    <div class="col-sm-4">
                            <a href="register.html">Register</a>
                    </div>

                    <div class="col-sm-4">

                            <div class="lds-dual-ring loader"></div>

                    </div>
                </div>
                <div class="row row_buffer">

                    <div class="col-sm-12 border-top">

                        <label class="text-danger form_error" id="result"></label>

                    </div>

    

                </div>

            </div>

        </div>

    </div>

</body>

</html>