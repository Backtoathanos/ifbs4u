<?php session_start();

if(!isset($_SESSION['user']))
 
{
 
    $now = time();
 // checking the time now when home page starts
 
    if($now > @$_SESSION['expire']){

        session_unset(@$_SESSION['user']);
 
    }else{
      header('Location: index.php');
    }

}

?>
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/Article">
<head>
    
	<meta charset="utf-8">
	
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    
    <meta name="Description" content="All Groceries in Jamshedpur. Know Your Limits. We do Online Vegitables Fruits Dry Fruits At Cheap Market Rate. You Don't Need To Go Market Just Buy Your Choice From Our Websites We Will Deliver At You. T&C Applied.">
    
    <meta name="google-site-verification" content="_34m5e6o_9ZpoZRiITd6EhEY5Qm-w-aUnBPMuhsI1Ao"/>
    
    <meta name="keywords" content="Azim Equbal,Nausher Khan, ifbs, ifbs4u">
    
    <title>FBS Megamart Jamshedpur - Shop Here Your Groceries at Cheap Price - ifbs4u</title>
    
    <meta name="robots" content="index">
 
  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- BEGIN Pre-requisites -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="https://apis.google.com/js/client:platform.js?onload=start" async defer></script>
    <!-- END Pre-requisites -->
     
    <link rel="stylesheet" type="text/css" href="include/assets/images/fbstitle.png">
    <link rel = "icon" type = "image/png" href="include/assets/images/fbstitle.png">
    <!-- For apple devices -->
    <link rel = "apple-touch-icon" type = "image/png" href="include/assets/images/fbstitle.png">

    <link rel="stylesheet" href="include/assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="include/assets/css/style.css">

    <link rel="stylesheet" href="include/assets/css/response.css">
  
    <link rel="stylesheet" href="include/assets/css/nav.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
    
    <link href="include/assets/css/flexslider.css" rel="stylesheet">

</head>
<body>

<div class="container-fluid">
  <div id="header" class="row">

    <header>
      <div class="col-sm-5">
        <div class="nav-logo">
          <!-- menu bar -->
          <div>
            <a href="#" id="menu-icon-bar"><i class="fa fa-bars"></i></a>
          </div>
          <!-- logo -->
          <div>
            <a id="logo-a" href="index.php"><img src="include/assets/images/fbs.png"></a>
          </div>
          <!-- search -->
          <div id="search-nav">
            <input type="text" placeholder="Find Poducts By Name" id="search-box"><a id="close-search-field" ><i class="fa fa-arrow-up"></i></a>
            <div id="search-res-box">
              
            </div>
          </div>
          <div id="res-cart-btn">
            <a href="cart.php"><i class="fa fa-shopping-cart"></i><span class="badge"></span></a>
          </div>
          <div id="res-cart-btn">
            <a href="index.php"><i class="fa fa-home"></i></a>
          </div>
          
        </div>
      </div>
      <div class="col-sm-7">
        <nav>
          <ul>
            <?php
        if(@$_SESSION['user']){
          
          echo '<li><a href="#">Hey '.@$_SESSION['user_name'].' <i class="fa fa-caret-down"></i></a>
                  <ul>
                    <li><a href="order_history.php">Order history</a></li>
                    <li><a href="user.php">My account</a></li>
                    <li><a href="actions/logout.php">Logout</a></li>
                  </ul>
                </li>';
          
        }else{
          
          echo '<li id="login"><a href="login.php">Hey You/Login</a></li>';
         
        }
          ?>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Categories <i class="fa fa-caret-down"></i></a>
                  <ul class="show_product_at_id">
                  </ul>
                </li>
                <!-- <li><a href="news.php">News</a></li> -->
                <li id="desk-cart-btn"><a href="cart.php"><i class="fa fa-shopping-cart"></i>Cart <span class="badge"></span></a></li> 
          </ul>
        </nav>
      </div>
    </header>
  </div>
</div>
			
   <!-- start a container end in footer.php -->
<div class="container">
	<div class="row all-page">