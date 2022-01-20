<?php 
include("database.php");
session_start();
// Redirect the user to login page if he is not logged in.
if(!isset($_SESSION['user'])){
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Main Page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
			
		<style type="text/css">
						#nav{
							background-image: linear-gradient(to bottom, #c96f48, #d65f4d, #e24b59, #e9336c, #eb1284);
							padding: 10px;
							color: white;
						}
						.navbar-light .navbar-nav .nav-link {
						color: white;
					}
					#c:hover{
						background-color: wheat;
					}
					#c{
						border: 1px solid black;
						margin-top: 5px;
					}
					
		</style>
</head>
<body>
<nav id="nav" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="">Mean |  Median | Mode</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto offset-md-7 float-right">
			<!-- <li class="nav-item">
				<form class="form-inline" action="/action_page.php">
					<input class="form-control col-md-8 mr-sm-2" type="text" placeholder="Search">
					<button class="btn btn-success" type="submit">Search</button>
				</form>
			</li> -->
		<li>
			<?php 
				 $user= $_SESSION['user'];

				 $s="select * from user where username='$user'";
				 $r=mysqli_query($connection,$s);
				 while($a=mysqli_fetch_array($r))
				 {
				   $profile=$a["profile"];
				   if($profile=="")
				   {
					   $profile="profile.png";
				   }
				 }
			?>
			<img class="rounded-circle" src="images/<?php echo $profile ?>" width="50px" height="50px">
      </li>
			<li class="nav-item">
				<span class="nav-link">Welcome  <?php echo $_SESSION["user"] ;?></span>
            </li>
			<li class="nav-item">
				<span class="nav-link"> | </span>
            </li>
			<li class="nav-item">
				<a class="nav-link" href="logout.php">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<br><br><br><br>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
			<ul class="nav flex-column">
  <li class="nav-item">
    <a id="c" class="nav-link active" aria-current="page" href="index.php?goto='calculate'">Calculate</a>
  </li>
  <li class="nav-item">
    <a id="c" class="nav-link" href="index.php?goto='history'">History</a>
  </li>
  <li class="nav-item">
    <a id="c" class="nav-link" href="index.php?goto='profile'">Profile</a>
  </li>
  <li class="nav-item">
    <a id="c"  class="nav-link" href="logout.php">Logout</a>
  </li>
  
</ul>
			</div>
			<div class="col-md-10">
				<?php 
					@$d=$_GET["goto"];
					if($d=="'calculate'")
					{
						include("calc.php");
					}
					elseif($d=="'history'")
					{
						include("history.php");
					}
					elseif($d=="'profile'")
					{
						include("profile.php");
					}
					else
					{
						include("calc.php");
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>