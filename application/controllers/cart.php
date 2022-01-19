<?php

class Cart extends Controller
{

	public function index()
	{
		$title = "Cart";
		if(isset($_COOKIE['user_id']) && isset($_COOKIE['email']) && isset($_COOKIE['password'])){

		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header.php'); // old
		//require(ROOT . DS . 'application' . DS . 'views' . DS . 'cart' . DS . 'cartheader.php');
		$added_products_to_cart = $cart_model->getCart($_COOKIE['user_id']);
		$added_products = $cart_model->getCartItemsDetails($_COOKIE['user_id']);

		$address_model = $this->loadModel('AddressModel');
		$addresses = $address_model->getCityDistance($_COOKIE['user_id']);
		$address = null;

		foreach($addresses as $addr){
			$address = $addr;
		}
 		require(ROOT . DS . 'application' . DS . 'views' . DS . 'Jarvis' . DS . 'ucart.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . 'Jarvis' . DS .'footer.php');
		}
		else
		{
			header("Location: /");
		}
	}



	public function add()
	{
		if(isset($_COOKIE['user_id']) && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
			$products_model = $this->loadModel('ProductsModel');

			$address_model = $this->loadModel('AddressModel');
			$isSetUserAddress = $address_model->getAddresses($_COOKIE['user_id']);

			if(!$isSetUserAddress){
			  header("Location: /myaddresses/selectpincode");

			}
			else
			{			
				$products = $products_model->getAllProducts();
			}

			if(isset($_POST['product_id'])){
				$products = $products_model->getAProductsWithPrice($_POST['product_id']);
				$price_ids = $products_model->getCityAvailableProductPrices($_COOKIE['user_id']);
				foreach($products as $product) {
					if(in_array($product->price_id,$price_ids)){
						$product_price_id = $product->price_id;
					}
				}

				$cart_model = $this->loadModel('CartModel');				
				$add = $cart_model->addToCart($_COOKIE['user_id'],$_POST['product_id'],$product_price_id);
				if($add){
					echo "Product added to cart";
				}
				else {
					echo "Something went wrong";
				}
			}
		}
	}

	public function remove()
	{
		if(isset($_COOKIE['user_id']) && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
			if(isset($_POST['cart_id'])){
				$cart_model = $this->loadModel('CartModel');
				$result = $cart_model->removeFromCart($_POST['cart_id'], $_COOKIE['user_id']);

				if($result){
					echo "Product removed from cart";
				}
				else {
					echo "Error Occured";
				}
			}
		}
		
	}


	public function checkoutqty()
	{
		            echo('chechout with qty|');
		            $cart_model = $this->loadModel('CartModel');
					$added_products = $cart_model->getCartItemsDetails($_COOKIE['user_id']);
					$getCartCount = $cart_model->getCartCount($_COOKIE['user_id']);

					$address_model = $this->loadModel('AddressModel');
					$addresses = $address_model->getCityDistance($_COOKIE['user_id']);
					$address = null;

					foreach($addresses as $addr){
						$address = $addr;
					}

					$total = array();
					
					if ($getCartCount == 0) {
						header("Location: /");
						die;
					}

		foreach($added_products as $added_product){

			/*if((int)$added_product->offer_price != 0){
				 $total[] = $added_product->offer_price;  } else { 
					 $total[] = $added_product->price;  } */
					 echo ($added_product->offer_price);
					 echo ('<br');
					 echo ($added_product->price);
					 echo ('<br');
					 echo ($added_product->id);
					 echo ('<br');

			}
		
	}
	public function checkout($pay_type)
	{


		if(isset($_COOKIE['user_id']) && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
			if(!empty($pay_type)) {
				if($pay_type == "cod") {
					$cart_model = $this->loadModel('CartModel');
					$added_products = $cart_model->getCartItemsDetails($_COOKIE['user_id']);
					$getCartCount = $cart_model->getCartCount($_COOKIE['user_id']);

					$address_model = $this->loadModel('AddressModel');
					$addresses = $address_model->getCityDistance($_COOKIE['user_id']);
					$address = null;

					foreach($addresses as $addr){
						$address = $addr;
					}

					$total = array();
					
					if ($getCartCount == 0) {
						header("Location: /");
						die;
					}

					foreach($added_products as $added_product){
					if((int)$added_product->offer_price != 0){ $total[] = $added_product->offer_price;  } else { $total[] = $added_product->price;  } 
					}
					

				  $delivery_charge = 0;
				  $grand_total = 0;
				  $great_grand_total = 0;

				foreach($total as $price){
				  (int)$grand_total = (int)$grand_total + (int)$price;
				}

				if((int)$address->distance == 1 || (int)$address->distance == 2 ){
				  $delivery_charge = 10;
				    if((int)$grand_total >= 300){
				    $delivery_charge = 0;
				  }
				} else if((int)$address->distance == 3 || (int)$address->distance == 4 ){
				  $delivery_charge = 20;
				  if((int)$grand_total >= 500){
				    $delivery_charge = 0;
				  }
				} else if((int)$address->distance > 4){
				  $delivery_charge = (int)$address->distance * 10;
				}


				  $great_grand_total = (int)$grand_total + (int)$delivery_charge; 

				  $last_id = $cart_model->placeOrder($_COOKIE['user_id'],$address->id,$great_grand_total,0,0);

				  	foreach($added_products as $added_product){
						$cart_model->moveFromCartToOrdered($last_id,$added_product->product_id,$added_product->price_id,$_COOKIE['user_id']); 
					}

					require ROOT . DS . 'custom' . DS . 'phpmailer' . DS . 'phpmailer' . DS . 'src' . DS . 'Exception.php';
					require ROOT . DS . 'custom' . DS . 'phpmailer' . DS . 'phpmailer' . DS . 'src' . DS . 'PHPMailer.php';
					require ROOT . DS . 'custom' . DS . 'phpmailer' . DS . 'phpmailer' . DS . 'src' . DS . 'SMTP.php';
						$mail = new PHPMailer\PHPMailer\PHPMailer();
						    $mail->IsSMTP();
						    $mail->Mailer = "smtp";

						    $mail->SMTPDebug  = 1;  
						    $mail->SMTPAuth   = TRUE;
						    $mail->SMTPSecure = "tls";
						    $mail->Port       = 587;
						    $mail->Host       = "smtp.gmail.com";
						    $mail->Username   = "kansupvtltd2020@gmail.com";
						    $mail->Password   = "iloveyou@2020";

						          $mail->IsHTML(true);
						          $mail->SetFrom("kansupvtltd2020@gmail.com", "Kansu");
						          $mail->AddAddress("kansupvtltd2020@gmail.com", "Kansu");
						          $mail->Subject = "Kansu New Order!!!";
						          $content = "<b>There is a new Order. Order id is " . $last_id . ".</b>";

						          $mail->MsgHTML($content); 
						            if(!$mail->Send()) {
						              echo "Error while sending Email.";
						              var_dump($mail);
						            } else {
						              echo "Email sent successfully";
						            }

					header("Location: /orders/success");

				}				
			}
		}


	}

}
