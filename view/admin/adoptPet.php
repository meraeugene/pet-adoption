<?php
session_start();
include("../../dB/config.php");

$petId = isset($_GET['id']) ? $_GET['id'] : '';

if (!$petId) {
    echo "Pet not found!";
    exit();
}

// Update adoption status to "Adopted"
$query = "UPDATE `pets` SET `adoption_status` = 'Adopted' WHERE `id` = '$petId' LIMIT 1";
$query_run = mysqli_query($conn, $query);

if ($query_run) {
    $_SESSION['message'] = "Congratulations! You've successfully adopted this pet.";
    $_SESSION['code'] = "success";
    header("Location: index.php");
} else {
    $_SESSION['message'] = "Error adopting pet. Please try again.";
    $_SESSION['code'] = "error";
    header("Location: index.php");
}
exit();
?>
