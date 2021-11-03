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
			<h1><a href="menu.html" style="color:silver;">Reserve A Room</a></h1>
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
				<td id = "operations" onclick="location.href='searchAvailability.html'" style="cursor: pointer; text-decoration: underline;"> Search Availability </a></td>
			</tr>
			<tr>
				<td id = "operations" onclick="location.href='viewReservation.html'" style="cursor: pointer; text-decoration: underline;"> View Current Reservations </td>
			</tr>
			<tr>
				<td id = "operations" onclick="location.href='addReservation.html'" style="cursor: pointer; text-decoration: underline;"> Reserve A Room</td>
			</tr>
			<tr>
				<td id = "operations" onclick="location.href='updateReservation.html'" style="cursor: pointer; text-decoration: underline;"> Update A Reservation </td>
			</tr>
			<tr>
				<td id = "operations" onclick="location.href='deleteReservation.html'" style="cursor: pointer; text-decoration: underline;"> Delete A Reservation </td>
			</tr>
			<tr style="border-bottom: 10px groove grey;">
				<td id = "operations" onclick="location.href='about.html'" style="cursor: pointer; text-decoration: underline;"> About </td>
			</tr>
		</table>
	</div>
	<br><br>
	<div class="column middle">
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

			$userID = $_POST["userID"];
			$startTime = $_POST["startTime"];
			$endTime = $_POST["endTime"];
			$roomID = $_POST["roomID"];
			$reservedDate = $_POST["reservedDate"];
			if ($reservedDate == "Monday")
			{
				$sql = "UPDATE userinput 
						set startTime = '$startTime', endTime = '$endTime', Monday = '1', Tuesday = '0', Wednesday = '0', Thursday = '0', Friday = '0')
						where userID = '$userID' AND roomID = '$roomID'";
			}
			else if ($reservedDate == "Tuesday")
			{
				$sql = "UPDATE userinput 
						set startTime = '$startTime', endTime = '$endTime', Monday = '0', Tuesday = '1', Wednesday = '0', Thursday = '0', Friday = '0')
						where userID = '$userID' AND roomID = '$roomID'";
			}
			else if ($reservedDate == "Wednesday")
			{
				$sql = "UPDATE userinput 
						set startTime = '$startTime', endTime = '$endTime', Monday = '0', Tuesday = '0', Wednesday = '1', Thursday = '0', Friday = '0')
						where userID = '$userID' AND roomID = '$roomID'";
			}
			else if ($reservedDate == "Thursday")
			{
				$sql = "UPDATE userinput 
						set startTime = '$startTime', endTime = '$endTime', Monday = '0', Tuesday = '0', Wednesday = '0', Thursday = '1', Friday = '0')
						where userID = '$userID' AND roomID = '$roomID'";
			}
			else if ($reservedDate == "Friday")
			{
				$sql = "UPDATE userinput 
						set startTime = '$startTime', endTime = '$endTime', Monday = '0', Tuesday = '0', Wednesday = '0', Thursday = '0', Friday = '1')
						where userID = '$userID' AND roomID = '$roomID'";
			}
			else
			{
				echo "<h2> Invalid User or Room ID, Please try again</h2>";
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
		<img src="zippy.png" alt="Zippy" width="410" height="521">
	</div>
</section>
</body>
</html>