<?php
session_start();
include("../../../dB/config.php");

if (isset($_GET['id'])) {
    $pet_id = $_GET['id'];

    // Delete pet query
    $query = "DELETE FROM `pets` WHERE `id` = '$pet_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Pet deleted successfully!";
        $_SESSION['code'] = "success";
    } else {
        $_SESSION['message'] = "Failed to delete pet!";
        $_SESSION['code'] = "error";
    }
}

header("Location: ../pets.php");
exit();
