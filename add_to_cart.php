<?php
session_start();
include 'db.php';

if (isset($_GET['id'])) {
    $movie_ID = intval($_GET['id']);
    $sql = "SELECT movie_name, movie_price FROM movie WHERE movie_ID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $movie_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $movie = $result->fetch_assoc();

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $_SESSION['cart'][$movie_ID] = [
                "movie_name" => $movie['movie_name'],
                "movie_price" => $movie['movie_price']
            ];

            header("Location: cart.php");
            exit();
        }
    }
}

header("Location: index.php");
exit();
?>
