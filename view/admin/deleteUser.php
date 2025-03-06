<?php
session_start();
include("../../dB/config.php");

// Check if user ID is provided
if (isset($_GET['id'])) {
    $userId = mysqli_real_escape_string($conn, $_GET['id']);

    // Delete all related records in request_adoption first
    $deleteRequests = "DELETE FROM request_adoption WHERE user_id = '$userId'";
    mysqli_query($conn, $deleteRequests);

    // Now delete the user
    $deleteUser = "DELETE FROM users WHERE userId = '$userId'";
    $query_run = mysqli_query($conn, $deleteUser);

    if ($query_run) {
        $_SESSION['message'] = "User deleted successfully!";
        $_SESSION['code'] = "success";
    } else {
        $_SESSION['message'] = "Failed to delete user.";
        $_SESSION['code'] = "error";
    }

    header("Location: users.php");
    exit();
} else {
    $_SESSION['message'] = "Invalid request.";
    $_SESSION['code'] = "error";
    header("Location: users.php");
    exit();
}
?>
