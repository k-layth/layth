<?php

require 'db_connection.php';


$Id = $_GET['Id'];

//$user_id= mysqli_real_escape_string($db_conn, trim($data->user_id));

	$allproducts = mysqli_query($db_conn,"SELECT * FROM products where seller_id = $Id");
		if(mysqli_num_rows($allproducts) > 0){
			while($row = mysqli_fetch_array($allproducts)){
     $pro_id= $row['id'];
	$res = mysqli_query($db_conn,"SELECT SUM(amount) AS count from sale where id=$pro_id");
      $rec = mysqli_fetch_array($res);
	 
	 

		        $viewjson["saled"] = $rec['count'];
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
    
?>