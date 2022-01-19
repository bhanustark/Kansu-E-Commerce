<?php

class OrdersModel
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


	function getOrders($user)
	{
		$sql = "SELECT * FROM orders WHERE user_id = '$user'";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	function getAllOrders()
	{
		$sql = "SELECT orders.id as orders_id
		, orders.user_id as orders_user_id
		, orders.address_id as orders_address_id
		, orders.total_price as orders_total_price
		, orders.ispaid as orders_ispaid
		, orders.order_date as orders_order_date
		, orders.status as orders_status
		, addresses.id as addresses_id
		, addresses.user_id as addresses_user_id
		, addresses.billing_name as billing_name
		, addresses.pincode_id as addresses_pincode_id
		, addresses.city_id as addresses_city_id
		, addresses.address as addresses_address
		, addresses.phone as addresses_phone
		, addresses.alt_phone as addresses_alt_phone
		, cities.id as cities_id
		, cities.pincode_id as cities_pincode_id
		, cities.city_name as cities_city_name
		, cities.distance as cities_distance
		 FROM orders 
		 INNER JOIN addresses ON orders.address_id = addresses.id
		   INNER JOIN cities ON addresses.city_id = cities.id
		   WHERE orders.status = '0'
		 ORDER BY orders.id DESC";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	function cancelOrder($order_id,$user)
	{
		$sql = "SELECT * FROM orders WHERE user_id = '$user' AND id = '$order_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		$user_id = null;
		$results = $query->fetchAll();

		foreach($results as $result){
			$user_id = $result->user_id;
		}

		if($user == $user_id){

			$sql = "DELETE FROM ordered_items WHERE order_id = '$order_id'";
			$query = $this->db->prepare($sql);
			$query->execute();

			$sql = "DELETE FROM orders WHERE id = '$order_id'";
			$query = $this->db->prepare($sql);
			return $query->execute();
		}
	}


	function seeAll($order_id,$user)
	{
		$sql = "SELECT * FROM orders WHERE user_id = '$user' AND id = '$order_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		$user_id = null;
		$results = $query->fetchAll();

		foreach($results as $result){
			$user_id = $result->user_id;
		}

		if($user == $user_id){
			$sql = "SELECT ordered_items.id, ordered_items.order_id, ordered_items.product_id, ordered_items.price_id, products.id AS product_id, products.product_name, products.product_photo, products.product_description, prices.id AS price_id, prices.product_id AS price_product_id, prices.price, prices.discount_in_rupees, prices.discount_in_percent, prices.offer_price, prices.delivery_charge FROM ordered_items INNER JOIN prices ON ordered_items.price_id = prices.id INNER JOIN products ON ordered_items.product_id = products.id WHERE order_id = '$order_id'";
			$query = $this->db->prepare($sql);
			$query->execute();

			return $query->fetchAll();

		}
	}


	function seeAllAdmin($order_id)
	{
		$sql = "SELECT ordered_items.id
		, ordered_items.order_id
		, ordered_items.product_id
		, ordered_items.price_id
		, products.id AS product_id
		, products.product_name
		, products.product_photo
		, products.product_description
		, prices.id AS price_id
		, prices.product_id AS price_product_id
		, prices.price
		, prices.discount_in_rupees
		, prices.discount_in_percent
		, prices.offer_price
		, prices.delivery_charge FROM ordered_items
		 INNER JOIN prices ON ordered_items.price_id = prices.id 
		 INNER JOIN products ON ordered_items.product_id = products.id
		  WHERE order_id = '$order_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	function orderCompleted($order_id)
	{
		$sql = "UPDATE orders SET status = '1', ispaid = '1' WHERE id = '$order_id'";
		$query = $this->db->prepare($sql);
		return $query->execute();
	}

}