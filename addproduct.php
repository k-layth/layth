<?php 
require 'db_connection.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->title)
	&& isset($data->price) 
	&& isset($data->taxes) 
	&& isset($data->ads) 
	&& isset($data->discount) 
	&& isset($data->count) 
	&& isset($data->total)
	&& isset($data->category) 
	&& isset($data->user_id)	
	&& !empty(trim($data->title))
	&& !empty(trim($data->price))
	&& !empty(trim($data->taxes))
	&& !empty(trim($data->ads))
	&& !empty(trim($data->discount))
	&& !empty(trim($data->count))
	&& !empty(trim($data->total))
	&& !empty(trim($data->category))
	&& !empty(trim($data->user_id))
	){
  
    $user_id = mysqli_real_escape_string($db_conn, trim($data->user_id)); 
	$title = mysqli_real_escape_string($db_conn, trim($data->title));
	$price = mysqli_real_escape_string($db_conn, trim($data->price));
	$taxes = mysqli_real_escape_string($db_conn, trim($data->taxes));
	$ads = mysqli_real_escape_string($db_conn, trim($data->ads));
	$discount = mysqli_real_escape_string($db_conn, trim($data->discount));
	$count = mysqli_real_escape_string($db_conn, trim($data->count));
	$total = mysqli_real_escape_string($db_conn, trim($data->total));
	$category = mysqli_real_escape_string($db_conn, trim($data->category));
	//$date = date('Y-m-d');

	$add = mysqli_query($db_conn,"INSERT into products (title,price,taxes,ads,discount,count,total,category,seller_id) values('$title','$price','$taxes','$ads','$discount','$count','$total','$category','$user_id')");
	if($add){
		$last_id = mysqli_insert_id($db_conn);
		echo json_encode(["success"=>true,"insertid"=>$last_id]);
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