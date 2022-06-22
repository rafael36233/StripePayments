<?php
require_once 'config.php'; 
include 'dbConnect.php';

if (isset($_POST['Prod'])) {
$produto="Plano Mensal";
$preco="99,00";
$id="1";

}elseif(isset($_POST['Prod1'])) {

    $produto="Plano Trimestral";
    $preco="284,00";
    $id="2";

}elseif(isset($_POST['Prod2'])) {

    $produto="Plano Semestral";
    $preco="539,00";
    $id="3";


}elseif(isset($_POST['Prod3'])) {

    $produto="Plano Anual";
    $preco="999,00";
    $id="4";


}
;
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://js.stripe.com/v3/"></script>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title> Stripe Checkout in PHP by codeat21.com</title>
<meta charset="utf-8">
<!-- Stylesheet file -->
<link href="css/style.css" rel="stylesheet">
<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>
<style>
    .Scroll {
  height:300px;
  overflow-y: scroll;
}
    </style>
</head>
<body class="App">
<div id="paymentResponse"></div>

    <div class="pricing card-deck flex-column flex-md-row mb-3">
        <div class="card card-pricing text-center px-3 mb-4">
            <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm"></span>
            <h5>Termos de Contrato</h5>

          

<div class="Scroll">
  <div class="main" id="section1">
    <h2>CONTRATO	DE	ADESÃO	E	LICENÇA	DE	USO	DE	SOFTWARE	E	PRESTAÇÃO	DE	SERVIÇOS
</h2>
    <p>Click on the link to see the "smooth" scrolling effect.</p>
    <p>Note: Remove the scroll-behavior property to remove smooth scrolling.</p>
  </div>
  <div class="main" id="section2">
    <h2>Section 2</h2>
    <p>Knowing how to write a paragraph is incredibly important. It’s a basic aspect of writing, and it is something that everyone should know how to do. There is a specific structure that you have to follow when you’re writing a paragraph. This structure helps make it easier for the reader to understand what is going on. Through writing good paragraphs, a person can communicate a lot better through their writing.</p>
  </div>
  <div class="main" id="section3">
    <h2>Section 3</h2>
    <p>Knowing how to write a paragraph is incredibly important. It’s a basic aspect of writing, and it is something that everyone should know how to do. There is a specific structure that you have to follow when you’re writing a paragraph. This structure helps make it easier for the reader to understand what is going on. Through writing good paragraphs, a person can communicate a lot better through their writing.</p>
  </div>
  <div class="main" id="section4">
    <h2>Section 4</h2>
    <p>Knowing how to write a paragraph is incredibly important. It’s a basic aspect of writing, and it is something that everyone should know how to do. There is a specific structure that you have to follow when you’re writing a paragraph. This structure helps make it easier for the reader to understand what is going on. Through writing good paragraphs, a person can communicate a lot better through their writing.</p>
  </div>

  <div class="main" id="section5">
    <h2>Section 5</h2>
    <a href="#section1">Click Me to Smooth Scroll to Section 1 Above</a>
  </div>
  <div class="main" id="section6">
    <h2>Section 6</h2>
    <p>Knowing how to write a paragraph is incredibly important. It’s a basic aspect of writing, and it is something that everyone should know how to do. There is a specific structure that you have to follow when you’re writing a paragraph. This structure helps make it easier for the reader to understand what is going on. Through writing good paragraphs, a person can communicate a lot better through their writing.</p>
  </div>
  <div class="main" id="section7">
    <h2>Section 7</h2>
    <a href="#section1">Click Me to Smooth Scroll to Section 1 Above</a>
  </div>
</div>
<br>
            <div class="card-body pt-0">
               
                    <button Type="submit" name="Prod" class="btn btn-outline-secondary mb-3" id="payButton">Contratar Agora</button>
            </div>
        </div>
        
       
      
    </div>
</div>
		
<script>
var buyBtn = document.getElementById('payButton');
var responseContainer = document.getElementById('paymentResponse');    
// Create a Checkout Session with the selected product
var createCheckoutSession = function (stripe) {
    return fetch("stripe_charge.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            checkoutSession: 1,
			Name:"<?php echo $produto?>",
			ID:"<?php echo $id ?>",
			Price:"<?php echo $preco; ?>",
			Currency:"BRL",
        }),
    }).then(function (result) {
        return result.json();
    });
};

// Handle any errors returned from Checkout
var handleResult = function (result) {
    if (result.error) {
        responseContainer.innerHTML = '<p>'+result.error.message+'</p>';
    }
    buyBtn.disabled = false;
    buyBtn.textContent = 'Buy Now';
};

// Specify Stripe publishable key to initialize Stripe.js
var stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

buyBtn.addEventListener("click", function (evt) {
    buyBtn.disabled = true;
    buyBtn.textContent = 'Please wait...';
    createCheckoutSession().then(function (data) {
        if(data.sessionId){
            stripe.redirectToCheckout({
                sessionId: data.sessionId,
            }).then(handleResult);
        }else{
            handleResult(data);
        }
    });
});
</script>
</body>
</html>