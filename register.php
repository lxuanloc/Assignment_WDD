<div class="register_box">
  <form method = "post" action="" enctype="multipart/form-data">
    <table align="left" width="70%">
      <tr align="left">
        <td colspan="4"><h2>Register.</h2>
          <br />
          <span> Already have account? <a href="login.php">Login Now.</a><br />
          <br />
          </span></td>
      </tr>
      <tr>
        <td width="15%"><b>UserName:</b></td>
        <td colspan="3"><input type="text" name="username" required placeholder="UserName" /></td>
      </tr>
      <tr>
        <td width="15%"><b>Password:</b></td>
        <td colspan="3"><input type="password" id="password_confirm1" name="password" required placeholder="Password" /></td>
      </tr>
      <tr>
        <td width="15%"><b>Confirm Password:</b></td>
        <td colspan="3"><input type="password" id="password_confirm2" name="confirm_password" required placeholder="Confirm Password" />
      </tr>
      <tr align="left">
        <td></td>
        <td colspan="4"><input type="submit" name="register" value="Register" /></td>
      </tr>
    </table>
  </form>
</div>
<?php
$con = new mysqli('localhost', 'root', '', 'testing');
if (!$con) {
    echo "ket noi that bai";
}
if (isset($_POST['register'])) {
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $check_exist = mysqli_query($con, "select * from account where username = '$username'");
        $username_count = mysqli_num_rows($check_exist);
        $row_register = mysqli_fetch_array($check_exist);
        if ($username_count > 0) {
            echo "<script>alert('Sorry, your username already exist in our database !')</script>";
        } elseif ($row_register['username'] != $username && $password == $confirm_password) {
            $run_insert = mysqli_query($con, "insert into account values ('$username','$password') ");
            if ($run_insert) {
                echo "<script>alert('Account has been created successfully!')</script>";
                echo "<script>window.open('login.php','_self')</script>";
            }
        }
    }
}
?>

</div>