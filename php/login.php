<?PHP
error_reporting(E_ERROR | E_PARSE);
header('Content-type: application/json');
if(isset($_POST['username']) && isset($_POST['password'])){
$con = new mysqli("localhost","root",null,"FileManager");
$sql = "select * from users where Username='{$_POST['username']}' and Password = '{$_POST['password']}'";
$result = $con->query($sql);
if($result->num_rows > 0){
    session_start();
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    $data = ['status' => 'success'];
    echo json_encode($data);
}
else{
    $data = ['status' => 'failed'];
    echo json_encode($data);
}
}
else
{
    
    $data = ['status' => 'empty'];
    echo json_encode($data);
}

?>