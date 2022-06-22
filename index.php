<?php
// Include configuration file  
require_once 'config.php'; 
include 'dbConnect.php';
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<script src="https://js.stripe.com/v3/"></script>


<div class="container mb-5 mt-5">
<div id="paymentResponse"></div>

    <div class="pricing card-deck flex-column flex-md-row mb-3">
        <div class="card card-pricing text-center px-3 mb-4">
            <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">Mensal</span>
            <div class="bg-transparent card-header pt-4 border-0">
                <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="15">R$<span class="price">99,00</span><span class="h6 text-muted ml-2"></span></h1>
            </div>

            <div class="card-body pt-0">
                <ul class="list-unstyled mb-4">
                <li>Cancelamento Grátis</li>
                <li>Suporte Tecnico</li>
                </ul>
                <form method="Post" action="checkout.php">
                    <button Type="submit" name="Prod" class="btn btn-outline-secondary mb-3" >Contratar Agora</button>
                </fom>
            </div>
        </div>
        <div class="card card-pricing popular shadow text-center px-3 mb-4">
            <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">Trimestral</span>
            <div class="bg-transparent card-header pt-4 border-0">
                <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="30">R$<span class="price">284,00</span><span class="h6 text-muted ml-2"></span></h1>
            </div>
            <div class="card-body pt-0">
                <ul class="list-unstyled mb-4">
                <li>Cancelamento Grátis</li>
                <li>Suporte Tecnico</li>
                <form method="post" action="checkout.php">
                    <button Type="submit" name="Prod1" class="btn btn-outline-secondary mb-3" >Contratar Agora</button>
                </fom>
                </ul>
            </div>
        </div>
        <div class="card card-pricing text-center px-3 mb-4">
            <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">Semestral</span>
            <div class="bg-transparent card-header pt-4 border-0">
                <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="45">R$<span class="price">539,00</span><span class="h6 text-muted ml-2"></span></h1>
            </div>
            <div class="card-body pt-0">
                <ul class="list-unstyled mb-4">
                <li>Cancelamento Grátis</li>
                <li>Suporte Tecnico</li>
                    <li>Material Design Para 1 Campanha</li>
                    <form method="Post" action="checkout.php">
         
                    <button Type="submit" name="Prod2" class="btn btn-outline-secondary mb-3" >Contratar Agora</button>
                </fom>
                </ul>
            </div>
        </div>
        <div class="card card-pricing text-center px-3 mb-4">
            <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">Anual</span>
            <div class="bg-transparent card-header pt-4 border-0">
                <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="60">R$<span class="price">999,00</span><span class="h6 text-muted ml-2"></span></h1>
            </div>
            <div class="card-body pt-0">
                <ul class="list-unstyled mb-4">
                    <li>Cancelamento Grátis</li>
                    <li>Campanha Impusionada</li>
                    <li>Suporte Tecnico</li>
                    <li>Material Design Para 2 Campanhas</li>
                    <form method="Post" action="checkout.php">

                    <button Type="submit" name="Prod3" class="btn btn-outline-secondary mb-3" >Contratar Agora</button>
</form>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>
</html>