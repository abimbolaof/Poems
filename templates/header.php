<?php
error_reporting(0);
include 'session_config.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge" />
<meta name="description"
	content="Olusegun Abimbola (Software Engineer)">
<meta name="keywords"
	content="software, java, segun, abimbola, yoruba, orisa, ife, tradition, medicine, ifa, audio, video, sango, oyo, java, html, css, javascript, computer, nigeria, usa">
<meta name="robots" content="index,follow,archive">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" type="text/css"
	href="resources/css/stylesheetbig.css" />
<script type="text/javascript"
	src="resources/js/mainscript.js"></script>
<script type="text/javascript"
	src="resources/js/irokocart.js"></script>
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<title>SonOfIroko &trade;</title>
</head>


<body>
	<header>
		<div id="page-header">
			<div id="page-logo">
			<a href="http://www.sonofiroko.com">SonOfIroko</a>
			</div>	
            
            <div id="top-right-menu" style="display:none;">
                <div id="cart-icon-span-div">
                    <a href="viewcart.php">
                        <img id="cart-icon" src="resources/images/cart.png"/>
                        <span>Cart (<span id="cart-icon-span" unselectable="yes" onselectstart="return false" onmousedown="return false">
                            <?php 
                            if (isset($_SESSION['cartitems'])){
                                $c = count($_SESSION['cartitems']);
                                if ($c > 0)
                                    echo $c;
                                else
                                    echo "0";
                            }
                            ?>
                        </span>)</span>
                    </a>
                </div>
                <!--<img id="user-icon" src="../resources/images/user-out-icon.png"/>
                <div id="user-menu">
                   
                </div>-->
            </div>
		</div>
        
        <div id="handle">
				<img src="resources/images/menu-icon.png"/>
		</div>
		<nav id="navbar">
			<ul id="menuwrapper" class="">
                <li><a href="http://www.sonofiroko.com">home</a></li>
                <li><a href="http://poems.sonofiroko.com">poems</a></li>
				<li><a href="http://store.sonofiroko.com">store</a></li>
			</ul>
        </nav>
	</header>