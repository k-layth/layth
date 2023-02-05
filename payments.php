<?php

require 'db_connection.php';


$Id = $_GET['Id'];


	$allproducts = mysqli_query($db_conn,"SELECT * FROM sale where buyer_id = $Id");
		if(mysqli_num_rows($allproducts) > 0){
			while($row = mysqli_fetch_array($allproducts)){
				$viewjson["s_id"] = $row['s_id'];
				$viewjson["title"] = $row['title'];
				$viewjson["amount"] = $row['amount'];
				$viewjson["paid"] = $row['paid'];
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