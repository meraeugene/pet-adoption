<?php
session_start();
include("../../../dB/config.php"); // Your database connection

if (isset($_POST['add_pet'])) {
    // Collect form data
    $name = $_POST['name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $color = $_POST['color'];
    $adoption_status = $_POST['adoption_status'] ?? 'Available'; // Default to 'Available' if not selected

    // Insert pet details into the database
    $query = "INSERT INTO `pets` (name, species, breed, age, gender, color, adoption_status) 
              VALUES ('$name', '$species', '$breed', '$age', '$gender', '$color', '$adoption_status')";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        // Success - redirect to the pets page with a success message
        $_SESSION['message'] = "Pet added successfully!";
        $_SESSION['code'] = "success";
        header("Location: ../pets.php"); // Redirect to the pets list page
        exit();
    } else {
        // Error - set error message and stay on the current page
        $_SESSION['message'] = "Failed to add pet!";
        $_SESSION['code'] = "error";
        header("Location: ../addPets.php"); // Stay on the Add Pet page if there's an error
        exit();
    }
}
?>
