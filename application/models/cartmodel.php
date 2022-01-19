<?php

class CartModel
{
		
	function __construct($db)
	{
		try {
			$this->db = $db;
		}
		catch (PDOException $e) {
			exit('Database connection error');
		}
	}


	public function getCart($user_id)
	{
		$sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	public function getCartItemsDetails($user_id)
	{
		$sql = "SELECT cart.id, cart.user_id, cart.product_id, cart.price_id, products.id AS product_id, products.product_name, products.product_photo, products.product_description, prices.id AS price_id, prices.product_id AS price_product_id, prices.price, prices.discount_in_rupees, prices.discount_in_percent, prices.offer_price, prices.delivery_charge FROM cart INNER JOIN prices ON cart.price_id = prices.id INNER JOIN products ON cart.product_id = products.id WHERE user_id = '$user_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	public function addToCart($user_id,$product_id,$price_id)
	{
		$sql = "INSERT INTO cart(user_id,product_id,price_id) VALUES ('$user_id','$product_id','$price_id')";
		$query = $this->db->prepare($sql);
		$result = $query->execute();

		if($result){
			return true;
		}
		else {
			return false;
		}

	}


	public function getCartCount($user_id)
	{
		$sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
		$query = $this->db->prepare($sql);
		$result = $query->execute();

		$row_count = $query->rowCount();

		return $row_count;
	}


	public function removeFromCart($cart_id,$user_id)
	{
		$sql = "DELETE FROM cart WHERE id='$cart_id' AND user_id='$user_id'";
		$query = $this->db->prepare($sql);
		$result = $query->execute();

		return $result;
	}


	public function placeOrder($user_id,$address_id,$total_price,$ispaid,$status){
		$sql = "INSERT INTO orders (user_id,address_id,total_price,ispaid,order_date,status) VALUES ('$user_id','$address_id','$total_price','$ispaid',now(),'$status')";
		$query = $this->db->prepare($sql);
		$query->execute();
		
		return $this->db->lastInsertId();
	}


	public function moveFromCartToOrdered($order_id,$product_id,$price_id,$user_id)
	{
		$sql = "INSERT INTO ordered_items (order_id,product_id,price_id) VALUES ('$order_id','$product_id','$price_id')";
		$query = $this->db->prepare($sql);
		$query->execute();

		$sql = "DELETE FROM cart WHERE user_id = '$user_id'";
		$query = $this->db->prepare($sql);
		$query->execute();
	}
}