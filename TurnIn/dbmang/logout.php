<?php
session_start();
session_destroy();
// Redirect to the login page:
echo '<h1>Log Out Succesful</h1>
	<h1> Click <a href="index.html">Here</a> To Return to Login Screen</h1>'
?>