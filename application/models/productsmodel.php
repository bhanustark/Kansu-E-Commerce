<?php

class ProductsModel
{

	function __construct($db)
	{
		try {
			$this->db = $db;
		} catch (PDOException $e){
			exit('Database connection error');
		}
	}


	public function getAllProducts()
	{
		$sql = "SELECT * FROM products ORDER BY products.id DESC";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	public function getAProduct($product_id)
	{
		$sql = "SELECT * FROM products WHERE id = '$product_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	public function getAllProductsSearch($text)
	{

		$searchTerms = explode(' ', $text);
		$searchTermBits = array();
		foreach ($searchTerms as $term) {
				$term = trim($term);
				if (!empty($term)) {
						$searchTermBits[] = "products.product_name LIKE '%$term%'";
								$searchTermBitsDes[] = "products.product_description LIKE '%$term%'";
				}
		}

		$sql = "SELECT * FROM products WHERE ". implode(' AND ', $searchTermBits) . " OR " . implode(' AND ', $searchTermBitsDes) ."";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	public function getAllProductsWithPrice()
	{
		$sql = "SELECT products.id, products.product_name, products.product_category_id, products.product_photo, products.product_description, prices.id AS price_id, prices.price, prices.discount_in_rupees, prices.discount_in_percent, prices.offer_price, prices.delivery_charge FROM products INNER JOIN prices ON products.id = prices.product_id ORDER BY products.id DESC";
		$query = $this->db->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();

		return $result;
	}


	public function getAllProductsWithPriceSearch($text)
	{

		$searchTerms = explode(' ', $text);
		$searchTermBits = array();
		foreach ($searchTerms as $term) {
		    $term = trim($term);
		    if (!empty($term)) {
		        $searchTermBits[] = "products.product_name LIKE '%$term%'";
				        $searchTermBitsDes[] = "products.product_description LIKE '%$term%'";
		    }
		}

		$sql = "SELECT products.id, products.product_name, products.product_category_id, products.product_photo, products.product_description, prices.id AS price_id, prices.price, prices.discount_in_rupees, prices.discount_in_percent, prices.offer_price, prices.delivery_charge FROM products INNER JOIN prices ON products.id = prices.product_id WHERE " . implode(' AND ', $searchTermBits) . " OR " . implode(' AND ', $searchTermBitsDes) . " ";
		$query = $this->db->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();

		return $result;
	}


	public function getAProductsWithPrice($product_id)
	{
		$sql = "SELECT products.id, products.product_name, products.product_category_id, products.product_photo, products.product_description, prices.id AS price_id, prices.price, prices.discount_in_rupees, prices.discount_in_percent, prices.offer_price, prices.delivery_charge FROM products INNER JOIN prices ON products.id = prices.product_id WHERE products.id = $product_id";
		$query = $this->db->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();

		return $result;
	}


	public function getCityAvailableProductsPrices($city_id){
		$sql = "SELECT products.id, products.product_name, products.product_category_id, products.product_photo, products.product_description, prices.id AS price_id, prices.price, prices.discount_in_rupees, prices.discount_in_percent, prices.offer_price, prices.delivery_charge from products, prices, city_price_relationships where products.id = prices.product_id and prices.id = city_price_relationships.price_id and city_price_relationships.city_id = $city_id ORDER BY products.id DESC";

		$query = $this->db->prepare($sql);
		$query->execute();

		$results = $query->fetchAll();

		return $results;
	}


	public function getCityAvailableProductPrices($user_id){
		$sql = "SELECT city_id FROM addresses WHERE user_id='$user_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		$results = $query->fetchAll();

		foreach($results as $result) {
			$city_id = $result->city_id;
		}

		$sql = "SELECT price_id FROM city_price_relationships WHERE city_id='$city_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		$price_ids = $query->fetchAll();

		foreach($price_ids as $price_id){
			$array[] = $price_id->price_id;
		}

		return $array;
	}


	public function getProducts($category_id)
	{
		$sql = "SELECT * FROM products WHERE product_category_id = '$category_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	public function getProductsPrice($category_id)
	{
		$sql = "SELECT products.id, products.product_name, products.product_category_id, products.product_photo, products.product_description, prices.id AS price_id, prices.price, prices.discount_in_rupees, prices.discount_in_percent, prices.offer_price, prices.delivery_charge FROM products INNER JOIN prices ON products.id = prices.product_id WHERE products.product_category_id = '$category_id'";
		$query = $this->db->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();

		return $result;

	}



	public function updateAProduct($id,$name,$photo,$category,$description)
	{
		$sql = "UPDATE products SET product_name = '$name', product_category_id = '$category', product_photo = '$photo', product_description = '$description' WHERE id = '$id'";
		$query = $this->db->prepare($sql);
		return $query->execute();
	}


}

