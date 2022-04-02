<?php
include_once("pdo_connect.php");

$restaurant_city = '';
if(!empty($_POST['restaurant_city'])) {
	$restaurant_city =$_POST['restaurant_city'];
}
	
	if(!empty($restaurant_city)){
		
	$fetchrt_restaurantsSql = $conn->prepare("SELECT restaurant_name FROM hotel_db.rt_restaurants WHERE restaurant_city ='".$restaurant_city."'");
	$fetchrt_restaurantsSql->execute();
	$result = $fetchrt_restaurantsSql->fetch();
print_r ($result);
	}

?>