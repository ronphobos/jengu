<?php 
session_start();
/**
 * ALTER TABLE products ADD product_qty INT(11) NOT NULL AFTER `product_price`;
 	UPDATE `products` SET product_qty = 1000 WHERE 1;

	CREATE TABLE `products` (
 `product_id` int(100) NOT NULL AUTO_INCREMENT,
 `product_cat` int(11) NOT NULL,
 `product_brand` int(100) NOT NULL,
 `product_title` varchar(255) NOT NULL,
 `product_image` text NOT NULL,
 `product_keywords` text NOT NULL,
  CONSTRAINT fk_product_cat FOREIGN KEY fk_product_cat (product_cat) REFERENCES categories(cat_id),
    CONSTRAINT fk_product_brand FOREIGN KEY fk_product_brand (product_brand) REFERENCES brands(brand_id),
 PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
 	
 */
class Freelance
{
	
	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getProducts(){
		$q = $this->con->query("SELECT freelance_id, freelance_nom, freelance_image, freelance_phone, freelance_email, freelance_domaine FROM freelance");
		
		$products = [];
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$products[] = $row;
			}
			//return ['status'=> 202, 'message'=> $ar];
			$_DATA['freelance'] = $products;
		}

		// $categories = [];
		// $q = $this->con->query("SELECT * FROM categories_info");
		// if ($q->num_rows > 0) {
		// 	while($row = $q->fetch_assoc()){
		// 		$categories[] = $row;
		// 	}
		// 	//return ['status'=> 202, 'message'=> $ar];
		// 	$_DATA['categories_info'] = $categories;
		// }

		// $brands = [];
		// $q = $this->con->query("SELECT * FROM brand_info");
		// if ($q->num_rows > 0) {
		// 	while($row = $q->fetch_assoc()){
		// 		$brands[] = $row;
		// 	}
		// 	//return ['status'=> 202, 'message'=> $ar];
		// 	$_DATA['brand_info'] = $brands;
		// }


		return ['status'=> 202, 'message'=> $_DATA];
	}

	public function addProduct($product_name,
								$brand_id,
								$category_id,
								$phone,
								$file){


		$fileName = $file['name'];
		$fileNameAr= explode(".", $fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
			
			//print_r($file['size']);

			if ($file['size'] > (1024 * 2)) {
				
				$uniqueImageName = time()."_".$file['name'];
				if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/jengu/product_images/".$uniqueImageName)) {
					
					$q = $this->con->query("INSERT INTO `freelance`(`freelance_nom`, `freelance_domaine`, `freelance_phone`, `freelance_image`, `freelance_email`) VALUES ('$category_id', '$brand_id', '$product_name', '$uniqueImageName', '$phone')");

					if ($q) {
						return ['status'=> 202, 'message'=> 'Freelance Added Successfully..!'];
					}else{
						return ['status'=> 303, 'message'=> 'Failed to run query'];
					}

				}else{
					return ['status'=> 303, 'message'=> 'Failed to upload image'];
				}

			}else{
				return ['status'=> 303, 'message'=> 'Large Image ,Max Size allowed 2MB'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'Invalid Image Format [Valid Formats : jpg, jpeg, png]'];
		}

	}


	public function editProductWithImage($pid,
										$product_name,
										$brand_id,
										$category_id,
										$phone,
										$file){


		$fileName = $file['name'];
		$fileNameAr= explode(".", $fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
			
			//print_r($file['size']);

			if ($file['size'] > (1024 * 2)) {
				
				$uniqueImageName = time()."_".$file['name'];
				if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/jengu/product_images/".$uniqueImageName)) {
					
					$q = $this->con->query("UPDATE `freelance` SET 
										`freelance_nom` = '$category_id', 
										`freelance_domaine` = '$brand_id', 
										`freelance_email` = '$product_name', 
										`freelance_image` = '$uniqueImageName', 
										`freelance_phone` = '$phone'
										WHERE freelance_id = '$pid'");

					if ($q) {
						return ['status'=> 202, 'message'=> 'Freelance Modified Successfully..!'];
					}else{
						return ['status'=> 303, 'message'=> 'Failed to run query'];
					}

				}else{
					return ['status'=> 303, 'message'=> 'Failed to upload image'];
				}

			}else{
				return ['status'=> 303, 'message'=> 'Large Image ,Max Size allowed 2MB'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'Invalid Image Format [Valid Formats : jpg, jpeg, png]'];
		}

	}

	public function editProductWithoutImage($pid,
										$product_name,
										$brand_id,
										$category_id,
										$phone){

		if ($pid != null) {
			$q = $this->con->query("UPDATE `freelance` SET 
										`freelance_nom` = '$category_id', 
										`freelance_domaine` = '$brand_id', 
										`freelance_phone` = '$product_name', 
										`freelance_email` = '$phone'
										WHERE freelance_id = '$pid'");

			if ($q) {
				return ['status'=> 202, 'message'=> 'Freelance updated Successfully'];
			}else{
				return ['status'=> 303, 'message'=> 'Failed to run query'];
			}
			
		}else{
			return ['status'=> 303, 'message'=> 'Invalid product id'];
		}
		
	}


	// public function getBrands(){
	// 	$q = $this->con->query("SELECT * FROM brand_info");
	// 	$ar = [];
	// 	if ($q->num_rows > 0) {
	// 		while ($row = $q->fetch_assoc()) {
	// 			$ar[] = $row;
	// 		}
	// 	}
	// 	return ['status'=> 202, 'message'=> $ar];
	// }

	// public function addCategory($name){
	// 	$q = $this->con->query("SELECT * FROM categories_info WHERE cat_title = '$name' LIMIT 1");
	// 	if ($q->num_rows > 0) {
	// 		return ['status'=> 303, 'message'=> 'Category already exists'];
	// 	}else{
	// 		$q = $this->con->query("INSERT INTO categories_info (cat_title) VALUES ('$name')");
	// 		if ($q) {
	// 			return ['status'=> 202, 'message'=> 'New Category added Successfully'];
	// 		}else{
	// 			return ['status'=> 303, 'message'=> 'Failed to run query'];
	// 		}
	// 	}
	// }

	// public function getCategories(){
	// 	$q = $this->con->query("SELECT * FROM categories_info");
	// 	$ar = [];
	// 	if ($q->num_rows > 0) {
	// 		while ($row = $q->fetch_assoc()) {
	// 			$ar[] = $row;
	// 		}
	// 	}
	// 	return ['status'=> 202, 'message'=> $ar];
	// }

	public function deleteProduct($pid = null){ 
		if ($pid != null) {
			$q = $this->con->query("DELETE FROM freelance WHERE freelance_id = '$pid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Freelance removed from stocks'];
			}else{
				return ['status'=> 202, 'message'=> 'Failed to run query'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'Invalid product id'];
		}

	}

	// public function deleteCategory($cid = null){
	// 	if ($cid != null) {
	// 		$q = $this->con->query("DELETE FROM categories_info WHERE cat_id = '$cid'");
	// 		if ($q) {
	// 			return ['status'=> 202, 'message'=> 'Category removed'];
	// 		}else{
	// 			return ['status'=> 202, 'message'=> 'Failed to run query'];
	// 		}
			
	// 	}else{
	// 		return ['status'=> 303, 'message'=>'Invalid cattegory id'];
	// 	}

	// }
	
	

	// public function updateCategory($post = null){
	// 	extract($post);
	// 	if (!empty($cat_id) && !empty($e_cat_title)) {
	// 		$q = $this->con->query("UPDATE categories_info SET cat_title = '$e_cat_title' WHERE cat_id = '$cat_id'");
	// 		if ($q) {
	// 			return ['status'=> 202, 'message'=> 'Category updated'];
	// 		}else{
	// 			return ['status'=> 202, 'message'=> 'Failed to run query'];
	// 		}
			
	// 	}else{
	// 		return ['status'=> 303, 'message'=>'Invalid category id'];
	// 	}

	// }

	// public function addBrand($name){
	// 	$q = $this->con->query("SELECT * FROM brand_info WHERE brand_title = '$name' LIMIT 1");
	// 	if ($q->num_rows > 0) {
	// 		return ['status'=> 303, 'message'=> 'Brand already exists'];
	// 	}else{
	// 		$q = $this->con->query("INSERT INTO brand_info (brand_title) VALUES ('$name')");
	// 		if ($q) {
	// 			return ['status'=> 202, 'message'=> 'New Brand added Successfully'];
	// 		}else{
	// 			return ['status'=> 303, 'message'=> 'Failed to run query'];
	// 		}
	// 	}
	// }

	// public function deleteBrand($bid = null){
	// 	if ($bid != null) {
	// 		$q = $this->con->query("DELETE FROM brand_info WHERE brand_id = '$bid'");
	// 		if ($q) {
	// 			return ['status'=> 202, 'message'=> 'Brand removed'];
	// 		}else{
	// 			return ['status'=> 202, 'message'=> 'Failed to run query'];
	// 		}
			
	// 	}else{
	// 		return ['status'=> 303, 'message'=>'Invalid brand id'];
	// 	}

	// }
	
	

	// public function updateBrand($post = null){
	// 	extract($post);
	// 	if (!empty($brand_id) && !empty($e_brand_title)) {
	// 		$q = $this->con->query("UPDATE brand_info SET brand_title = '$e_brand_title' WHERE brand_id = '$brand_id'");
	// 		if ($q) {
	// 			return ['status'=> 202, 'message'=> 'Brand updated'];
	// 		}else{
	// 			return ['status'=> 202, 'message'=> 'Failed to run query'];
	// 		}
			
	// 	}else{
	// 		return ['status'=> 303, 'message'=>'Invalid brand id'];
	// 	}

	// }

	

}


if (isset($_POST['GET_PRODUCT'])) {
	if (isset($_SESSION['admin_id'])) {
		$p = new Freelance();
		echo json_encode($p->getProducts());
		exit();
	}
}


if (isset($_POST['add_product'])) {

	extract($_POST);
	if (!empty($product_name) 
	&& !empty($brand_id) 
	&& !empty($category_id)
	&& !empty($phone)
	&& !empty($_FILES['product_image']['name'])) {
		

		$p = new Freelance();
		$result = $p->addProduct($product_name,
								$brand_id,
								$category_id,
								$phone,
								$_FILES['product_image']);
		
		header("Content-type: application/json");
		echo json_encode($result);
		http_response_code($result['status']);
		exit();


	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
		exit();
	}



	
}


if (isset($_POST['edit_product'])) {

	extract($_POST);
	if (!empty($pid)
	&& !empty($e_product_name) 
	&& !empty($e_brand_id) 
	&& !empty($e_category_id)
	&& !empty($e_phone_id) ) {
		
		$p = new Freelance();

		if (isset($_FILES['e_product_image']['name']) 
			&& !empty($_FILES['e_product_image']['name'])) {
			$result = $p->editProductWithImage($pid,
								$e_product_name,
								$e_brand_id,
								$e_category_id,
								$e_phone_id,
								$_FILES['e_product_image']);
		}else{
			$result = $p->editProductWithoutImage($pid,
								$e_product_name,
								$e_brand_id,
								$e_category_id,
								$e_phone_id);
		}

		echo json_encode($result);
		exit();


	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
		exit();
	}



	
}

// if (isset($_POST['GET_BRAND'])) {
// 	$p = new Freelance();
// 	echo json_encode($p->getBrands());
// 	exit();
	
// }

// if (isset($_POST['add_category'])) {
// 	if (isset($_SESSION['admin_id'])) {
// 		$cat_title = $_POST['cat_title'];
// 		if (!empty($cat_title)) {
// 			$p = new Freelance();
// 			echo json_encode($p->addCategory($cat_title));
// 		}else{
// 			echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
// 		}
// 	}else{
// 		echo json_encode(['status'=> 303, 'message'=> 'Session Error']);
// 	}
// }

// if (isset($_POST['GET_CATEGORIES'])) {
// 	$p = new Freelance();
// 	echo json_encode($p->getCategories());
// 	exit();
	
// }

if (isset($_POST['DELETE_PRODUCT'])) {
	$p = new Freelance();
	if (isset($_SESSION['admin_id'])) {
		if(!empty($_POST['pid'])){
			$pid = $_POST['pid'];
			echo json_encode($p->deleteProduct($pid));
			exit();
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Invalid product id']);
			exit();
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid Session']);
	}


}


// if (isset($_POST['DELETE_CATEGORY'])) {
// 	if (!empty($_POST['cid'])) {
// 		$p = new Freelance();
// 		echo json_encode($p->deleteCategory($_POST['cid']));
// 		exit();
// 	}else{
// 		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
// 		exit();
// 	}
// }

// if (isset($_POST['edit_category'])) {
// 	if (!empty($_POST['cat_id'])) {
// 		$p = new Products();
// 		echo json_encode($p->updateCategory($_POST));
// 		exit();
// 	}else{
// 		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
// 		exit();
// 	}
// }

// if (isset($_POST['add_brand'])) {
// 	if (isset($_SESSION['admin_id'])) {
// 		$brand_title = $_POST['brand_title'];
// 		if (!empty($brand_title)) {
// 			$p = new Products();
// 			echo json_encode($p->addBrand($brand_title));
// 		}else{
// 			echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
// 		}
// 	}else{
// 		echo json_encode(['status'=> 303, 'message'=> 'Session Error']);
// 	}
// }

// if (isset($_POST['DELETE_BRAND'])) {
// 	if (!empty($_POST['bid'])) {
// 		$p = new Products();
// 		echo json_encode($p->deleteBrand($_POST['bid']));
// 		exit();
// 	}else{
// 		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
// 		exit();
// 	}
// }

// if (isset($_POST['edit_brand'])) {
// 	if (!empty($_POST['brand_id'])) {
// 		$p = new Products();
// 		echo json_encode($p->updateBrand($_POST));
// 		exit();
// 	}else{
// 		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
// 		exit();
// 	}
// }

?>