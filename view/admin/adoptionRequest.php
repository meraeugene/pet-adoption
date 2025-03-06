<?php
ob_start();   // Start output buffering
include("../../dB/config.php");
include("../../auth/authentication.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");

if (isset($_POST['update_status'])) {
    $id = $_POST['request_id'];
    $status = $_POST['status'];

    // Update request status
    $updateQuery = "UPDATE request_adoption SET status = '$status' WHERE id = '$id'";
    
    if (mysqli_query($conn, $updateQuery)) {
        // If approved, update pet's adoption_status to 'Adopted'
        if ($status == 'Approved') {
            $updatePetStatus = "UPDATE pets SET adoption_status = 'Adopted' 
                                WHERE id = (SELECT pet_id FROM request_adoption WHERE id = '$id')";
            mysqli_query($conn, $updatePetStatus);
        }

        $_SESSION['message'] = "Adoption request has been $status.";
        $_SESSION['code'] = ($status == 'Approved') ? "success" : "error";
    } else {
        $_SESSION['message'] = "Failed to update adoption request.";
        $_SESSION['code'] = "error";
    }
    header("Location: adoptionRequest.php");
    exit();
}
?>

<div class="pagetitle">
    <h1>Adoption Requests</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../admin/index.php">Home</a></li>
            <li class="breadcrumb-item active">Adoption Requests</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Requests</h5>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Adopter Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Pet Name</th>
                                <th>Species</th>
                                <th>Breed</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Color</th>
                                <th>Request Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT ra.id, ra.status AS request_status, u.firstName, u.lastName, u.email, u.phoneNumber, 
                                             p.id AS pet_id, p.name AS petName, p.species, p.breed, p.age, p.gender, p.color, p.adoption_status
                                      FROM request_adoption ra 
                                      JOIN users u ON ra.user_id = u.userId 
                                      JOIN pets p ON ra.pet_id = p.id";
                            $query_run = mysqli_query($conn, $query);

                            if (!$query_run) {
                                die("Query failed: " . mysqli_error($conn));
                            }

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                                    $statusClass = ($row['request_status'] == 'Approved') ? 'bg-success' : (($row['request_status'] == 'Pending') ? 'bg-warning' : 'bg-danger');
                            ?>
                                    <tr>
                                        <td><?= $row['firstName'] . ' ' . $row['lastName']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                        <td><?= $row['phoneNumber']; ?></td>
                                        <td><?= $row['petName']; ?></td>
                                        <td><?= $row['species']; ?></td>
                                        <td><?= $row['breed']; ?></td>
                                        <td><?= $row['age']; ?> years</td>
                                        <td><?= $row['gender']; ?></td>
                                        <td><?= $row['color']; ?></td>
                                        <td><span class="badge <?= $statusClass; ?>"><?= $row['request_status']; ?></span></td>
                                        <td>
                                            <?php if ($row['request_status'] == 'Pending') { ?>
                                                <form method="POST" style="display:inline;">
                                                    <input type="hidden" name="request_id" value="<?= $row['id']; ?>">
                                                    <input type="hidden" name="status" value="Approved">
                                                    <button type="submit" name="update_status" class="btn btn-success btn-sm">Accept</button>
                                                </form>
                                                <form method="POST" style="display:inline;">
                                                    <input type="hidden" name="request_id" value="<?= $row['id']; ?>">
                                                    <input type="hidden" name="status" value="Rejected">
                                                    <button type="submit" name="update_status" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            <?php } ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if (isset($_SESSION['message']) && $_SESSION['code'] != '') {
    ?>
    <script>
        Swal.fire({
            icon: "<?php echo $_SESSION['code']; ?>",
            title: "<?php echo $_SESSION['message']; ?>",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['code']);
}
?>

<?php
include("./includes/footer.php");
?>
