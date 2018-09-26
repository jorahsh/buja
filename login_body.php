<?php
echo '<body>
	<div class="main-container">
	<div class="welcome-box">
		<div class="welcome-box-header">
			<span class="welcome-box-header-text">Welcome to Buja friend!</span>
		</div>
		<h3 class="welcom-box-title">Don\'t know what to watch?</h3>
		<p>Buja is the world\'s leading provider in Netflix
		recommendations, and we want to tell you what to watch!</p>
		<form method="post" action="login_handler.php">
			<div class="username-input">
				username: <input type="text" name="uname">
			</div>
			<div class="password-input">
				passowrd: <input type="text" name="password">
			</div>
			<div "submit-button">
				<input type="submit" value="submit">
			</div>
		</form>
		<p>-or-</p>
		<form method="get" action="create_account_handler.php">
			<input type="submit" value="create account">
		</form>
	</div>
	</div>
</body>';

