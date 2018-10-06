<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT']);
session_start();
if(empty($_SESSION['username']) || empty($_SESSION['password'])){
header("Location: /filemanager/errors/401.html",true,302);
die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php  echo ucfirst($_SESSION['username']); ?> Folder</title>
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
        <link rel="stylesheet" href="../styles/main.css">
        <script src="../scripts/user.js"></script>
        <link rel="stylesheet" href="../styles/bootstrap_edits.css">
        <link rel="stylesheet" href="../styles/user.css">
</head>
<body>

    <div id="moveToPopup">

        <div class="shadowBox"></div>
        <div class="moveToForm">

            <div class="moveToUI">
                <div class="folders"></div>
    
                <div class="buttons">
    
                    <button>Move</button>
                    <button>Close</button>
    
    
                </div>
            </div>

        </div>

    </div>

    <div class="form_container">
        <input type="file" id="file" style="display:none" />
        
        <div class="lds-dual-ring loader show"></div>

            <div class="my_form file border">

                <nav class="my_nav">
                    
                    <div class="header">

                        <div class="back_icon enabled" onclick="back();">
                        <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="path">PATH</div>

                    </div>

                    <div class="my_toolbox"><i onclick="chooseFile();" class="fas fa-file-upload upload_button"></i></div>

                </nav>

                <div class="container-fluid">

                <table style="opacity:0;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>File</th>
                            <th>Size</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                </table>

                </div>

            </div>

    </div>
        

        

    

    
</body>
</html>