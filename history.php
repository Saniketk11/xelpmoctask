<div class="row">
    <div class="col-md-10 offset-md-1">

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
            $s="select * from history where user='$user' ORDER BY id DESC";
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