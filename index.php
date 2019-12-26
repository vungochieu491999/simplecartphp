<?php 
	session_start();
	include_once 'connectdb.php';

	$conn = new Database();
 ?>

 <!DOCTYPE html>
<html>
<head>
	<title>Simple Cart</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<div class="wrap-page">
		<div class="container">
			<h2>Giỏ hàng</h2>
			<?php if(empty($_SESSION['cart_item']) || !isset($_SESSION['cart_item'])) :?>
				<p>Giỏ hàng của bạn chưa có đồ</p>	
			<?php else : ?>
				<?php  $total = 0; ?>
			<p>Chi tiết giỏ hàng của bạn:</p>
			<table class="table table-hover">
				<thead class="thead-light">
					<tr>
						<th scope="col">Mã sản phẩm</th>
						<th scope="col">Tên sản phẩm</th>
						<th scope="col">Hình ảnh</th>
						<th scope="col">Giá tiền</th>
						<th scope="col">Số lượng</th>
						<th scope="col">Thảnh tiền</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($_SESSION['cart_item'] as $product) :?>
						<?php  
							
							$total_item = $product['price'] * $product['quantity'];
							$total = $total+  $total_item;
						?>
					<tr>
						<td style="vertical-align: middle;"><?php echo $product['id']; ?></td>	
						<td style="vertical-align: middle;"><?php echo $product['product_name']; ?></td>	
						<td style="vertical-align: middle;"><?php echo $product['product_image']; ?></td>	
						<td style="vertical-align: middle;"><?php echo number_format($product['price'],0,',','.'); ?><b> đ</b></td>	
						<td style="vertical-align: middle;"><?php echo $product['quantity']; ?></td>	
						<td style="vertical-align: middle;"><?php echo number_format($total_item,0,',','.'); ?><b> đ</b></td>	
						<td style="vertical-align: middle;"><form action='process.php?delete_id' method="post">
							<input type="hidden" name="product_id" value="<?php echo $product['id'] ?>">
							<input type="hidden" name="action" value="delete">
							<input type="submit" name="delete_id" class="btn btn-danger" value="Xóa">
						</form></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			<p>Tổng hóa đơn thanh toán: <strong><?php  echo number_format($total,0,',','.'); ?><b>đ</b></strong></p>
		<?php endif; ?>
		</div>

		<div class="container">
			<div class="row">
				<?php 
					$sql = 'select * from products';
					$products = $conn->executeSql($sql);
				?>

				<?php if(!empty($products)) : ?>

					<?php foreach($products as $product) : ?> 
						<div class="col-sm-6">
							<div class="product">
								<form name="product<?php echo $product['id']  ?>" action="process.php" method="post">
									<div class="card mb-4 box-shadow">
						                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 250px; width: 100%; display: block;" src="./img/<?php echo $product['product_image']  ?>" data-holder-rendered="true">
						                <div class="card-body">
						                    <p class="card-text"><?php echo $product['product_name']  ?><span style="color:grey;float:right;font-style:italic">Giá: <?php echo $product['price']  ?>đ</span></p>
						                    <div class="d-flex justify-content-between align-items-center">
							                    <div class="form-inline">
							                     	<input type="number" name="quantity" value="1" class="form-control">
							                     	<input type="hidden" name="product_id" value="<?php echo $product['id']  ?>">
							                     	<input type="hidden" name="action" value="add">
							                     	<input style="margin-left:10px" type="submit" name="submit" value="Thêm vào giỏ hàng" class="btn btn-sm btn-outline-secondary">
							                    </div>
						                  	</div>
					                	</div>
		              				</div>
								</form>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</body>
</html>