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
		<center>
			<h1>Reserved Times And Dates</h1>
		</center>
		<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
		$start = $_POST["start"];
		$end = $_POST["end"];
		$day = $_POST["day"];
		
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
		{
			if ($day == 'monday') {
				$sql = "SELECT *
						FROM courseInfo
						WHERE startTime >= '{$start}' AND endTime <= '{$end}' AND Monday = 1";
				$result = $db->query($sql);
			}
			else if ($day == 'tuesday') {
				$sql = "SELECT *
						FROM courseInfo
						WHERE startTime >= '{$start}' AND endTime <= '{$end}' AND Tuesday = 1";
				$result = $db->query($sql);
			}
			else if ($day == 'wednesday') {
				$sql = "SELECT *
						FROM courseInfo
						WHERE startTime >= '{$start}' AND endTime <= '{$end}' AND Wednesday = 1";
				$result = $db->query($sql);
			}
			else if ($day == 'thursday') {
				$sql = "SELECT *
						FROM courseInfo
						WHERE startTime >= '{$start}' AND endTime <= '{$end}' AND Thursday = 1";
				$result = $db->query($sql);
			}
			else if ($day == 'friday') {
				$sql = "SELECT *
						FROM courseInfo
						WHERE startTime >= '{$start}' AND endTime <= '{$end}' AND Friday = 1";
				$result = $db->query($sql);
			}
			else {
				$sql = "SELECT *
						FROM courseInfo
						WHERE startTime >= '{$start}' AND endTime <= '{$end}'";
				$result = $db->query($sql);
			}

			echo "<table>
					<tr>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Room ID</th>
						<th>Reserved Dates</th>
					</tr>";
			if ($result->num_rows > 0) {
			
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$monday = $row["Monday"];
				$tuesday = $row["Tuesday"];
				$wednesday = $row["Wednesday"];
				$thursday = $row["Thursday"];
				$friday = $row["Friday"];
				echo "<tr>";
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
			}
		}
		{
			if ($day == 'monday') {
				$sql = "SELECT *
						FROM userinput
						WHERE startTime >= '{$start}' AND endTime <= '{$end}' AND Monday = 1";
				$result = $db->query($sql);
			}
			else if ($day == 'tuesday') {
				$sql = "SELECT *
						FROM userinput
						WHERE startTime >= '{$start}' AND endTime <= '{$end}' AND Tuesday = 1";
				$result = $db->query($sql);
			}
			else if ($day == 'wednesday') {
				$sql = "SELECT *
						FROM userinput
						WHERE startTime >= '{$start}' AND endTime <= '{$end}' AND Wednesday = 1";
				$result = $db->query($sql);
			}
			else if ($day == 'thursday') {
				$sql = "SELECT *
						FROM userinput
						WHERE startTime >= '{$start}' AND endTime <= '{$end}' AND Thursday = 1";
				$result = $db->query($sql);
			}
			else if ($day == 'friday') {
				$sql = "SELECT *
						FROM userinput
						WHERE startTime >= '{$start}' AND endTime <= '{$end}' AND Friday = 1";
				$result = $db->query($sql);
			}
			else {
				$sql = "SELECT *
						FROM userinput
						WHERE startTime >= '{$start}' AND endTime <= '{$end}'";
				$result = $db->query($sql);
			}

			if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$monday = $row["Monday"];
				$tuesday = $row["Tuesday"];
				$wednesday = $row["Wednesday"];
				$thursday = $row["Thursday"];
				$friday = $row["Friday"];
				echo "<tr>";
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
			
			}
			echo "</table><br>";
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