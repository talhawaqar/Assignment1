<?php
  session_start();
  if(!isset($_SESSION["loginuserid"]))
  {
      header("location:index.php");
  }
  
  $count = 0;
  $firstnameerror = "";
  $lastnameerror = "";
  $contacterror = "";
  $emailerror = "";
  
  if(isset($_POST['submit']))
  {
   
   if(isset($_POST['firstname']) &&  trim($_POST['firstname'])==="")
   {
    $firstnameerror = "ENTER FIRST NAME";
    $count++;
   }
   if(isset($_POST['lastname']) &&  trim($_POST['lastname'])==="")
   {
    $lastnameerror = "ENTER LAST NAME";
    $count++;
   }
   if(isset($_POST['contact']) &&  trim($_POST['contact'])==="")
   {
    $contacterror = "ENTER CONTACT NO";
    $count++;
   }
   if(isset($_POST['email']) &&  trim($_POST['email'])==="")
   {
    $emailerror = "ENTER EMAIL";
    $count++;
   }
   if($count === 0)
   {
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
       echo "Connected successfully";

       $fname = $_POST["firstname"];
       $lname = $_POST["lastname"];
       $email = $_POST["email"];
       $phone = $_POST["contact"];
       $userid = $_SESSION["loginuserid"];
       
       $query = "INSERT INTO Contacts (USERID,FIRSTNAME,LASTNAME,PHONE,EMAIL) VALUES('$userid','$fname','$lname','$phone','$email')";
       if(mysqli_query($conn, $query))
       {
          echo "<script>Successfully added</script>";
          header("location:home.php");       }
       else
       {
           echo $query;
       }        
       
   }
  }

?>

<html>
    <head>
       <title>Add Contact</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
    
    <link rel="stylesheet" type="text/css" href="addcontactstyle.css">
    <head>
    <body>
    <div class="container">
    
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Add Contact</h3>
			
			</div>
			<div class="card-body">
				<form method="post">
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"></span>
						</div>
						<input type="text" name="firstname" value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname'];}?>" class="form-control" placeholder="First Name">
                    </div>
                    <label style="color:red;"><?php echo $firstnameerror; ?></label>
                    <div class="input-group form-group">
						<div class="input-group-prepend"> 
							<span class="input-group-text"></span>
						</div>
						<input type="text" value="<?php if(isset($_POST['lastname'])){echo $_POST['lastname'];}?>" name="lastname" class="form-control" placeholder="Last Name">
                    </div>
                    <label style="color:red;"><?php echo $lastnameerror; ?></label>
					
                    <div class="input-group form-group">
						<div class="input-group-prepend"> 
							<span class="input-group-text"></span>
						</div>
						<input type="text" value="<?php if(isset($_POST['contact'])){echo $_POST['contact'];}?>" name="contact" class="form-control" placeholder="Contact">
                    </div>
                    <label style="color:red;"><?php echo $contacterror; ?></label>
					
                    <div class="input-group form-group">
						<div class="input-group-prepend"> 
							<span class="input-group-text"></span>
						</div>
						<input type="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" name="email" class="form-control" placeholder="Email">
                    </div>
                    <label style="color:red;"><?php echo $emailerror; ?></label>
					

					
					<div class="form-group">
						<input type="submit" name="submit" value="Add Contact" class="btn float-left login_btn">
                    </div>
				</form>
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