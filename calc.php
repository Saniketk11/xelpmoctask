<?php
include("database.php");

?>
<script>
	function check()
	{
		var a=document.getElementById("data").value;
		if(a<0)
		{
		document.getElementById("error").innerHTML="Entered Value Is Negative ";

		}
		// document.getElementById("error").innerHTML=a;
		
	}
	</script>

<body>
		<div class="row">
			<div class="col-md-8 offset-md-2" >
				<div class="card" >
					
					<div class="card-body">
						<h5 style="text-align:center;" class="card-title">Calculate Mean Median Mode</h5>
						<hr>
						<form action="" method="post">
							<label>Enter Values For Calculate Mean,Median,Mode</label> <br><br>
							<input oninput="check()" id="data" type="text" name="data" class="form-control" required><br>
							<div id="error"></div>
							<br>
							<button type="submit" class="btn btn-success" name="submit">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<br>


<?php
if(isset($_POST["submit"]))
{

	$data = $_POST['data'];
	$t=0;
	
 	$data_arr = explode(',', $data);


	 $count= count($data_arr);
			for($i=0;$i<$count;$i++)
			{
				if($data_arr[$i]<0)
				{
					echo "<script> alert('The Array Contain Negative Value'); </script>";
					exit;
				}
				if(!is_numeric($data_arr[$i]))
				{
					echo "<script> alert('The Array Contain String Value'); </script>";
					exit;
				}
				
			
				$t=$t+$data_arr[$i];
			}
			$mean=$t/$count;
			// echo"mean is".$mean; 

		$mid=0;
			if($count%2 == 0)
			{
			  $temp=round(($count/2)-1)*1000/1000;
			//   alert($temp);
			  for($i=0;$i<$count;$i++)
				{
					if($temp==$i || ($temp+1)==$i)
					{
						$mid=$mid+$data_arr[$i];
					}
				}
				$mid=$mid/2;
				// echo "Median value is:".$mid;
			}
			
			else 
			{
				$temp=floor($count/2);
					for($i=1;$i<=$count;$i++)
					{
						if($temp==$i)
						{
							$mid=$data_arr[$i];
							// echo "Median value: ".$mid;
						}
				}
			}


			$multiDArr = [];
			for ($i = 0; $i < count($data_arr); $i++) {
				$key = $data_arr[$i];
			
				if (isset($multiDArr[$key])) {
					$multiDArr[$key] = $multiDArr[$key] + 1;
				} else {
					$multiDArr[$key] = 1;
				}
			}
			
			$highestOccuring = 0;
			$highestOccuringKey = null;
			foreach ($multiDArr as $key => $value) {
			
				if ($value > $highestOccuring) {
					$highestOccuring = $value;
					$highestOccuringKey = $key;
				}
			
			}
			
			// echo "MODE : " . $highestOccuringKey;
}
		
?>

<?php 
if(isset($_POST["submit"]))
{
	$user=$_SESSION["user"];
	$in="insert into history(numbers,mean,median,mode,user,date) values('$data','$mean','$mid','$highestOccuringKey','$user',NOW())";
	$qu=mysqli_query($connection,$in);

	echo "
		<div class='row'>
			<div class='col-md-8 offset-md-2'>
			
					<div class='card' >	
						<div class='card-body'>
							 The Given Number Is : $data
						</div>
					</div>
			
			</div>
		</div>
		
		<div class='row'>
		<div class='col-md-8 offset-md-2'>
		
				<div class='card' >	
					<div class='card-body'>
						 Mean Is : $mean <br>
						 Median Is : $mid  <br>

						 Mode Is : $highestOccuringKey 

					</div>
				</div>
		
		</div>
	</div>
		";
}
?>
<div class="row">
    <div class="col-md-12">

   <h2 style="text-align: center;">History </h2> <br>
    <table class="table table-striped">
        <tr>
            <th>The Inputed Numbers</th>
            <th>Mean</th>
            <th>Median</th>
            <th>Mode</th>
            <th>Delete</th>

        </tr>
        <?php 
            $user=$_SESSION["user"];
            $s="select * from history where user='$user' ORDER BY id DESC LIMIT 5 ";
            $r=mysqli_query($connection,$s);
            while($data=mysqli_fetch_array($r))
            {
                $id=$data["id"];
                $numbers=$data["numbers"];
                $mean=$data["mean"];
                $median=$data["median"];
                $mode=$data["mode"];
                $date=$data["date"];



                echo "
                    <tr>
                        <td> $numbers</td>
                        <td> $mean</td>
                        <td> $median</td>
                        <td> $mode</td>
                        <td> <a style='color:red' href='delete.php?id=$id'> Delete </a></td>


                    </tr>
                ";
            }
        ?>
    </table>
</div>
</div>
</body>
</html>