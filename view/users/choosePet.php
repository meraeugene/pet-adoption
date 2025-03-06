<?php
session_start();
include("../../dB/config.php");
include("../../auth/authenticationForUser.php");
include("../users/includes/header.php");
include("../users/includes/topbar.php");

// Get the selected pet type
$petType = isset($_GET['type']) ? $_GET['type'] : '';

if (!$petType) {
    echo "Please select a valid pet type.";
    exit();
}

?>

<main style=" display: flex; justify-content: center; align-items: center; flex-direction: column; padding-top: 6em; ">
<div class="pagetitle" style="margin-bottom: 24px;">
    <h1><?= ucfirst($petType); ?> Pets for Adoption</h1>
</div><!-- End Page Title -->

<section class="section" style="flex-wrap: wrap; width: 100%; padding: 0 4rem;">
    <div class="row" style="display: flex; justify-content: center; flex-wrap: wrap; width: 100%;">
        <?php
        // If the type is 'all', fetch all pets; otherwise, fetch pets of the selected type
        if ($petType === 'all') {
            // Fetch all pets
            $query = "SELECT * FROM `pets` WHERE `adoption_status` = 'Available'";
        } else {
            // Fetch pets of the selected type and available for adoption
            $query = "SELECT * FROM `pets` WHERE `species` = '$petType' AND `adoption_status` = 'Available'";
        }
        
        $query_run = mysqli_query($conn, $query);

        if (!$query_run) {
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($query_run) > 0) {
            // Loop through each pet and display its details as a card
            while ($row = mysqli_fetch_assoc($query_run)) {
                $pet_id = $row['id'];
                $pet_name = $row['name'];
                $pet_adoption_status = $row['adoption_status'];
                
                // Check if the user has already requested adoption for this pet
                $userId = $_SESSION['authUser']['userId']; // Get the current user's ID
                $request_query = "SELECT * FROM `request_adoption` WHERE `user_id` = '$userId' AND `pet_id` = '$pet_id' AND `status` != 'Rejected'";
                $request_result = mysqli_query($conn, $request_query);
                $is_requested = mysqli_num_rows($request_result) > 0;
                
                // Set the button text and class based on the adoption status
                if ($pet_adoption_status == 'Adopted') {
                    $button_text = "Adopted";
                    $button_class = "btn btn-secondary";  // Disabled-like style
                } elseif ($is_requested) {
                    $button_text = "Requested";
                    $button_class = "btn btn-warning";  // Show yellow color for requested
                } else {
                    $button_text = "Request to Adopt";
                    $button_class = "btn btn-success";  // Default green for available
                }
        ?>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-4" style="display: flex; justify-content: center; margin-bottom: 20px; ">
            <div class="card" style="width: 18rem; transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 10px; overflow: hidden;">
                <div class="card-body">
                    <h5 class="card-title"><?= $pet_name; ?></h5>
                    <p class="card-text">
                        <strong>Breed:</strong> <?= $row['breed']; ?><br>
                        <strong>Species:</strong> <?= $row['species']; ?><br>
                        <strong>Age:</strong> <?= $row['age']; ?> years<br>
                        <strong>Color:</strong> <?= $row['color']; ?><br>
                        <strong>Status:</strong> <?= $pet_adoption_status; ?>
                    </p>
                    <!-- Button to request adoption or show current status -->
                    <a href="<?php echo $button_class == 'btn btn-success' ? './controllers/requestAdoption.php?pet_id=' . $pet_id : '#'; ?>" 
                       class="btn <?= $button_class; ?>" 
                       <?php echo $button_class == 'btn btn-secondary' ? 'disabled' : ''; ?>>
                       <?= $button_text; ?>
                    </a>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo '<p style="text-align:center;">No pets of this type available for adoption at the moment.</p>';
        }
        ?>
    </div>
</section>

</main>
