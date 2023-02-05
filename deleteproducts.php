<?php 
require 'db_connection.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->productsids) 
	&& !empty(trim($data->productsids))
	){
		
	$productsids = mysqli_real_escape_string($db_conn, trim($data->productsids));

  $add = mysqli_query($db_conn,"delete from products where id='$productsids'");

	if($add){
		echo json_encode(["success"=>true]);
		return;
    }else{
        echo json_encode(["success"=>false,"msg"=>"Server Problem. Please Try Again"]);
		return;
    } 

} else{
    echo json_encode(["success"=>false,"msg"=>"Please fill all the required fields!"]);
	return;
}
?>