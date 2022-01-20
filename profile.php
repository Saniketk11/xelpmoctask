<?php 

 $user= $_SESSION["user"];
$select="select * from user where username='$user'";
$run=mysqli_query($connection,$select);
while($v=mysqli_fetch_array($run))
{
     $name=$v["email"];
     $id=$v["id"];
     $username=$v["username"];
     $password2=$v["password"];
     $profile=$v["profile"];
    
    if($profile=="")
    {
        $profile="profile.png";
    }

}
?>

<div class="card card-outline-secondary my-4">
				  <div class="card-header">Update Users</div>
				  <div class="card-body">
					<div id="purchaseDetailsMessage"></div>
					<form action="" method="post" enctype="multipart/form-data">
							 
							<div class="row">
								
                                  <div class="col-md-6">
                                    
								  <label>Full Name</label>
								     <input type="email" class="form-control" name="email"  value="<?php echo $name; ?>" >
                                    <br>
                                    </div>

                                  <div class="col-md-6">
								  <label>Username</label></label>
								  <input class="form-control invTooltip" type="text" value="<?php echo $username; ?>" name="uname">
                                  <br>
								
								    </div>
							  
								
							

							  
								<div class="col-md-6" style="display:inline-block">
								  <label>Password</label>
								  <input type="password" class="form-control" name="password"  placeholder="***********" >
                                  <br>
								 
								</div>
                                <div class="col-md-6" style="display:inline-block">
								  <label>Password</label>
								  <input type="password" class="form-control" name="cpassword"  placeholder="***********" >
                                  <br>
								 
								</div>

                                <div class="col-md-6" style="display:inline-block">
								  <label>Profile Image</label>
								  <input type="file" class="form-control" name="photo" >
                                  <br>
								 
								</div>
                                <div class="col-md-6" style="display:inline-block">
								  <img src="images/<?php echo $profile ?>" width="100px" height="100px">
                                <br>
								 
								</div>
                               

							 
							  </div>
							  <button type="submit" name="updateuser" id="addItem" class="btn btn-success">Update User</button>
							  <!-- <button type="button" id="updateItemDetailsButton" class="btn btn-primary">Update</button> -->
							  <!-- <button type="button" id="deleteItem" class="btn btn-danger">Delete</button> -->
							  <button type="reset" class="btn btn-danger" id="vehicalClear">Clear</button>
							</form>
				  </div> 
				</div>

 <?php 
if(isset($_POST["updateuser"]))
{
            $email=$_POST["email"];
			$uname=$_POST["uname"];
			$password=$_POST["password"];
			$cpassword=$_POST["cpassword"];

            $pro=$_FILES["photo"] ["name"];
																
            //this variable is used for folder image
            $tmp=$_FILES["photo"]["tmp_name"];
                                                                    
            //move your photo into your folder
            $s=move_uploaded_file($tmp,"images/$pro");
            if($pro=="")
            {
                $pro=$profile;
            }

            if($password!=$cpassword)
            {
				echo "<script> alert('Enter Same Password');</script>";
                exit;

            }
			 $f=md5($password);
			
            if($password=="")
            {
                $i2="update  user set email='$email',username='$uname',password='$password2',profile='$pro' where id='$id'";
                $r=mysqli_query($connection,$i2);
            }
            else
            {
                $i2="update  user set email='$email',username='$uname',password='$f',profile='$pro' where id='$id'";
                 $r=mysqli_query($connection,$i2);
            }
            $update="update history set user='$uname' where user='$user'";
            $up=mysqli_query($connection,$update);
            $_SESSION["user"]=$uname;

			if($r)
			{
				echo "<script> alert('User Updated');</script>";
			echo ("<script>location.href='index.php?goto=%27profile%27'</script>");
			}
}

?>