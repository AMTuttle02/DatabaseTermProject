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
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
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
		<h1>Update A Reservation</h1>
		<h2>Please Follow The Format. Use Military Time</h2>
		<h3>Input the current reservation details in the first row</h3>
		<h3>Input the new reservation details in the second row</h3>
		<h3>If something does not change, input the current detail</h3>
	</center>
	<table>
		<tr>
			<th> Student ID </th>
			<th> Start Time </th>
			<th> End Time </th>
			<th> RoomID </th>
			<th> Reserved Date </th>
		</tr>

		<form action="update.php" method="post">
			<tr>
				<td><input type = "number"  name = "userID" id="userID" size = "7" value = "<?php echo ($_SESSION['name']); ?>" min="<?php echo ($_SESSION['name']); ?>" max="<?php echo ($_SESSION['name']); ?>" /></td>
				<td><input type = "text"  name = "startTime" id="startTime" size = "5" value = "00:00" /></td>
				<td><input type = "text"  name = "endTime" id="endTime" size = "5" value = "01:00" /></td>
				<td><input type = "text"  name = "roomID" id="roomID" size = "6" value = "CAS134" /></td>				
				<td>
					<select name="day" id="day">
						<option value="monday">Monday</option>
						<option value="tuesday">Tuesday</option>
						<option value="wednesday">Wednesday</option>
						<option value="thursday">Thursday</option>
						<option value="friday">Friday</option>
					</select>
				</td>
			</tr>
			<tr>
				<th> New Start Time </th>
				<th> New End Time </th>
				<th> New RoomID </th>
				<th> New Reserved Date </th>
				<th> Submit </th>
			</tr>
			<tr>
				<td><input type = "text"  name = "newStartTime" id="newStartTime" size = "5" value = "00:00" /></td>
				<td><input type = "text"  name = "newEndTime" id="newEndTime" size = "5" value = "01:00" /></td>
				<td><input type = "text"  name = "newRoomID" id="newRoomID" size = "6" value = "CAS134" /></td>			
				<td>
					<select name="newDay" id="newDay">
						<option value="monday">Monday</option>
						<option value="tuesday">Tuesday</option>
						<option value="wednesday">Wednesday</option>
						<option value="thursday">Thursday</option>
						<option value="friday">Friday</option>
					</select>
				</td>
				<td><input type = "submit" value="Submit"></td>
			</tr>
		</form>	
	</table>
	<?php
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

		echo "<center><h1> Current Reservations</h1></center>";
		{
			$sql = "SELECT *
					FROM userinput
					WHERE userID = '{$_SESSION['name']}'";
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
			} else {
			echo "<center><h2>You have no current reservations</h2></center>";
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