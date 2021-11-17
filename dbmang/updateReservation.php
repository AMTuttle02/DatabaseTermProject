<!DOCTYPE html>
<html>
<head>
      <title> Reserve A Room </title>
      <link rel="stylesheet" type="text/css" href="fancy.css">
</head>
<body>
<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
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
		<h1>Update A Reservation</h1>
		<h2>Please Follow The Format. Use Military Time</h2>
		<h3>Input the updated time slot and/or day. Use the same ID numbers as your current reservation</h3>
	</center>
	<table>
		<tr>
			<th> Student ID </th>
			<th> Start Time </th>
			<th> End Time </th>
			<th> RoomID </th>
			<th> Reserved Date </th>
			<th> Submit </th>
		</tr>

		<form action="update.php" method="post">
			<tr>
				<td><input type = "number"  name = "userID" id="userID" size = "7" value = "1234567" min="0" max="9999999" /></td>
				<td><input type = "text"  name = "startTime" id="startTime" size = "5" value = "00:00" /></td>
				<td><input type = "text"  name = "endTime" id="endTime" size = "5" value = "01:00" /></td>
				<td><input type = "text"  name = "roomID" id="roomID" size = "6" value = "CAS134" /></td>				
				<td><input type = "text"  name = "reservedDate" id="reservedDate" size = "9" value = "Monday" /></td>
				<td><input type = "submit" value="Submit"></td>
			</tr>
		</form>	
	</table>
	</div>
	<div class="column right">
	<h2 style="padding-left: 200px;"><a href = "logout.php"> LogOut </a></h2><br><br>
		<img src="zippy.png" alt="Zippy" width="410" height="521">
	</div>
</section>
</body>
</html>