<?php 
	const HOST = 'localhost';

	const USER = 'root';

	const PASS = '';

	const DATABASE = 'simple_cart';


	 function createProductsTable() {
	 	$connection = new mysqli(HOST,USER,PASS,DATABASE);

	 	$sql = "create table if not exists products(
	 			id int auto_increment primary key,
	 			product_name varchar(255),
	 			product_image text,
	 			price double
	 			)";
	 	$connection->query($sql);
	 	if ($connection->query($sql)) {
	 		echo 'done table';
	 	}
	 	$connection->close();
	 }
	 function insertTemple(){
	 	$connection = new mysqli(HOST,USER,PASS,DATABASE);
	 	$dot ='.';
	 	$sql = "insert into products(product_name,product_image,price) values ('camera','camera.jpg',1000000),
	 			('hard drive','hdd.jpg',700000),
	 			('smart watch ','smart-watch.jpg',5500000),
	 			('intel core laptop','intel.jpg',2300000)
	 	";
	 	$connection->query($sql);
	 	if($connection->query($sql)){
	 		echo 'done insert';
	 	} else {
	 		echo mysqli_error($connection);
	 	}
	 	$connection->close();
	 }
	 createProductsTable();
	 insertTemple();
 ?>