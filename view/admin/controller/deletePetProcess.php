<?php
session_start();
include("../../../dB/config.php");

if (isset($_GET['id'])) {
    $pet_id = $_GET['id'];

    // Step 1: Delete related adoption requests first
    $deleteAdoptionsQuery = "DELETE FROM `request_adoption` WHERE `pet_id` = '$pet_id'";
    mysqli_query($conn, $deleteAdoptionsQuery);

    // Step 2: Delete pet
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
