<?php

require 'db_connection.php';


//$Id = $_GET['Id'];
$id = $_GET['id'];
$seller_id=$_GET['user_id'];
//$user_id= mysqli_real_escape_string($db_conn, trim($data->user_id));

$sum = 0;
if(mysqli_num_rows($count) > 0){
$res = mysqli_query($db_conn,"SELECT SUM(amount) AS count from sale where id=$id and seller_id=$seller_id");
$row = mysqli_fetch_array($res); 
/*
$sum = $row['count'];
echo ($sum);
*/
$viewjson["count"] = $row['count'];
$json_array["sum"][] = $viewjson;
			
echo json_encode(["success"=>true,"sumlist"=>$json_array]);
return;

}else{
$viewjson["count"] = 0;
$json_array["sum"][] = $viewjson;
			
echo json_encode(["success"=>true,"sumlist"=>$json_array]);
return;
}



/*

$count = mysqli_query($db_conn,"SELECT * FROM sale where id = $Id and seller_id=$seller_id");
if(mysqli_num_rows($count) == 1){
	
    $res = mysqli_query($db_conn,"SELECT amount  from sale where id=$id and seller_id=$seller_id ");
    $row = mysqli_fetch_array($res); 
    $sum = $row['amount'];


    echo ($sum);
}else if(mysqli_num_rows($count) == 0){
    echo ($sum);

}else{


    $res = mysqli_query($db_conn,"SELECT SUM(amount) AS count from sale where id=$id and seller_id=$seller_id");
    $row = mysqli_fetch_array($res); 
    $sum = $row['count'];
    echo ($sum);


}*/
   /* 
    if(mysqli_num_rows($allproducts) > 0){
			while($row = mysqli_fetch_array($allproducts)){
				$viewjson["id"] = $row['id'];
				$viewjson["title"] = $row['title'];
				$viewjson["total"] = $row['total'];
				$viewjson["count"] = $row['count'];
				$viewjson["remain"] = $row['remain'];
				$viewjson["category"] = $row['category'];
				$json_array["productdata"][] = $viewjson;
			}
			echo json_encode(["success"=>true,"productlist"=>$json_array]);
			return;
		}
		else{
			echo json_encode(["success"=>false]);
			return;
		}
    */
?>