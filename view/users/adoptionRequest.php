<?php
include("../../dB/config.php");
include("../../auth/authenticationForUser.php");
include("./includes/header.php");
include("./includes/topbar.php");


// Check if the user is logged in
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header('Location: login.php');  // Redirect to login page if not logged in
    exit();
}

$userId = $_SESSION['authUser']['userId']; // Get the logged-in user's ID

?>


<style>
body{
    background-color: #fff4d6;
}
</style>

<main style=" display: flex; justify-content: center;  flex-direction: column; padding: 5em 2em; ">
<div class="pagetitle">
    <h1  style="color: #010101;">Your Adoption Requests</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" style="color: #010101;">Adoption Requests</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"  style="color: #010101;">Your Adoption Requests</h5>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Pet Name</th>
                                <th>Breed</th>
                                <th>Species</th>
                                <th>Age</th>
                                <th>Color</th>
                                <th>Request Date</th>
                                <th>Request Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch the adoption requests for the logged-in user with pet details
                            $query = "SELECT r.id, r.pet_id, r.status, r.request_date, 
                                             p.name AS pet_name, p.breed, p.species, p.age, p.color
                                      FROM request_adoption r
                                      JOIN pets p ON r.pet_id = p.id
                                      WHERE r.user_id = '$userId'";
                            $query_run = mysqli_query($conn, $query);

                            if (!$query_run) {
                                die("Query failed: " . mysqli_error($conn));
                            }

                            if (mysqli_num_rows($query_run) > 0) {
                                // Loop through each adoption request and display its details
                                foreach ($query_run as $row) {
                                    $status = strtoupper($row['status']);
                                    $statusClass = ($status == 'PENDING') ? 'bg-warning' : ($status == 'APPROVED' ? 'bg-success' : 'bg-danger');
                            ?>
                                    <tr>
                                        <td><?= $row['pet_name']; ?></td>
                                        <td><?= $row['breed']; ?></td>
                                        <td><?= $row['species']; ?></td>
                                        <td><?= $row['age']; ?> years</td>
                                        <td><?= $row['color']; ?></td>
                                        <td><?= date('F j, Y, g:i A', strtotime($row['request_date'])); ?></td>
                                        <td><span class="badge <?= $statusClass; ?>"><?= $status; ?></span></td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>You have not submitted any adoption requests yet.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                    
                    <!-- Button to submit a new adoption request -->
                    <a href="adoptNow.php" class="btn btn-primary" style="background-color: #ff693b; border: 1px solid #ff693b;">Submit a New Adoption Request</a>
                </div>
            </div>
        </div>
    </div>
</section>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if (isset($_SESSION['message']) && $_SESSION['code'] != '') {
    ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Toast.fire({
            icon: "<?php echo $_SESSION['code']; ?>",
            title: "<?php echo $_SESSION['message']; ?>"
        });
    </script>
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['code']);
}
?>

