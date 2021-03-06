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
<div class="row">
	<div class="column left">
		<table id = "operations">
			<tr>
				<td id = "operations"> Operations: </td>
			</tr>
			<tr>
				<td id = "operations" onclick="location.href='searchAvailability.php'" style="cursor: pointer; text-decoration: underline;"> Search Availability </a></td>
			</tr>
			<tr>
				<td id = "operations" onclick="location.href='viewReservation.php'" style="cursor: pointer; text-decoration: underline;"> View Current Reservations </td>
			</tr>
			<tr>
				<td id = "operations" onclick="location.href='addReservation.php'" style="cursor: pointer; text-decoration: underline;"> Reserve A Room</td>
			</tr>
			<tr>
				<td id = "operations" onclick="location.href='updateReservation.php'" style="cursor: pointer; text-decoration: underline;"> Update A Reservation </td>
			</tr>
			<tr>
				<td id = "operations" onclick="location.href='deleteReservation.php'" style="cursor: pointer; text-decoration: underline;"> Delete A Reservation </td>
			</tr>
			<tr style="border-bottom: 10px groove grey;">
				<td id = "operations" onclick="location.href='about.html'" style="cursor: pointer; text-decoration: underline;"> About </td>
			</tr>
		</table>
	</div>
	<br><br>
	<div class="column middle">
<?php
	session_start();
	// If the user is not logged in redirect to the login page...
	if (!isset($_SESSION['loggedin'])) {
		header('Location: index.html');
		exit;
	}
	// Connect to MySQL
	$db = mysqli_connect("localhost:3306", "root", "","dbmang");

	if (!$db) {
			print "Error - Could not connect to MySQL";
			exit;
	}

	// Select the database
	$er = mysqli_select_db($db,"dbmang");
	if (!$er) {
		print "Error - Could not select the database";
		exit;
	}

	$userID = $_POST["userID"];
	$startTime = $_POST["startTime"];
	$endTime = $_POST["endTime"];
	$roomID = $_POST["roomID"];
	$reservedDate = $_POST["reservedDate"];

	if ($endTime <= $startTime)
	{
		echo "<center><h2>Error - Invalid Time Slots</h2></center>";
		exit;
	}

	if ($reservedDate == "monday") // Monday
	{
		$check = "SELECT * FROM courseinfo WHERE (startTime <= '{$startTime}' AND endTime >= '{$startTime}' AND Monday = 1 AND roomID = '{$roomID}')";
		$checkResult = mysqli_query($db,$check);
		if($checkResult->num_rows > 0)
		{
			echo "<center><h2>Error - There is a class at this time</h2></center>";
			exit;
		}
		else {
			$check = "SELECT * FROM userinput WHERE (startTime <= '{$startTime}' AND endTime >= '{$startTime}' AND Monday = 1 AND roomID = '{$roomID}')";
			$checkResult = mysqli_query($db,$check);
			if($checkResult->num_rows > 0)
			{
				echo "<center><h2>Error - There is a reservation at this time</h2></center>";
				exit;
			}
			else {
				$sql = "INSERT INTO userinput VALUES ('$userID', '$startTime', '$endTime', '$roomID', '1', '0', '0', '0', '0')";
			}
		}
	}
	else if ($reservedDate == "tuesday") // Tuesday
	{
		$check = "SELECT * FROM courseinfo WHERE (startTime <= '{$startTime}' AND endTime >= '{$startTime}' AND Tuesday = 1 AND roomID = '{$roomID}')";
		$checkResult = mysqli_query($db,$check);
		if($checkResult->num_rows > 0)
		{
			echo "<center><h2>Error - There is a class at this time</h2></center>";
			exit;
		}
		else {
			$check = "SELECT * FROM userinput WHERE (startTime <= '{$startTime}' AND endTime >= '{$startTime}' AND Tuesday = 1 AND roomID = '{$roomID}')";
			$checkResult = mysqli_query($db,$check);
			if($checkResult->num_rows > 0)
			{
				echo "<center><h2>Error - There is a reservation at this time</h2></center>";
				exit;
			}
			else {
				$sql = "INSERT INTO userinput VALUES ('$userID', '$startTime', '$endTime', '$roomID', '0', '1', '0', '0', '0')";
			}
		}
	}
	else if ($reservedDate == "wednesday") // Wednesday
	{
		$check = "SELECT * FROM courseinfo WHERE (startTime <= '{$startTime}' AND endTime >= '{$startTime}' AND Wednesday = 1 AND roomID = '{$roomID}')";
		$checkResult = mysqli_query($db,$check);
		if($checkResult->num_rows > 0)
		{
			echo "<center><h2>Error - There is a class at this time</h2></center>";
			exit;
		}
		else {
			$check = "SELECT * FROM userinput WHERE (startTime <= '{$startTime}' AND endTime >= '{$startTime}' AND Wednesday = 1 AND roomID = '{$roomID}')";
			$checkResult = mysqli_query($db,$check);
			if($checkResult->num_rows > 0)
			{
				echo "<center><h2>Error - There is a reservation at this time</h2></center>";
				exit;
			}
			else {
				$sql = "INSERT INTO userinput VALUES ('$userID', '$startTime', '$endTime', '$roomID', '0', '0', '1', '0', '0')";
			}
		}
	}
	else if ($reservedDate == "thursday") // Thursday
	{
		$check = "SELECT * FROM courseinfo WHERE (startTime <= '{$startTime}' AND endTime >= '{$startTime}' AND Thursday = 1 AND roomID = '{$roomID}')";
		$checkResult = mysqli_query($db,$check);
		if($checkResult->num_rows > 0)
		{
			echo "<center><h2>Error - There is a class at this time</h2></center>";
			exit;
		}
		else {
			$check = "SELECT * FROM userinput WHERE (startTime <= '{$startTime}' AND endTime >= '{$startTime}' AND Thursday = 1 AND roomID = '{$roomID}')";
			$checkResult = mysqli_query($db,$check);
			if($checkResult->num_rows > 0)
			{
				echo "<center><h2>Error - There is a reservation at this time</h2></center>";
				exit;
			}
			else {
				$sql = "INSERT INTO userinput VALUES ('$userID', '$startTime', '$endTime', '$roomID', '0', '0', '0', '1', '0')";
			}
		}
	}
	else if ($reservedDate == "friday") // Friday
	{
		$check = "SELECT * FROM courseinfo WHERE (startTime <= '{$startTime}' AND endTime >= '{$startTime}' AND Friday = 1 AND roomID = '{$roomID}')";
		$checkResult = mysqli_query($db,$check);
		if($checkResult->num_rows > 0)
		{
			echo "<center><h2>Error - There is a class at this time</h2></center>";
			exit;
		}
		else {
			$check = "SELECT * FROM userinput WHERE (startTime <= '{$startTime}' AND endTime >= '{$startTime}' AND Friday = 1 AND roomID = '{$roomID}')";
			$checkResult = mysqli_query($db,$check);
			if($checkResult->num_rows > 0)
			{
				echo "<center><h2>Error - There is a reservation at this time</h2></center>";
				exit;
			}
			else {
				$sql = "INSERT INTO userinput VALUES ('$userID', '$startTime', '$endTime', '$roomID', '0', '0', '0', '0', '1')";
			}
		}
	}
	else // Invalid
	{
		echo "<h2> Invalid Day Input, Please try again</h2>";
	}

	if($sql != ""){
			
		$result = mysqli_query($db,$sql);
		if (!$result) {
			echo "<center><h2>Error - That Time Slot Is Already Reserved</h2></center>";
		}
		else {
			echo "<center><h2>Reservation Inserted Successfully</h2>";
			echo "<table>
					<tr>
					<th>User ID</th>
					<th>Start Time</th>
					<th>End Time</th>
					<th>Room ID</th>
					<th>Reserved Date</th>
					</tr>";
			echo  "<tr>";
			echo  "<td>" . $userID. "</td>";
			echo  "<td>" . $startTime. "</td>";
			echo  "<td>" . $endTime. "</td>";
			echo  "<td>" . $roomID. "</td>";
			echo  "<td>" . $reservedDate. "</td>";
			echo  "</tr>";
			echo  "</table>";
		}
	}
?>
	</div>
	<div class="column right">
	<h2 style="padding-left: 200px;"><a href = "logout.php"> LogOut </a></h2><br><br>
		<img src="jak.jpeg" alt="Zippy" width="410" height="521">
	</div>
</section>
</body>
</html>