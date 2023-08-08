<?php
session_start();
session_destroy();
echo "<script>alert('Logout Successful');window.location.href = 'http://localhost/dixant_programs/car/agency/login.php';</script>";
?>