<?php
session_start();
?>
<?php
  if(!isset($_SESSION["loginuserid"]))
  {
      header("location:index.php");
  }

?>


<html>
    <head>
       <title>Home</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
    
    <link rel="stylesheet" type="text/css" href="homestyle.css">
    <head>
    <body>
    <div class="container">
    <h2 style="color:teal;"> <span class="label label-default"><?php echo 'HI '.$_SESSION["loginusername"].'!';?></span></h2>
    <table class = "table table-stripped">
       <tr>
          <td>
            <a href="addcontact.php" class="btn btn-primary">Add Contact</a>
          <td>
          <td>
            <a href="logout.php" class="btn btn-danger">Logout</a>
          <td>
       <tr>
    </table>
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Contacts</h3>			
			</div>
			<div class="card-body">
               
               <table class="table table-stripped">
                  <thead>
                      <tr>
                          <th scope="col">Sr.</th>
                          <th scope="col">First Name</th>
                          <th scope="col">Last Name</th>
                          <th scope="col">Contact</th>
                          <th scope="col">Email</th>
                          <th scope="col">Edit</th>
                          <th scope="col">Delete</th>
                      </tr>
                  </thead>
                  <tbody>
                     <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "Assignment1";
                        
                        // Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                        
                        // Check connection
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        $query = "SELECT * FROM Contacts WHERE USERID = '".$_SESSION["loginuserid"]."'";
                        $result = mysqli_query($conn, $query);        
                        if(mysqli_num_rows($result) > 0)
                        {
                            $i=1;
                            while($row = $result->fetch_assoc())
                            {
                            ?>
                              <tr>
                                 <td><?php echo $i;?></td>
                                 <td>
                                   <?php echo $row["FIRSTNAME"];?>
                                 </td>
                                 <td>
                                   <?php echo $row["LASTNAME"];?>
                                 </td>
                                 <td>
                                   <?php echo $row["PHONE"];?>
                                 </td>
                                 <td>
                                   <?php echo $row["EMAIL"];?>
                                 </td>
                                 <td>
                                     <a href="editcontact.php?id=<?php echo$row["ID"];?>">
                                       <i class="fas fa-edit"></i>
                                     </a>
                                </td>
                                <td>
                                    <a href="delete.php?id=<?php echo$row["ID"];?>">
                                       <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                              </tr>
                            <?php
                                $i++;
                            }
                        }
                        else
                        {
                                
                        }
                     ?>
                  </tbody>
               </table>    
                
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
				</div>
				
			</div>
		</div>
    </div>
</div>
    </body>
</html>