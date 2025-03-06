<?php
ob_start();   // Start output buffering
session_start();
include("../../dB/config.php");
include("../../auth/authentication.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");

if (isset($_GET['id'])) {
    $pet_id = $_GET['id'];

    // Fetch pet data
    $query = "SELECT * FROM `pets` WHERE `id` = '$pet_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $pet = mysqli_fetch_assoc($query_run);
    } else {
        $_SESSION['message'] = "Pet not found!";
        $_SESSION['code'] = "error";
        exit();
    }
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $color = $_POST['color'];
    $adoption_status = $_POST['adoption_status'];

    // Update query
    $query = "UPDATE `pets` SET 
        `name` = '$name', 
        `species` = '$species', 
        `breed` = '$breed', 
        `age` = '$age', 
        `gender` = '$gender', 
        `color` = '$color', 
        `adoption_status` = '$adoption_status' 
        WHERE `id` = '$pet_id'";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Pet details updated successfully!";
        $_SESSION['code'] = "success";
        header("Location: pets.php ");
        exit();
    } else {
        $_SESSION['message'] = "Failed to update pet details!";
        $_SESSION['code'] = "error";
    }
}
?>


<style>
body {
    background-color: #fff4d6;
}
</style>

<div class="pagetitle">
    <h1 style="color:#010101;">Edit Pet</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../admin/dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="pets.php">Pets</a></li>
            <li class="breadcrumb-item active" style="color:#010101;">Edit Pet</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" style="color:#010101;">Pet Details</h5>

                    <!-- Form to Edit Pet -->
                    <form action="" method="POST">
                        <!-- Pet Name Input -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Pet Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $pet['name']; ?>" required>
                        </div>

                        <!-- Species Input -->
                        <div class="mb-3">
                            <label for="species" class="form-label">Species</label>
                            <select class="form-control" id="species" name="species" required>
                                <option value="Cat">Cat</option>
                                <option value="Dog">Dog</option>
                                <option value="Bird">Bird</option>
                                <option value="Rabbit">Rabbit</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <!-- Breed Input -->
                        <div class="mb-3">
                            <label for="breed" class="form-label">Breed</label>
                            <input type="text" class="form-control" id="breed" name="breed" value="<?= $pet['breed']; ?>">
                        </div>

                        <!-- Age Input -->
                        <div class="mb-3">
                            <label for="age" class="form-label">Age (in years)</label>
                            <input type="number" class="form-control" id="age" name="age" min="0" value="<?= $pet['age']; ?>" required>
                        </div>

                        <!-- Gender Input -->
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="Male" <?= $pet['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?= $pet['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>

                        <!-- Color Input -->
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" id="color" name="color" value="<?= $pet['color']; ?>" required>
                        </div>

                        <!-- Adoption Status Input -->
                        <div class="mb-3">
                            <label for="adoption_status" class="form-label">Adoption Status</label>
                            <select class="form-control" id="adoption_status" name="adoption_status" required>
                                <option value="Available" <?= $pet['adoption_status'] == 'Available' ? 'selected' : ''; ?>>Available</option>
                                <option value="Adopted" <?= $pet['adoption_status'] == 'Adopted' ? 'selected' : ''; ?>>Adopted</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" name="update" class="btn btn-primary" style="background-color: #ff693b; border: 1px solid #ff693b;">Update Pet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("./includes/footer.php"); ?>
