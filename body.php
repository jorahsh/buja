<?php
echo '<body>
	<div class="welcome-box">
		<div class="welcome-box-header">
			<span>Welcome to Buja friend!</span>
		<div>
		<h3>Don\'t know what to watch?</h3>
		<p>Buja is the world\'s leading provider in Netflix
		recommendations, and we want to tell you what to watch!</p>
		<form method="post" action="login_handler.php">
			username: <input type="text" name="uname"><br>
			passowrd: <input type="text" name="password"><br>
			<input type="submit" value="submit">
		</form>
		<form method="post" action="create_account_handler.php">
			<input type="submit" value="create account">
		</form>
	<div>
	</body>';

