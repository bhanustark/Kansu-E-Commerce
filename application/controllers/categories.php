<?php

class Categories extends Controller
{
	public function index()
	{

		$title = "Categories";
		$categories_model = $this->loadModel('CategoriesModel');
		$categories = $categories_model->getAllCategories();

		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . 'Jarvis' . DS . 'categoryindex.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . 'Jarvis' . DS .'footer.php');
	}


	public function product($product_id)
	{
		require(ROOT . DS . 'application' . DS . 'views' . DS . 'home' . DS . 'homeOne.php');
	}


	public function category($cat_id)
	{
		$category_id = $cat_id;
		$categories_model = $this->loadModel('CategoriesModel');
		$address_model = $this->loadModel('AddressModel');
		$products_model = $this->loadModel('ProductsModel');
		$categories = $categories_model->getSubCategories($category_id);
		$parent_details = $categories_model->getSubCategoryDetails($category_id);

		foreach($parent_details as $parent_detail) {
			$title = $parent_detail->category_name;
		}

		if(empty($categories)){

			if(isset($_COOKIE['user_id']) && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
				$products = $products_model->getProductsPrice($cat_id);
				$price_ids = $products_model->getCityAvailableProductsPrices($_COOKIE['user_id']);

				$isSetUserAddress = $address_model->getAddresses($_COOKIE['user_id']);

				if(!$isSetUserAddress){
				  header("Location: /myaddresses/selectpincode");
				}

			}
			else
			{			
				$products = $products_model->getProducts($category_id);
			}

			require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header.php');
			require(ROOT . DS . 'application' . DS . 'views' . DS . 'Jarvis' . DS . 'category.php');
			require(ROOT . DS . 'application' . DS . 'views' . DS . 'Jarvis' . DS .'footer.php');
			
		} else {

			$text = $title;

			if(isset($_COOKIE['user_id']) && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
				$products = $products_model->getAllProductsWithPriceSearch($text);
				$price_ids = $products_model->getCityAvailableProductsPrices($_COOKIE['user_id']);
				$isSetUserAddress = $address_model->getAddresses($_COOKIE['user_id']);

				if(!$isSetUserAddress){
				  header("Location: /myaddresses/selectpincode");
				}

			}
			else
			{			
				$products = $products_model->getAllProductsSearch($text);
			}
		
			require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header.php');
			require(ROOT . DS . 'application' . DS . 'views' . DS . 'Jarvis' . DS . 'category.php');
			require(ROOT . DS . 'application' . DS . 'views' . DS . 'Jarvis' . DS .'footer.php');
		}

	}

}