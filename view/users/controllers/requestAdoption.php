<?php
session_start();
include("../../../dB/config.php");

if (isset($_GET['pet_id'])) {
    $pet_id = $_GET['pet_id'];
    $userId = $_SESSION['authUser']['userId'];

    // Check if the user has already requested  Please wait for the confirmation.adoption for this pet
    $check_request_query = "SELECT * FROM `request_adoption` WHERE `user_id` = '$userId' AND `pet_id` = '$pet_id' AND `status` != 'Rejected'";
    $check_request_result = mysqli_query($conn, $check_request_query);

    if (mysqli_num_rows($check_request_result) > 0) {
        // The user has already made a request, so prevent another request
        $_SESSION['message'] = "You have already requested to adopt this pet.";
        $_SESSION['code'] = "error"; 
        header("Location: ../adoptionRequest.php"); // Redirect to the user's adoption requests page
        exit();
    }

    // Check if this pet is available for adoption
    $check_pet_query = "SELECT * FROM `pets` WHERE `id` = '$pet_id' AND `adoption_status` = 'Available'";
    $check_pet_result = mysqli_query($conn, $check_pet_query);

    if (mysqli_num_rows($check_pet_result) > 0) {
        // Insert adoption request if the pet is available
        $insert_query = "INSERT INTO `request_adoption` (`user_id`, `pet_id`, `status`) VALUES ('$userId', '$pet_id', 'Pending')";
        if (mysqli_query($conn, $insert_query)) {
            $_SESSION['message'] = "Adoption request submitted successfully! Please wait for the confirmation.";
            $_SESSION['code'] = "success"; 
            header("Location: ../adoptionRequest.php");
        } else {
            $_SESSION['message'] = "Error submitting your adoption request. Please try again later.";
            $_SESSION['code'] = "error";
            header("Location: ../adoptionRequest.php");
        }
    } else {
        $_SESSION['message'] = "This pet is no longer available for adoption.";
        $_SESSION['code'] = "error";
        header("Location: ../adoptionRequest.php");
    }
} else {
    $_SESSION['message'] = "Invalid pet ID.";
    $_SESSION['code'] = "error";
    header("Location: ../adoptionRequest.php");
}
?>
