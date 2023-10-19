<?php
require('../../db.conn.php');
unset($_SESSION['UNAME']);
session_destroy();
header('location:../../index.php');
?>