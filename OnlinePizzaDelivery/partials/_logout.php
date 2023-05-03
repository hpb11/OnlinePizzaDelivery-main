<?php

session_start();
echo "Logging you out. Please wait...";
unset($_SESSION["loggedin"]);
unset($_SESSION["username"]);
unset($_SESSION["userId"]);

// session_unset();
// session_destroy();

header("location:http://localhost:8080/OnlinePizzaDelivery-main/OnlinePizzaDelivery/index.php");
?>