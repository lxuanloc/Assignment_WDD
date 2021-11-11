<div class="login_box">
  <form method = "post" action="">
    <table align="left" width="70%">
      <tr align="left">
        <td colspan="4"><h2>Login.</h2>
          <br />
          <span> Don't have account? <a href="register.php">Register Here</a><br />
          <br />
          </span></td>
      </tr>
      <tr>
        <td width="15%"><b>UserName:</b></td>
        <td colspan="3"><input type="text" name="username" required placeholder="username" /></td>
      </tr>
      <tr>
        <td width="15%"><b>Password:</b></td>
        <td colspan="3"><input type="password" name="password" required placeholder="Password" /></td>
      </tr>
      <tr align="left">
        <td></td>
        <td colspan="4"><input type="submit" name="login" value="Login" /></td>
      </tr>
    </table>
  </form>
</div>
<?php 
$con = new mysqli('localhost', 'root', '', 'testing');
			if (!$con){
				echo "ket noi that bai";				
			}
if(isset($_POST['login'])){
  
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  $result = mysqli_query($con, "select * from account where username='$username' AND password='$password' " );
  
  $check_login = mysqli_num_rows($result);
  
  $row_login = mysqli_fetch_array($result);
  
  if($check_login == 0){
   echo "<script>alert('Password or username is incorrect, please try again!')</script>";
   exit();
  }  
  if($check_login > 0){ 
  
  echo "<script>alert('You have logged in successfully !')</script>";
  echo "<script>window.open('index.php','_self')</script>";
  
  }
}

?>