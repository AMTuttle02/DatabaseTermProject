<!DOCTYPE html>
<html>
<head>
      <title> Reserve A Room </title>
      <link rel="stylesheet" type="text/css" href="fancy.css">
</head>
<body>
<table>
	<tr>
		<th>
			<h1><a href="menu.php" style="color:silver;">Reserve A Room</a></h1>
		</th>
	</tr>
</table>
<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'dbmang';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password'])) {
	// Could not get the data that should have been sent.
	header('Location: about.html');
	exit;
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $password)) {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
		$_SESSION['id'] = $id;
		echo '
<div class="row">
	<div class="column left">
		<table id = "operations">
			<tr>
				<td id = "operations"> Operations: </td>
			</tr>
			<tr>
				<td id = "operations"><a href="searchAvailability.php"> Search Availability </a></td>
			</tr>
			<tr>
				<td id = "operations"><a href="viewReservation.php"> View Current Reservations </td>
			</tr>
			<tr>
				<td id = "operations"><a href="addReservation.php"> Reserve A Room</td>
			</tr>
			<tr>
				<td id = "operations"><a href="updateReservation.php"> Update A Reservation </td>
			</tr>
			<tr>
				<td id = "operations"><a href="deleteReservation.php"> Delete A Reservation </td>
			</tr>
			<tr style="border-bottom: 10px groove grey;">
				<td id = "operations"><a href="about.html"> About </td>
			</tr>
		</table>
	</div>
	<br><br>
	<div class="column middle">
		<center>
			<h1>Welcome To The Reserve A Room Website</h2>
		
			<h2>On the left, you will find a series of operations that can be performed to reserve a classroom on campus.</h2>
			<h2>The Search Availability option allows you to view what is currently reserved.</h2>
			<h2>The View Current Reservations option allows you to view your current reservations.</h2>
			<h2>The Reserve A Room option allows you to reserve a time that is not currently reserved.</h2>
			<h2>The Update a Reservation option allows you to update a current reservations.</h2>
			<h2>The Delete A Reservation option allows you to delete any current reservation you may have.</h2>
			<h2>To learn more about the website and the development team, please see our About page.</h2>
		</center>
	</div>
	<div class="column right">
		<h2 style="padding-left: 200px;"><a href = "logout.php"> LogOut </a></h2><br><br>
		<img src="zippy.png" alt="Zippy" width="410" height="521">
	</div>
</section>';
	} else {
		// Incorrect password
		echo '<center><h1>Incorrect password!</h1><h2>Click <a href="index.html">Here</a> To Try Again</h2></center>';
	}
} else {
	// Incorrect username
	echo '<center><h1>Incorrect username!</h1>
		<h2>Click <a href="index.html">Here</a> To Try Again</h2></center>';
}

	$stmt->close();
}
?>
		
	
</body>
</html>