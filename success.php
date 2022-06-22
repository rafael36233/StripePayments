<?php
// Include configuration file 
require_once 'config.php';
include 'dbConnect.php';

    $pageview = $_GET['getID']; 
	$selectproduct =mysqli_query($db_conn, "select * from products where id = '$pageview' ");
    $rowproduct =mysqli_fetch_array($selectproduct,MYSQLI_ASSOC); 			
			
    $payment_id = $statusMsg = '';
    $ordStatus = 'error';

// Check whether stripe checkout session is not empty
if(!empty($_GET['session_id'])){
    $session_id = $_GET['session_id'];
    
    // Fetch transaction data from the database if already exists
    $sql = "SELECT * FROM orders WHERE checkout_session_id = '".$session_id."'";
    $result = $db_conn->query($sql);
	if ( !empty($result->num_rows) && $result->num_rows > 0) {
        $orderData = $result->fetch_assoc();
        
        $paymentID = $orderData['id'];
        $transactionID = $orderData['txn_id'];
        $paidAmount = $orderData['paid_amount'];
        $paidCurrency = $orderData['paid_amount_currency'];
        $paymentStatus = $orderData['payment_status'];
        
        $ordStatus = 'success';
        $statusMsg = 'Transação Realizada Com su';
    }else{
        // Include Stripe PHP library 
        require_once 'stripe-php/init.php';
        
        // Set API key
        \Stripe\Stripe::setApiKey(STRIPE_API_KEY);
        
        // Fetch the Checkout Session to display the JSON result on the success page
        try {
            $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
        }catch(Exception $e) { 
            $api_error = $e->getMessage(); 
        }
        
        if(empty($api_error) && $checkout_session){
            // Retrieve the details of a PaymentIntent
            try {
                $intent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);
            } catch (\Stripe\Exception\ApiErrorException $e) {
                $api_error = $e->getMessage();
            }
            
            // Retrieves the details of customer
            try {
                // Create the PaymentIntent
                $customer = \Stripe\Customer::retrieve($checkout_session->customer);
            } catch (\Stripe\Exception\ApiErrorException $e) {
                $api_error = $e->getMessage();
            }
            
            if(empty($api_error) && $intent){ 
                // Check whether the charge is successful
                if($intent->status == 'succeeded'){
                    // Customer details
                    $name = $customer->name;
                    $email = $customer->email;
                    
                    // Transaction details 
                    $transactionID = $intent->id;
                    $paidAmount = $intent->amount;
                    $paidAmount = ($paidAmount/100);
                    $paidCurrency = $intent->currency;
                    $paymentStatus = $intent->status;
                    
					 // Insert transaction data into the database 
                    
					$sql = "INSERT INTO orders(name,email,item_name,item_number,item_price,item_price_currency,paid_amount,paid_amount_currency,txn_id,payment_status,checkout_session_id,created,modified) VALUES('".$name."','".$email."','".$rowproduct['name']."','".$rowproduct['id']."','".$rowproduct['price']."','".$rowproduct['currency']."','".$paidAmount."','".$paidCurrency."','".$transactionID."','".$paymentStatus."','".$session_id."',NOW(),NOW())"; 
					
                    $insert = $db_conn->query($sql);
                    $paymentID = $db_conn->insert_id;
                    
						$ordStatus = 'success';
						$statusMsg = 'Transação Realizada com Sucesso';
                   
                }else{
                    $statusMsg = "Transaction has been failed!";
                }
            }else{
                $statusMsg = "Unable to fetch the transaction details! $api_error"; 
            }
            
            $ordStatus = 'success';
        }else{
            $statusMsg = "Transaction has been failed! $api_error"; 
        }
    }
}else{
	$statusMsg = "Invalid Request!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta Tags for Bootstrap 5 -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap 5 CSS -->
<link href="css/style.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body class="App">
<!-- Start of Jumbotron -->
<div class="jumbotron jumbotron-fluid">
<div class="container">
<h2><?php echo $statusMsg; ?></h2>
<div class="wrapper">
		<?php if(!empty($paymentID)){ ?>
			<h4>Informações de Pagamento</h4>
			<p><b>Numero de Referencia:</b> <?php echo $paymentID; ?></p>
			<p><b> ID Transação:</b> <?php echo $transactionID; ?></p>
			<p><b>Paid Amount:</b> <?php echo $paidAmount.' '.$paidCurrency; ?></p>
			<p><b> Status do Pagamento:</b> <?php echo $paymentStatus; ?></p>
				
			<h4>Infomação do Produto</h4>
			<p><b>Nome:</b> Assinatura <?php echo $rowproduct['name']; ?></p>
			<p><b>Preço:</b> <?php echo $rowproduct['price'].' '.$rowproduct['currency']; ?></p>
		<?php } ?>
        <p><a href="index.php"  class="btn
btn-primary btn-lg">Ir Para Login</a></p>
	</div>
</div>
</div>
<!-- End of Jumbotron -->
<!-- Bootstrap 5 Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>




