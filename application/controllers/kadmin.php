<?php

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class Kadmin extends Controller
{		

	public function index()
	{

		$title = "Home";
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header_admin.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'footer_admin.php');

	}


	public function orders()
	{
		$title = "All Orders";
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header_admin.php');

		$orders_model = $this->loadModel('OrdersModel');
		$orders = $orders_model->getAllOrders();

		require(ROOT . DS . 'application' . DS . 'views' . DS . 'kadmin' . DS . 'orders.php');		
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'footer_admin.php');
	}


	public function order($order_id)
	{
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header_admin.php');

		$orders_model = $this->loadModel('OrdersModel');
		$products = $orders_model->seeAllAdmin($order_id);

		require(ROOT . DS . 'application' . DS . 'views' . DS . 'kadmin' . DS . 'seeAll.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'footer_admin.php');
	}


	public function completed($order_id)
	{
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header_admin.php');

		$orders_model = $this->loadModel('OrdersModel');
		$completed = $orders_model->orderCompleted($order_id);

		if ($completed) {
			header("Location: /kadmin/orders");
			exit;
		}

		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'footer_admin.php');
	}


	public function all_products()
	{
		$title = "All Products";
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header_admin.php');

		$products_model = $this->loadModel('ProductsModel');
		$products = $products_model->getAllProducts();

		require(ROOT . DS . 'application' . DS . 'views' . DS . 'kadmin' . DS . 'all_products.php');

		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'footer_admin.php');
	}


	public function edit_product($product_id)
	{

		$products_model = $this->loadModel('ProductsModel');

		if (isset($_POST['id'])) {

			$pro_id = $_POST['id'];
			$name = $_POST['name'];
			$category = $_POST['category'];
			$photo = $_POST['photo'];
			$description = $_POST['description'];

			if (empty($name)) {
				echo "Please enter something in the product Name";
			}
			if (empty($category)) {
				echo "Please select a category";
			}
			if (empty($photo)) {
				echo "Please enter photo name";
			}
			if (empty($description)) {
				echo "Please enter a description of product";
			}

			$result = $products_model->updateAProduct($pro_id, $name, $photo, $category, $description);
		}

		$title = "Edit Product";
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header_admin.php');

		$products = $products_model->getAProduct($product_id);
		
		$categories_model = $this->loadModel('CategoriesModel');
		$categories = $categories_model->getAllCategories();

		require(ROOT . DS . 'application' . DS . 'views' . DS . 'kadmin' . DS . 'edit_product.php');

		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'footer_admin.php');

	}


	public function gallary()
	{
		$title = "Gallary";
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header_admin.php');

		$s3 = new S3Client(['credentials' => array('key'=> AWS_S3_KEY, 'secret'=> AWS_S3_SECRET), 'version' => 'latest', 'region'  => AWS_S3_REGION]);
		try {
		    $results = $s3->getPaginator('ListObjects', [
		        'Bucket' => AWS_S3_BUCKET
		    ]);

		} catch (S3Exception $e) {
		    echo $e->getMessage() . PHP_EOL;
		}


		require(ROOT . DS . 'application' . DS . 'views' . DS . 'kadmin' . DS . 'gallary.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'footer_admin.php');
	}


	//Uploading photos using this method
	public function upload()
	{
		$title = "Upload to Gallary";
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header_admin.php');

		$s3 = new S3Client(['credentials' => array('key'=> AWS_S3_KEY, 'secret'=> AWS_S3_SECRET), 'version' => 'latest', 'region'  => AWS_S3_REGION]);

		require(ROOT . DS . 'application' . DS . 'views' . DS . 'kadmin' . DS . 'upload.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'footer_admin.php');

	}


	public function all_categories()
	{
		$title = "All Categories";
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header_admin.php');

		$categories_model = $this->loadModel('CategoriesModel');
		$categories = $categories_model->getAllCategories();

		require(ROOT . DS . 'application' . DS . 'views' . DS . 'kadmin' . DS . 'all_categories.php');

		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'footer_admin.php');
	}

	public function edit_category($category_id)
	{

		$categories_model = $this->loadModel('CategoriesModel');

		$title = "Edit Category";


				if (isset($_POST['id'])) {

					$cat_id = $_POST['id'];
					$name = $_POST['name'];
					$category = $_POST['category'];
					$photo = $_POST['photo'];

					if (empty($name)) {
						echo "Please enter something in the product Name";
					}
					if (empty($category)) {
						echo "Please select a category";
					}
					if (empty($photo)) {
						echo "Please enter photo name";
					}

					$result = $categories_model->updateACategory($cat_id, $name, $photo, $category);
				}

				require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header_admin.php');

				$cats = $categories_model->getAllCategories();
				$scategories = $categories_model->getCategoryByCategoryId($category_id);


				require(ROOT . DS . 'application' . DS . 'views' . DS . 'kadmin' . DS . 'edit_category.php');

				require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'footer_admin.php');
	}


}
