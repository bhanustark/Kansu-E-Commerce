<?php

class Home extends Controller
{
	public function index()
	{

		$products_model = $this->loadModel('ProductsModel');
		$categories_model = $this->loadModel('CategoriesModel');
		$categories = $categories_model->getAllCategories();

		if(isset($_COOKIE['user_id']) && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {

			$address_model = $this->loadModel('AddressModel');
			$isSetUserAddress = $address_model->getAddresses($_COOKIE['user_id']);

			if(!$isSetUserAddress){
			  header("Location: /myaddresses/selectpincode");
			}

			foreach ($isSetUserAddress as $address) {
				$city = $address->city_id;
			}

			//$products = $products_model->getAllProductsWithPrice();
			$products = $products_model->getCityAvailableProductsPrices($city);


		}
		else
		{			
			$products = $products_model->getAllProducts();
		}


     	/*require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header_home.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . 'home' . DS . 'index.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS .'footer.php');*/

		require(ROOT . DS . 'application' . DS . 'views' . DS . 'Jarvis' . DS . 'header.php'); // Jarvis
		require(ROOT . DS . 'application' . DS . 'views' . DS . 'Jarvis' . DS . 'index.php');  //JArvis
		require(ROOT . DS . 'application' . DS . 'views' . DS . 'Jarvis' . DS .'footer.php'); //Jarvis
		
	}


	public function search($text)
	{

		if(!empty($text)){

			$text = $_SERVER['REQUEST_URI'];
			$text = str_replace('/home/search/','',$text);
			$text = str_replace('%20',' ',$text);

			if (strpos($text, "?page") !== false) {
				$text_ar = explode("?", $text);
				$text = $text_ar[0];
			}

			$products_model = $this->loadModel('ProductsModel');
			$categories_model = $this->loadModel('CategoriesModel');
			$categories = $categories_model->getAllCategories();

			if(isset($_COOKIE['user_id']) && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
				$products = $products_model->getAllProductsWithPriceSearch($text);
				$price_ids = $products_model->getCityAvailableProductsPrices($_COOKIE['user_id']);

				$address_model = $this->loadModel('AddressModel');
				$isSetUserAddress = $address_model->getAddresses($_COOKIE['user_id']);

				if(!$isSetUserAddress){
				  header("Location: /myaddresses/selectpincode");
				}

			}
			else
			{			
				$products = $products_model->getAllProductsSearch($text);
			}

			$title = $text . " - Search";

			require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header.php');
			require(ROOT . DS . 'application' . DS . 'views' . DS . 'home' . DS . 'index.php');
			require(ROOT . DS . 'application' . DS . 'views' . DS . 'Jarvis' . DS .'footer.php');

		}

	}


	public function searchnow()
	{
		if(isset($_POST['text'])){
			$text = $_POST['text'];
			header("Location: /home/search/" . $text);
			exit();
		}
	}


	public function logout()
	{
		require(ROOT . DS . 'application' . DS . 'views' . DS . 'home' . DS . 'logout.php');
	}

}
