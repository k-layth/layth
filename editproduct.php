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
&& isset($data->id) 
	&& isset($data->productids) 
	&& !empty(trim($data->title))
	&& !empty(trim($data->price))
	&& !empty(trim($data->taxes))
	&& !empty(trim($data->ads))
	&& !empty(trim($data->discount))
	&& !empty(trim($data->count))
	&& !empty(trim($data->total))
	&& !empty(trim($data->category))
	&& !empty(trim($data->id))
	&& !empty(trim($data->productids))
	){
	
		
	$id=	mysqli_real_escape_string($db_conn, trim($data->id));
	$title = mysqli_real_escape_string($db_conn, trim($data->title));
	$price = mysqli_real_escape_string($db_conn, trim($data->price));
	$taxes = mysqli_real_escape_string($db_conn, trim($data->taxes));
	$ads = mysqli_real_escape_string($db_conn, trim($data->ads));
	$discount = mysqli_real_escape_string($db_conn, trim($data->discount));
	$count = mysqli_real_escape_string($db_conn, trim($data->count));
	$total = mysqli_real_escape_string($db_conn, trim($data->total));
	$category = mysqli_real_escape_string($db_conn, trim($data->category));
	$productids = mysqli_real_escape_string($db_conn, trim($data->productids));

  $add = mysqli_query($db_conn,"update products set title ='$title',price ='$price',taxes ='$taxes',ads ='$ads',discount ='$discount',count ='$count', total ='$total', category ='$category' where id='$productids 'and seller_id='$id'");

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