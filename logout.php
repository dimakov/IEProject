<?php
session_start();
unset($_SESSION["curruser"]); 
header("Location: index.php");
?>