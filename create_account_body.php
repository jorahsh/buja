<?php
session_start();
?>
<body>
	<div class="main-container">
<?php
if (isset($_SESSION['create_error'])) { ?>
<?php	foreach($_SESSION['create_error'] as $message) { ?>
		<div class="create_error"><?php echo $message; ?></div>
<?php	}
unset($_SESSION['create_error']);
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
			We just need a few basic facts, then you'll be free 
			to use buja to your heart's content.
			</p>
		</div>
		<form method="post" action="create_account_handler.php">
			<div class="absolute-left input-first">
				<label for="create_username">username:</label> 
				<input type="text" name="create_username"
			<?php if(isset($_SESSION['create_username'])){echo 'value="' . $_SESSION['create_username'] . '"';}?>
			>
			</div>
			<div class="absolute-left input-second">
				<label for="create_email">email:</label>
				<input class="email-field" type="text" name="create_email"
			<?php if(isset($_SESSION['create_email'])){echo 'value="' . $_SESSION['create_email'] . '"';}?>
			>
			</div>
			<div class="absolute-left input-third">
				<label for="create_password">passowrd:</label>
				<input type="password" name="create_password">
			</div>
			<div class="absolute-left create-submit">
				<input type="submit" value="submit">
			</div>
		</form>
	</div>
	</div>
</body>
