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
			
			if ($reservedDate == "Monday")
			{
				$sql = "DELETE FROM userinput 
						WHERE userID = '$userID'
						AND startTime = '$startTime' 
						AND endTime = '$endTime'
						AND roomID = '$roomID'
						AND Monday = '1'";
			}
			else if ($reservedDate == "Tuesday")
			{
				$sql = "DELETE FROM userinput 
						WHERE userID = '$userID'
						AND startTime = '$startTime' 
						AND endTime = '$endTime'
						AND roomID = '$roomID'
						AND Tuesday = '1'";
			}
			else if ($reservedDate == "Wednesday")
			{
				$sql = "DELETE FROM userinput 
						WHERE userID = '$userID'
						AND startTime = '$startTime' 
						AND endTime = '$endTime'
						AND roomID = '$roomID'
						AND Wednesday = '1'";
			}
			else if ($reservedDate == "Thursday")
			{
				$sql = "DELETE FROM userinput 
						WHERE userID = '$userID'
						AND startTime = '$startTime' 
						AND endTime = '$endTime'
						AND roomID = '$roomID'
						AND Thursday = '1'";
			}
			else if ($reservedDate == "Friday")
			{
				$sql = "DELETE FROM userinput 
						WHERE userID = '$userID'
						AND startTime = '$startTime' 
						AND endTime = '$endTime'
						AND roomID = '$roomID'
						AND Friday = '1'";
			}
			else
			{
				echo "<h2> Reservation Does Not Exist, Please try again</h2>";
			}
			if($sql != ""){
			
				$result = mysqli_query($db,$sql);
				if (!$result) {
					echo "<center><h2>Error - Reservation Does Not Exist, Please try again</h2></center>";
				}
				else {
					echo "<center><h2>Reservation Deleted Successfully</h2>";
					echo "<h3>Your Reservations are listed below</h3>";
				}
			}
		{
			$sql = "SELECT *
					FROM userinput
					WHERE userID = '{$userID}'";
			$result = $db->query($sql);

			if ($result->num_rows > 0) {
				echo "<table>
					<tr>
						<th>User ID</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Room ID</th>
						<th>Reserved Dates</th>
					</tr>";
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$monday = $row["Monday"];
					$tuesday = $row["Tuesday"];
					$wednesday = $row["Wednesday"];
					$thursday = $row["Thursday"];
					$friday = $row["Friday"];
					echo "<tr>";
					echo	"<td>" . $row["userID"]. "</td>";
					echo	"<td>" . $row["startTime"]. "</td>";
					echo	"<td>" . $row["endTime"]. "</td>";
					echo	"<td>" . $row["roomID"]. "</td>";
					echo "<td>";
					if ($monday > 0) {
						echo "Monday" . "<br>";
					}
					if ($tuesday > 0)
					{
						echo "Tuesday<br>";
					}
					if ($wednesday > 0) {
						echo "Wednesday<br>";
					}
					if ($thursday > 0)
					{
						echo "Thursday<br>";
					}
					if ($friday > 0) {
						echo "Friday";
					}
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
		}
	?>
	</div>
	<div class="column right">
	<h2 style="padding-left: 200px;"><a href = "logout.php"> LogOut </a></h2><br><br>
		<img src="zippy.png" alt="Zippy" width="410" height="521">
	</div>
</section>
</body>
</html>