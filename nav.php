<?php
session_start();
?>
<div class="nav-bar">
	<div class="vertical-center">
		<img class="nav-logo" src="./img/logo-small.png">
<?php
if (isset($_SESSION['logged_in'])) { ?>
	<div class="username center-text">
		<?php echo "Hello " . htmlentities($_SESSION['username']) . "!"; ?>
	</div>
<?php
}
?>
		<div class ="dropdown">
			<img src="./img/menu-icon1.png">
				  <div class="dropdown-content">
    					<a href="logout.php">Logout</a>
				  </div>
		</div>
		<img class="user-icon" src="./img/user-icon1.png">
	</div>
</div>
