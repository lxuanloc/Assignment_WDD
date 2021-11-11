<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "testing");

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="index.php"</script>';
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>CB Skateboard</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <div class="container">
		  <a href="index.php"><img src="Logo.jpg" width="150" height="150" ></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

	      <div class="collapse navbar-collapse" id="navbarSupportedContent">
	          <ul class="navbar-nav mr-auto">
	              <li class="nav-item active">
	                 
	              </li>
	     
	              </li>
	              <li class="nav-item dropdown">
	                  <a class="nav-link" href="#" id="navbarDropdown">
	                  	<b> SKATEBOARD </b>
                  </a>
                  <div class="dropdown-content">	
                     <a class="dropdown-item" href="deck.php">Deck</a>
                      <a class="dropdown-item" href="truck.php">Truck</a>
                      <a class="dropdown-item" href="bearing.php">Bearings</a>
                      <a class="dropdown-item" href="wheels.php">Wheels</a>
                      <a class="dropdown-item" href="griptape.php">Griptape</a>
	                    
	                  
	                  </div>
	              </li>
	              <li class="nav-item dropdown">
	                  <a class="nav-link" href="#" id="navbarDropdown">
	                     <b>CLOTHINGS</b>
	                  </a>
	                  <div class="dropdown-content">
	                      <a class="dropdown-item" href="tops.html">Tops</a>
	                      <a class="dropdown-item" href="bottom.html">Bottom</a>
	                      <a class="dropdown-item" href="footwear.html">Footwear</a>
	                      <a class="dropdown-item" href="headwear.html">Headwear</a>


	                      
	                  </div>
	              </li>
	              <li class="nav-item dropdown">
	                  <a class="nav-link" href="#" id="navbarDropdown">
	                     <b>ACCESSORIES</b>
	                  </a>
	                  <div class="dropdown-content">
	                      <a class="dropdown-item" href="#">Backpacks</a>
	                      <a class="dropdown-item" href="#">Other </a>
	                      
	                  </div>
	              </li>
	              <li class="nav-item dropdown">
	                  <a class="nav-link" href="#" id="navbarDropdown">
	                      <b>CUSTOMER SERVICES</b>
	                  </a>
	                  <div class="dropdown-content">
	                  <a class="dropdown-item" href="#">Hotline</a>
	                  <a class="dropdown-item" href="#">FAQ</a>
	             
	                  </div>
	              </li>
	          </ul>
	          <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	          		  <a class="nav-link" href="login.php" >Login</a>
	          		   <a class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></a>
          </form>
	          
 						
					



	          </div>
	      </div>
	  </div>
</nav>


<div class="container">
	<div class="row mt-5">
		<h2 class="list-product-title">FEATURE PRODUCT</h2>
		<div class="list-product-subtitle">
			<p>List product description</p>
		</div>
  		
		
		
			<?php
				$query = "SELECT * FROM tbl_product WHERE type = 2 ORDER BY id ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<div class="col-md-4">
				<form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style="border:4px solid #333; background-color:#f1f1f1; border-radius:10px; padding:16px; margin-bottom: 40px" align="center">
						<img src="images/<?php echo $row["image"]; ?>" class="img-responsive" /><br />

						<h4 class="text-info"><?php echo $row["name"]; ?></h4>

						<h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>

						<input type="text" name="quantity" value="1" class="form-control" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />

					</div>
				</form>
			</div>
			<?php
					}
				}
			?>
			<div style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$ <?php echo $values["item_price"]; ?></td>
						<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}
					?>
						
				</table>
			</div>
		</div>
	</div>
	<br />
	<a align="center">CB - <a href="insert_product.php" title="Simple PHP Mysql Shopping Cart">Skateboard</a>
	</body>

<footer>
     <div class="container">
         <div class="noi-dung about">
             <h2>About Us</h2>
             <p> The site is made for non-profit purposes.</p>
             <ul class="social-icon">
                 <li><a href="https://www.facebook.com/cuzunerverknow/"><i class="fa fa-facebook"></i></a></li>
                 <li><a href=""><i class="fa fa-twitter"></i></a></li>
                 <li><a href=""><i class="fa fa-instagram"></i></a></li>
                 <li><a href=""><i class="fa fa-youtube"></i></a></li>
             </ul>
         </div>

         
         <div class="noi-dung links">
             <h2>Links</h2>
             <ul>
                 <li><a href="#">Homepage</a></li>
                 <li><a href="#">About Us</a></li>
                 <li><a href="#">Contacts</a></li>
                 <li><a href="#">Service</a></li>
                 <li><a href="#">Policy Conditions</a></li>
             </ul>
         </div>
         
         <div class="noi-dung contact">
             <h2>Contact info</h2>
             <ul class="info">
                 <li>
                     <span><i class="fa fa-map-marker"></i></span>
                     <span>1st Street<br />
                         District California, New York <br />
                         US</span>
                 </li>
                 <li>
                     <span><i class="fa fa-phone"></i></span>
                     <p><a href="#">+84 123 456 789</a>
                         
                 </li>
                 <li>
                     <span><i class="fa fa-envelope"></i></span>
                     <p><a href="#">justskatething@gmail.com</a></p>
                </li>
                 <li>
                     <form class="form">
                         <input type="email" class="form__field" placeholder=" Subscribe Email" />
                         <button type="button" class="btn btn--primary  uppercase">Sent</button>
                     </form>
                 </li>
             </ul>
         </div>
         <!--Kết Thúc Nội Dung Liên Hệ-->
     </div>
 </footer>

</html>

	
 
</script>