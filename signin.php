<?php
require 'db_connection.php';
$data = json_decode(file_get_contents("php://input"));




if(isset($data->username) 
&& isset($data->userpassword)
&& !empty(trim($data->username))
&& !empty(trim($data->userpassword))
){
    
$username = mysqli_real_escape_string($db_conn, trim($data->username));
$userpassword = mysqli_real_escape_string($db_conn, trim($data->userpassword));

$result = mysqli_query($db_conn,"SELECT * FROM user_acc WHERE username = '$username' and password = '$userpassword'");

$num = mysqli_num_rows($result);

$rs = mysqli_fetch_array($result);

if($num>=1){
    
  http_response_code(200);
  $outp="";
  
  $outp .='{"username":"' . $rs["username"]. '",';
    $outp .='"email":"' . $rs["email"]. '",';
    $outp .='"user_id":"' . $rs["user_id"]. '",';
    $outp .='"Status":"200"}';
    
    echo $outp;
}else{
    http_response_code(202);
} 

} else{
echo json_encode(["success"=>false,"msg"=>"Please fill all the required fields!"]);
return;
}
?>