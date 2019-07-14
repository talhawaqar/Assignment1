
<?php
   $count = 0;
   $firstnameerror = "";
   $lastnameerror = "";
   $usernameerror = "";
   $passworderror = "";
   $confirmpassworderror = "";
   $signuperror = "";

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
    if(isset($_POST['username']) &&  trim($_POST['username'])==="")
    {
     $usernameerror = "ENTER USERNAME";
     $count++;
    }
    if(isset($_POST['password']) &&  trim($_POST['password'])==="")
    {
     $passworderror = "ENTER PASSWORD";
     $count++;
    }
    if(isset($_POST['confirmpassword']) &&  trim($_POST['confirmpassword'])==="")
    {
     $confirmpassworderror = "ENTER CONFIRM PASSWORD";
     $count++;
    }

    if(trim($_POST['password'])!=="" && trim($_POST['confirmpassword'])!=="")
    {
        if($_POST['password'] !== $_POST['confirmpassword'])
        {
            $confirmpassworderror = "PASSWORD DOESNOT MATCH";
            $count++;
        }
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
        $query = "SELECT * FROM Login WHERE USERNAME = '".$_POST["username"]."'";
        $result = mysqli_query($conn, $query);        
        if(mysqli_num_rows($result) > 0)
        {
            $usernameerror = "USERNAME ALREADY EXISTS";
        }
        else
        {
            $query = "INSERT INTO Login (USERNAME,PASSWORD) VALUES('".$_POST['username']."','".$_POST['password']."')";
            if(mysqli_query($conn, $query))
            {
                $last_id = mysqli_insert_id($conn);
                
                $query = "INSERT INTO Users (userID,FIRSTNAME,LASTNAME) VALUES('".$last_id."','".$_POST['firstname']."','".$_POST['lastname']."')";
                if(mysqli_query($conn, $query))
                {
                    echo "<script>alert('success')</script>";
                    header("location:index.php");
                } 
               
            }
            
        }
    }
   }
   
?>


<html>
    <head>
       <title>Sign Up</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
    
    <link rel="stylesheet" type="text/css" href="signupstyle.css">
    <head>
    <body>
    <div class="container">
    
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign Up</h3>
			
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
						<input type="text" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>" name="username" class="form-control" placeholder="username">
                    </div>
                    <label style="color:red;"><?php echo $usernameerror; ?></label>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"></span>
						</div>
						<input type="password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];}?>" name ="password" class="form-control" placeholder="password">
					</div>
                    <label style="color:red;"><?php echo $passworderror; ?></label>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"></span>
						</div>
						<input type="password" value="<?php if(isset($_POST['confirmpassword'])){echo $_POST['confirmpassword'];}?>" name ="confirmpassword" class="form-control" placeholder="confirm password">
					</div>
					<label style="color:red;"><?php echo $confirmpassworderror; ?></label>
					<div class="form-group">
						<input type="submit" name="submit" value="Sign Up" class="btn float-right login_btn">
                    </div>
                    <label style="color:red;"><?php echo $signuperror; ?></label>
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