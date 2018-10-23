<?php
session_start();
session_destroy();
header('Location: https://stark-beyond-19703.herokuapp.com');
exit;
