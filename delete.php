<?php
   session_start();
   if(!isset($_SESSION["loginuserid"]))
   {
       header("location:index.php");
   }
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "Assignment1";
   $conn = mysqli_connect($servername, $username, $password, $dbname);
                        
                       
   if (!$conn)
   {
    die("Connection failed: " . mysqli_connect_error());
   }
   $query = "DELETE FROM Contacts WHERE ID = '".$_GET["id"]."'";
   if(mysqli_query($conn, $query))
   {
    header("location:home.php");
   }

?>