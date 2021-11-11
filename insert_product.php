
<?php
			include "connect.php";
			
			if(isset($_POST["process"]))
			{   
				$id = mysqli_escape_string($conn,$_POST["id"]);
				$name = mysqli_escape_string($conn,$_POST["name"]);
				$image = $_FILES['c_image']['name'];
				$price = mysqli_escape_string($conn,$_POST["price"]);								
				{
				$path = "images/";
				$tmp_name = $_FILES['c_image']['tmp_name'];
				$image = $_FILES['c_image']['name'];

				move_uploaded_file($tmp_name,$path.$image);
			    
					$sql = "insert into tbl_product(id,name,image,price) values('$id','$name','$image','$price')";
					mysqli_query($conn,$sql);
					header('location:index.php');
				}
			}

?>

<div>
	<div><h2 style="color: purple; padding-top: 20px; text-align: center;">Add Product</h2></div>
	<form action="" method="post"  enctype="multipart/form-data">
		<table width="500"  border="1" style="margin: auto;">
			<tr>
				<td>ID</td>
				<td><input type="text" name="id" ></td>
			</tr>
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" ></td>
			</tr>

			<tr>
				<td>Image</td>
				<td><input type="file" name="c_image" ></td>
			</tr>

          <tr>
				<td>Giá</td>
				<td><input type="text" name="price" ></td>
			</tr>
          <tr>

				<td></td>
				<td><input type="submit" name="process" value="Update" ></td>
			</tr>
		</table>
	</form> 
</div>
