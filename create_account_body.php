<body>
	<div class="main-container">
<?php

if (isset($_SESSION['login_error'])) { ?>
<?php	foreach($_SESSION['login_error'] as $message) { ?>
		<div class="login_error"><?php echo $message; ?></div>
<?php	}
unset($_SESSION['login_error']);
} ?>
	<div class="welcome-box">
		<div class="welcome-box-header">
			<span class="welcome-box-header-text">
				One of us...One of us...
			</span>
		</div>
		<div class="welcome-box-title">
			<h3>Signup is both easy AND painless!</h3>
			<p>
			We just need a few basic facts, then you\'ll be free 
			to use buja to your heart\'s content.
			</p>
		</div>
		<form method="post" action="login_handler.php">
			<div class="username-input">
				username: <input type="text" name="create_username">
			</div>
			<div class="password-input">
				passowrd: <input type="password" name="create_password">
			</div>
			<div class="submit-button">
				<input type="submit" value="submit">
			</div>
		</form>
	</div>
	</div>
</body>
