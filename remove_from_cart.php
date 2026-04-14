<?php
session_start();

if (isset($_GET['id'])) {
    $movie_ID = intval($_GET['id']);
    unset($_SESSION['cart'][$movie_ID]);
}

header("Location: cart.php");
exit();
?>
