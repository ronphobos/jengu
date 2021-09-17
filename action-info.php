<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";

if(isset($_POST["category"])){
	$category_query = "SELECT * FROM categories_info";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Categories</h4></a></li> 
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];
			echo "
					<li><a href='#' class='category' cid='$cid'>$cat_name</a></li>
			";
		}
		echo "</div>";
	}
}

if(isset($_POST["brand"])){
	$brand_query = "SELECT * FROM brand_info";
	$run_query = mysqli_query($con,$brand_query);
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Catalogue</h4></a></li>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$bid = $row["brand_id"];
			$brand_name = $row["brand_title"];
			echo "
					<li><a href='#' class='selectBrand' bid='$bid'>$brand_name</a></li>
			";
		}
		echo "</div>";
	}
}
if(isset($_POST["page"])){
	$sql = "SELECT * FROM info_products";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/6);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#' page='$i' id='page'>$i</a></li>
		";
	}
}


if(isset($_POST["getProduct"])){
	$limit = 6;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$product_query = "SELECT * FROM info_products LIMIT $start,$limit";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['produit_id'];
			$pro_cat   = $row['produit_cat'];
			$pro_brand = $row['produit_brand'];
			$pro_title = $row['produit_title'];
			$pro_image = $row['produit_image'];
			echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_title</div>
								<div class='panel-body'>
									<img src='product_images/$pro_image' style='width:180px; height:250px;'/>
								</div>
							</div>
						</div>	
			";
		}
	}
}

	if(isset($_POST["get_seleted_Category"]) || isset($_POST["selectBrand"]) || isset($_POST["search"])){
		if(isset($_POST["get_seleted_Category"])){
			$id = $_POST["cat_id"];
			$sql = "SELECT * FROM info_products WHERE produit_cat = '$id'";
		}else if(isset($_POST["selectBrand"])){
			$id = $_POST["brand_id"];
			$sql = "SELECT * FROM info_products WHERE produit_brand = '$id'";
		}else {
			$keyword = $_POST["keyword"];
			$sql = "SELECT * FROM info_products WHERE produit_keywords LIKE '%$keyword%'";
		}
		
		$run_query = mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($run_query)){
				$pro_id    = $row['produit_id'];
				$pro_cat   = $row['produit_cat'];
				$pro_brand = $row['produit_brand'];
				$pro_title = $row['produit_title'];
				$pro_image = $row['produit_image'];
				echo "
					<div class='col-md-4'>
								<div class='panel panel-info'>
									<div class='panel-heading'>$pro_title</div>
									<div class='panel-body'>
										<img src='product_images/$pro_image' style='width:160px; height:250px;'/>
									</div>
								</div>
							</div>	
				";
			}
		}
		
// //Remove Item From cart
// if (isset($_POST["removeItemFromCart"])) {
// 	$remove_id = $_POST["rid"];
// 	if (isset($_SESSION["uid"])) {
// 		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND user_id = '$_SESSION[uid]'";
// 	}else{
// 		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
// 	}
// 	if(mysqli_query($con,$sql)){
// 		echo "<div class='alert alert-danger'>
// 						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
// 						<b>Product is removed from cart</b>
// 				</div>";
// 		exit();
// 	}
// }


// //Update Item From cart
// if (isset($_POST["updateCartItem"])) {
// 	$update_id = $_POST["update_id"];
// 	$qty = $_POST["qty"];
// 	if (isset($_SESSION["uid"])) {
// 		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND user_id = '$_SESSION[uid]'";
// 	}else{
// 		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
// 	}
// 	if(mysqli_query($con,$sql)){
// 		echo "<div class='alert alert-info'>
// 						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
// 						<b>Product is updated</b>
// 				</div>";
// 		exit();
// 	}
// }


// ?>
