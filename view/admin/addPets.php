<?php
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="pagetitle">
    <h1>Add Pet</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../admin/dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Add Pet</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pet Details</h5>

                    <!-- Form to Add Pet -->
                    <form action="./controller/addPetProcess.php" method="POST">
                        <!-- Pet Name Input -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Pet Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                      <!-- Species Input -->
                        <div class="mb-3">
                            <label for="species" class="form-label">Species</label>
                            <select class="form-control" id="species" name="species" required>
                                <option value="" selected disabled>Select species...</option>
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
                            <input type="text" class="form-control" id="breed" name="breed">
                        </div>

                        <!-- Age Input -->
                        <div class="mb-3">
                            <label for="age" class="form-label">Age (in years)</label>
                            <input type="number" class="form-control" id="age" name="age" min="0" required>
                        </div>

                        <!-- Gender Input -->
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="" selected disabled>Select gender...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <!-- Color Input -->
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" id="color" name="color" required>
                        </div>

                        <!-- Adoption Status Input -->
                        <div class="mb-3">
                            <label for="adoption_status" class="form-label">Adoption Status</label>
                            <select class="form-control" id="adoption_status" name="adoption_status" required>
                                <option value="Available" selected>Available</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" name="add_pet" class="btn btn-primary">Add Pet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("./includes/footer.php"); ?>
