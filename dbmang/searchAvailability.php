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
		<h1>View Reservations Within Time Slot</h1>
		<h2>Use Military Time</h2>
	</center>
	<table>
		<tr>
			<th> Start Time </th>
			<th> End Time </th>
			<th> Day </th>
			<th> Submit </th>
		</tr>

		<form action="displayAllReservations.php" method="post">
			<tr>
				<td><input type = "text"  name = "start" id="start" value = "00:00" /></td>
				<td><input type = "text"  name = "end" id="end" value = "23:00" /></td>
				<td>
					<select name="day" id="day">
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
	</div>
	<div class="column right">
		<h2 style="padding-left: 200px;"><a href = "logout.php"> LogOut </a></h2><br><br>
		<img src="zippy.png" alt="Zippy" width="410" height="521">
	</div>
</section>
</body>
</html>