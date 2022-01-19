<?php

class Orders extends Controller
{
	public function index()
	{

		$title = "My Orders";


		$orders_model = $this->loadModel('OrdersModel');
		$orders = $orders_model->getOrders($_COOKIE['user_id']);

		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . 'orders' . DS . 'index.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'footer.php');
	}


	public function cancel($order_id)
	{
		$orders_model = $this->loadModel('OrdersModel');
		$cancelOrder = $orders_model->cancelOrder($order_id, $_COOKIE['user_id']);
		if ($cancelOrder) {

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
						    $mail->Password   = "2020@kansu";

						              $mail->IsHTML(true);
						          $mail->AddAddress("kansupvtltd2020@gmail.com", "Kansu Order");
						          $mail->SetFrom("kansupvtltd2020@gmail.com", "Kansu Order");
						          $mail->Subject = "Kansu Order Cancelled!!!";
						          $content = "<b>A order id has been cancelled. That order was " . $order_id . ".</b>";

						          $mail->MsgHTML($content); 
						            if(!$mail->Send()) {
						              echo "Error while sending Email.";
						              var_dump($mail);
						            } else {
						              echo "Email sent successfully";
						            }

			header("Location: /orders");
		}
		header("Location: /orders");


	}


	public function seeall($order_id)
	{

		$title = "See All Orders";

		$order_model = $this->loadModel('OrdersModel');
		$all = $order_model->seeAll($order_id, $_COOKIE['user_id']);

		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . 'orders' . DS . 'seeall.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'footer.php');
	}

	public function success()
	{

		$title = "Success";

		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . 'orders' . DS . 'success.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'footer.php');		
	}
}
