<?php
    session_start();
?>

<?php
$count = 0;
$loginerror ="";
$usernameerror = "";
$passworderror = "";
if(isset($_POST['password']) &&  trim($_POST['password'])==="")
{
    $passworderror = "ENTER PASSWORD";
    $count++;
}
if(isset($_POST['username']) &&  trim($_POST['username'])==="")
{
    $usernameerror = "ENTER USERNAME";
    $count++;
} 
if(isset($_POST['password']) && isset($_POST['username']) && $count == 0){
	echo "<script>alert('hello')</script>";
	
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Assignment1";
        
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
        
    // Check connection
    if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
		echo "failed";
    }
	echo "Connected successfully";
	
	$uname = $_POST['username'];
	$pass = $_POST['password'];
	$query = "SELECT * FROM Login WHERE USERNAME ='$uname' AND PASSWORD ='$pass' limit 1";
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 0)
	{
		$row =  mysqli_fetch_array($result);
		$_SESSION["loginuserid"] = $row["ID"];

		$query = "SELECT * FROM Users WHERE userID = '".$row['ID']."'";  
		$result = mysqli_query($conn, $query);
		$row =  mysqli_fetch_array($result);
        $_SESSION["loginusername"] = $row["FIRSTNAME"]." ".$row["LASTNAME"];
		
	    header("location:home.php");
	}
	else
	{
		$loginerror ="Invalid Username and Password";
	} 


}


?>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
    
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
    
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
			
			</div>
			<div class="card-body">
				<form method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="username" class="form-control" placeholder="username">
                    </div>
                    <label style="color:red;"><?php echo $usernameerror; ?></label>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name ="password" class="form-control" placeholder="password">
					</div>
					<label style="color:red;"><?php echo $passworderror; ?></label>
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
                    </div>
                    <label style="color:red;"><?php echo $loginerror; ?></label>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="signup.php">Sign Up</a>
				</div>
				
			</div>
		</div>
    </div>
</div>
</body>
</html>