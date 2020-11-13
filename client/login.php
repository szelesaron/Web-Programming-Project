<?php
$error_login=''; //Variable to Store error message;
if(isset($_POST['submit_login']))
	{
 		if(empty($_POST['user']) || empty($_POST['pass'])){
 		$error_login = "Username or Password is Invalid";
 	}
 else
 	{
	$conn = mysqli_connect("localhost", "root", "");

	// Check connection
	if (!$conn) 
	{
  		die("Connection failed: " . mysqli_connect_error());
	}

	 //get the data - escape sql injection
	 $user= $_POST["user"];
	 $pass= $_POST["pass"];


	 //Selecting Database
	 $db = mysqli_select_db($conn, "users_db");
	 //sql query to fetch information of registerd user and finds user match.

	 //getting the hashed password from the database
 	 $hashed_query = mysqli_query($conn, "SELECT * FROM users WHERE  userName='$user'");

 	 $result = mysqli_fetch_assoc($hashed_query);
 	 $pwd_hash = $result['password'];

	 $error_login =gettype($pwd_hash);
	 $error_login = $pwd_hash;
	 $error_login = gettype($pass);

	 if(password_verify($pass, $pwd_hash))
	 {
	 	$rows = mysqli_num_rows($hashed_query);
	 }

	 if($rows == 1)
	 	{
	 		header("Location: index.html"); // Redirecting to other page
	 	}
	 else
		 {
		 	$error_login = "Username or Password is Invalid";
		 }
	 mysqli_close($conn); // Closing connection
	}
}