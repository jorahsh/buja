<?php
session_start();
?>

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
			<span class="welcome-box-header-text">Welcome to Buja friend!</span>
		</div>
		<div class="welcome-box-title">
			<h3>Don't know what to watch?</h3>
			<p>
			Buja is the world's leading provider in Netflix
			recommendations, and we want to tell you what to watch!
			</p>
		</div>
		<form method="post" action="login_handler.php">
			<div class="absolute-left input-first">
				<label for="username">username:</label>
				<input type="text" name="username"
				<?php if(isset($_SESSION['username'])) { echo 'value="' . $_SESSION['username'] . '"'; }?>
			>
			</div>
			<div class="absolute-left input-second">
				<label for="password">passowrd:</label>
				<input type="password" name="password">
			</div>
			<div class="absolute-left input-third">
				<input type="submit" value="login">
			</div>
		</form>
		<div class="absolute-left login-or-create">
			<p>-or-</p>
			<form method="get" action="create_account.php">
				<input type="submit" value="create account">
			</form>
		</div>
	</div>
	</div>
</body>

