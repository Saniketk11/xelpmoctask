<?php 
    include("database.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel="stylesheet" href="styles/login_style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<body>
    <section>
      <div class="container">
        <div class="user signinBx">
          <div class="imgBx"><img src="images/login.jpg" /></div>
          <div class="formBx">
            <form action="" method="post">
              <h2>Sign In</h2>
              <input type="text" name="username" placeholder="Username" required/>
              <input type="password" name="password" placeholder="Password" required />
              <input type="submit" name="login" value="Login" />
              <p class="signup">
                Don't have an account ?<a href="#" onclick="toggleForm();">
                  Sign Up
                </a>
              </p>
            </form>
          </div>
        </div>
        <div class="user signupBx">
          <div class="formBx">
            <form action="" method="post">
              <h2>Create an Account</h2>
              <input type="text" name="s_username" placeholder="Username" required/>
              <input type="email" name="s_email" placeholder="Email Id" required/>
              <input type="password" name="s_password" placeholder="Create Password" required/>
              <input type="password" name="sc_username" placeholder="Confirm Password" required/>
              <input type="submit" name="signup" value="Sign Up" />
              <p class="signup">
                Already have an account ?
                <a href="#" onclick="toggleForm();"> Sign In </a>
              </p>
            </form>
          </div>
          <div class="imgBx"><img src="images/signup.jpg" /></div>
        </div>
      </div>
    </section>
 
  </body>
<!-- partial -->
  <script  src="styles/js.js"></script>

</body>
</html>
<?php 
if(isset($_POST["login"]))
{
    $username=$_POST["username"];
    $password=$_POST["password"];
    $hash=md5($password);
    $select="select * from user where username='$username'";
    $query=mysqli_query($connection,$select);
    $u=mysqli_num_rows($query);
    if($u==0)
    {
        echo "<script> alert('Invalid User')</script>";

    }

    while($fetch=mysqli_fetch_array($query))
    {
        $cpassword=$fetch["password"];
        if($cpassword==$hash)
        {
            $_SESSION["user"]=$username;
            echo "<script> alert('Login Succesfully')</script>";
            echo "<script> window.location.href='index.php'; </script>";

        }
        else
        {
            echo "<script> alert('Invalid Password')</script>";

        }
    }


}

if(isset($_POST["signup"]))
{
    $username=$_POST["s_username"];
    $password=$_POST["s_password"];
    $sc_password=$_POST["sc_password"];
    $email=$_POST["s_email"];
    $hash=md5($password);
    $select="select * from user where username='$username'";
    $query=mysqli_query($connection,$select);
    $u=mysqli_num_rows($query);

    $select2="select * from user where email='$email'";
    $query2=mysqli_query($connection,$select2);
    $u2=mysqli_num_rows($query2);

    if($u==0 AND $u2==0)
    {
        $insert="insert into user(username,email,password,date) values('$username','$email','$hash',NOW())";
        $query3=mysqli_query($connection,$insert);
        if($query3)
        {
            
            $_SESSION["user"]=$username;
            echo "<script> alert('Registered Succesfully')</script>";
            echo "<script> window.location.href='index.php'; </script>";

        }
    }
    else
    {
        echo "<script> alert('User Already Exits')</script>";
    }
}

?>