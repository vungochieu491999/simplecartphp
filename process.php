<?php 

	session_start();

	require_once "connectdb.php";

	$conn = new Database();

	if(isset($_POST) && !empty($_POST)) {
		if(isset($_POST['action'])) {
			switch($_POST['action']) {
					case 'add':
						if(isset($_POST['product_id']) && isset($_POST['quantity'])) {
							$sql = 'select * from products where id ='. (int)$_POST['product_id'];
							$products = $conn->executeSql($sql); 
							$product = current($products);
							$product_id = $product['id'];
							if(isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item'])) {
								if(isset($_SESSION['cart_item'][$product_id])) {
									$existsCartItem = $_SESSION['cart_item'][$product_id];
									$addQuantity = $existsCartItem['quantity'];
									$cart_item = [];
									$cart_item['id'] = $product['id'];
									$cart_item['product_name'] = $product['product_name'];
									$cart_item['product_image'] = $product['product_image'];
									$cart_item['price'] = $product['price'];
									$cart_item['quantity'] = $addQuantity + $_POST['quantity'];
									$_SESSION['cart_item'][$product_id] = $cart_item;
								}	else {
									$cart_item = [];
									$cart_item['id'] = $product['id'];
									$cart_item['product_name'] = $product['product_name'];
									$cart_item['product_image'] = $product['product_image'];
									$cart_item['price'] = $product['price'];
									$cart_item['quantity'] = $_POST['quantity'];
									$_SESSION['cart_item'][$product_id] = $cart_item;
								}

							}	else {
								$_SESSION['cart_item'] = [];
								$cart_item = [];
								$cart_item['id'] = $product['id'];
								$cart_item['product_name'] = $product['product_name'];
								$cart_item['product_image'] = $product['product_image'];
								$cart_item['price'] = $product['price'];
								$cart_item['quantity'] = $_POST['quantity'];
								$_SESSION['cart_item'][$product_id] = $cart_item;
							}
						}
						break;
					case 'delete':
						if (isset($_POST['product_id'])) {
							$id = $_POST['product_id'];
								if(isset($_SESSION['cart_item'][$id])) {
									unset($_SESSION['cart_item'][$id]);
								}
						}
						break;
					default:
						echo 'Action not runing';
						die;
			}
		}
	}

	header('location: index.php');
	die;
 ?>