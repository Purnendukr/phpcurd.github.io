<?php
  include('./connection/config.php');
   include('./functions/common_function.php');
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ecommerce website</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-----font awesome cdn links---->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	<!----bootsrtap css links----->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

	<!----custom css files---->
	<link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>
  <!----navbar--->
  <div class="container-fluid p-0">
  	  <!----first child--->
	  	<nav class="navbar navbar-expand-lg bg-info">
			  <div class="container-fluid">
			    <a class="navbar-brand" href="#">Logo</a>
			    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			      <span class="navbar-toggler-icon"></span>
			    </button>
			    <div class="collapse navbar-collapse" id="navbarSupportedContent">
			      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
				        <li class="nav-item">
				          <a class="nav-link active" aria-current="page" href="/project_with_php/">Home</a>
				        </li>
				        <li class="nav-item">
				          <a class="nav-link" href="display_all.php">Products</a>
				        </li>
				       if(isset($_SESSION['username']))
                           {
                               echo "<li class='nav-item'>
                                     <a class='nav-link' href='./user/user_profile.php'>MyAccount</a>
                                    </li>";
                           }
                         else{
                             echo "<li class='nav-item'>
                                      <a class='nav-link' href='./user/user_registration.php'>Register</a>
                                    </li>";
                         }
                      
                        ?>
				        <li class="nav-item">
				          <a class="nav-link" href="#">Contact</a>
				        </li>
				        <li class="nav-item">
				          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i>
				          <sup><?php  cart_item(); ?></sup></a>
				        </li>
				        <li class="nav-item">
				          <a class="nav-link" href="#">Total Price: <?php total_cart_price(); ?>/-</a>
				        </li>
			      </ul>
			      <form method="get" action="search_product.php" class="d-flex" role="search" enctype="multipart/form-data">
			        <input class="form-control me-2" type="search" name="search_data" placeholder="Search" aria-label="Search">
			        <input type="submit" value="search" name="search_data_product" class="btn btn-outline-light">
			      </form>
			    </div>
			  </div>
		</nav>
		
		<?php
            //calling cart function
            cart();
        ?>
	 <!----second child----->
	  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
			<ul class="navbar-nav me-auto">
				
				<?php
                if(!isset($_SESSION['username']))
                   {
                       echo "<li class='nav-item'>
                               <a class='nav-link' href='#'>Wecome Gust</a>
                            </li>";
                   }
                   else{
                       echo "<li class='nav-item'>
				             <a class='nav-link' href='./user/user_profile.php'>welcome ".$_SESSION['username']."</a>
				            </li>";
                       
                   }
                
                   if(!isset($_SESSION['username']))
                   {
                       echo "<li class='nav-item'>
				             <a class='nav-link' href='./user/user_login.php'>Login</a>
				            </li>";
                   }
                   else{
                       echo "<li class='nav-item'>
				             <a class='nav-link' href='./user/logout.php'>Logout</a>
				            </li>";
                       
                   }
                ?>
			</ul>
	 </nav>
	 <!----third child---->
	 <div class="bg-light">
		<h3 class="text-center">Hidden store</h3>
		<p class="text-center">Communication is at the heart of e-commerce</p>
	 </div>

	 <!----fourth child---->
	 <div class="row">
			<div class="col-md-2 bg-secondary p-0">
				<!---brands display---->
				<ul class="navbar-nav me-auto">
					<li class="nav-item bg-info">
				        <a class="nav-link text-light text-center" href="#"><h4>Delivery Brands</h4></a>
				    </li>
				    <?php
                       //calling function
                      getbrands();
                    ?>
				</ul> 

				<!-----category disply---->
				<ul class="navbar-nav me-auto">
					<li class="nav-item bg-info">
				        <a class="nav-link text-light text-center" href="#"><h4>Categories</h4></a>
				    </li>
				    <?php
                     //calling function
                      getcategories();
                    ?>
				    
				    
				</ul> 
				
			</div>
			<div class="col-md-10">
				<!----products--->
				<div class="row">
				<!---fetch products--->
				<?php
                    //calling function
                    getproducts();
                    get_unique_categories();
                    get_unique_brand();
                    $ip = getIPAddress();  
                    echo 'User Real IP Address - '.$ip;
                ?>
				</div>
				
			 </div>
	 </div>
	 <!---last child---->
	 <div class="bg-info p-3">
		<p class="text-center">All right reserved Designed by Purnendukumar</p>
	 </div>
  </div>




<!------bootstrap js links------>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>