<?php

class CategoriesModel
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


	public function getAllCategories()
	{
		$sql = "SELECT * FROM categories";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	public function getAllParentCategories()
	{
		$sql = "SELECT * FROM categories WHERE is_sub_category = '0'";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	public function getSubCategories($category_id)
	{
		$sql = "SELECT * FROM categories WHERE parent_category_id = '$category_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	public function getSubCategoryDetails($category_id)
	{
		$sql = "SELECT * FROM categories WHERE id = '$category_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	public function getCategory($product_id)
	{
		$sql = "SELECT product_category_id FROM products WHERE id = '$product_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		$results = $query->fetchAll();
		$category_id = null;

		foreach($results as $result) {
			$category_id = $result->product_category_id;
		}

		$sql = "SELECT * FROM categories WHERE id = '$category_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	public function getAllSubCategoriesProducts($category_id)
	{

	}

	public function getCategoryByCategoryId($category_id)
	{
		$sql = "SELECT * FROM categories WHERE id = '$category_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	public function updateACategory($cat_id, $name, $photo, $category)
	{
		if ($category == "null") {
			$sql = "UPDATE categories SET category_name = '$name', is_sub_category = '0', parent_category_id = 'NULL', category_image = '$photo' WHERE id = '$cat_id'";
		} else {
			$sql = "UPDATE categories SET category_name = '$name', is_sub_category = '1', parent_category_id = '$category', category_image = '$photo' WHERE id = '$cat_id'";
		}

		$query = $this->db->prepare($sql);
		return $query->execute();

}


}

?>
