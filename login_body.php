<?php

session_start();

?>

<body>
	<div class="main-container">
<?php

	if (isset($_SESSION['login_error']) {
		for ($_SESSION['login_error'] as $message) {
			echo "<p> $message </p>";
		}
	}
?>

	<div class="welcome-box">
		<div class="welcome-box-header">
			<span class="welcome-box-header-text">Welcome to Buja friend!</span>
		</div>
		<div class="welcome-box-title">
			<h3>Don\'t know what to watch?</h3>
			<p>
			Buja is the world\'s leading provider in Netflix
			recommendations, and we want to tell you what to watch!
			</p>
		</div>
		<form method="post" action="login_handler.php">
			<div class="username-input">
				username: <input type="text" name="username">
			</div>
			<div class="password-input">
				passowrd: <input type="text" name="password">
			</div>
			<div class="submit-button">
				<input type="submit" value="login">
			</div>
		</form>
		<div class="create-account">
			<p>-or-</p>
			<form method="get" action="create_account_handler.php">
				<input type="submit" value="create account">
			</form>
		</div>
	</div>
	</div>
</body>

