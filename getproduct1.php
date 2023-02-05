<?php
require 'db_connection.php';
$data = json_decode(file_get_contents("php://input"));
if(isset($data->productids) 
	&& !empty(trim($data->productids))
	){
  $addproductid = mysqli_real_escape_string($db_conn, trim($data->productids));
	$allproduct = mysqli_query($db_conn,"SELECT * FROM products where id = '".$addproductid."'");
	if(mysqli_num_rows($allproduct) > 0){
		while($row = mysqli_fetch_array($allproduct)){

            $pro_id= $row['id'];
			$res = mysqli_query($db_conn,"SELECT SUM(amount) AS count from sale where id=$pro_id");
			$rec = mysqli_fetch_array($res);

            $viewjson["saled"] = $rec['count'];
			$viewjson["id"] = $row['id'];
			$viewjson["title"] = $row['title'];
			$viewjson["price"] = $row['price'];
			$viewjson["taxes"] = $row['taxes'];
			$viewjson["ads"] = $row['ads'];
			$viewjson["discount"] = $row['discount'];
			$viewjson["count"] = $row['count'];
			$viewjson["total"] = $row['total'];
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
		
}
?>