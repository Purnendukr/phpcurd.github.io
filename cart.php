<?php
  include('connection/config.php');
   include('functions/common_function.php');
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ecommerce website cart details</title>
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
				          <a class="nav-link" href="#">Products</a>
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
				        
			      </ul>
			      
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
				             <a class='nav-link' href='./user/logout.php'>welcome ".$_SESSION['username']."</a>
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
<div class="container">
    <div class="row">
       <form action="" method="post">
        <table class="table table-bordered text-center">
             <!----php code to display dynamic data-->
              
               <?php
                    
                    $get_ip_add = getIPAddress();
                    $total_price=0;
                    $select_query="select * from cart_details where ip_address='$get_ip_add'";
                    $result_query = mysqli_query($conn,$select_query);
                   if(mysqli_num_rows($result_query)>0)
                   {
                       echo "<thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Quantity</th>
                                    <th>Total price</th>
                                    <th>Remove</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                       ";
                       while($row= mysqli_fetch_array($result_query))
                        {
                            $product_id=$row['product_id'];
                            $select_products="select * from products where product_id=$product_id";
                            $result_products= mysqli_query($conn,$select_products);
                            while($row_product_price=mysqli_fetch_array($result_products))
                            {
                                $product_price=array($row_product_price['product_price']);
                                $product_title=$row_product_price['product_title'];
                                $product_image=$row_product_price['product_image1'];
                                $each_product_price=$row_product_price['product_price'];
                                $product_values=array_sum($product_price);
                                $total_price+=$product_values;
                                ?>
                                <tr>
                                    <td><?php echo $product_title; ?></td>
                                    <td>
                                        <img src='Admin/product_images/<?php echo $product_image; ?>' alt='$product_title' width='7%' height='7%'>
                                    </td>
                                    <td><input type='text' value="" name="qty" class='form-input w-50'></td>
                            <?php 
                                $get_ip_add = getIPAddress();
                                if(isset($_POST['update_cart']))
                                 {
                                   $quantites = $_POST['qty'];
                                 //echo "<script>alert($quantites);</script>";
                                $update_cart="update cart_details set quantity=$quantites where ip_address='$get_ip_add'";
                                $result_cart=mysqli_query($conn,$update_cart);
                                $total_price=$total_price*$quantites;
                                            
                                  }
                                    
                                ?>
                                    <td><?php echo $each_product_price; ?>/-</td>
                                    <td><input type='checkbox' name="removeitem[]" value="<?php echo $product_id; ?>"></td>
                                    <td class='inline'>
                                        <input type='submit' name='update_cart' value='Update Cart' class='btn btn-info'>
                                        <input type='submit' name='remove_cart' value='Remove Cart' class='btn btn-info'>
                                    </td>
                                </tr>
                        <?php
                            }

                        }
                       
                   }else{
                       echo "<h3 class='text-center text-danger'>Cart is empty</h3>";
                   }
                    
                 
                ?>
                
            </tbody>
        </table>
        <!--sub Totals--->
        <div class="d-flex mb-5">
           <?php
                $get_ip_add = getIPAddress();
                $select_query="select * from cart_details where ip_address='$get_ip_add'";
                $result_query = mysqli_query($conn,$select_query);
                if(mysqli_num_rows($result_query)>0)
                {
                  echo "<h4>Subtotal: <strong class='text-info'>$total_price /-</strong></h4>
                        <a href='index.php' class='btn btn-info mx-3'>Continue Shopping</a>
                        <a href='./user/checkout.php' class='btn btn-dark mx-3 text-light'>checkout</a>

                   ";
                }
               else{
                   echo "<a href='index.php' class='btn btn-info mx-3'>Continue Shopping</a>";
               }
            ?>
        </div>
     </form>
     <?php
        function remove_cart_item()
        {
            global $conn;
            if(isset($_POST['remove_cart']))
            {
                
                    foreach($_POST['removeitem'] as $remove_id)
                    {
                        //echo $remove_id;
                        $delete_query="delete from cart_details where product_id=$remove_id";
                        $run_delete=mysqli_query($conn,$delete_query);
                        if($run_delete)
                        {
                            echo "<script>window.open('cart.php','_self')</script";
                            
                        }


                    }
                    
                
            }
            
        }
      remove_cart_item();
         
        ?>
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