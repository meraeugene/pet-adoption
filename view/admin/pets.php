<?php
include("../../dB/config.php");
include("../../auth/authentication.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<style>
body{
    background-color: #fff4d6;
}
</style>

<div class="pagetitle">
    <h1 style="color: #010101;" >Pet Listings</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../admin/index.php">Home</a></li>
            <li class="breadcrumb-item active" style="color:#010101;">Pets</li>
        </ol>
    </nav>
</div><!-- End Page Title -->


<a href="./index.php" class="btn btn-primary mb-3" style="background-color: #ff693b; border: 1px solid #ff693b;">Back to Dashboard</a>


<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" style="color: #010101;">Pets</h5>

                    <!-- Add New Pet Button -->
                    <a href="addPets.php" class="btn btn-primary mb-3" style="background-color: #ff693b; border: 1px solid #ff693b;">Add New Pet</a>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Species</th>
            <th>Breed</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Color</th>
            <th>Adoption Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch pets data from the database
        $query = "SELECT * FROM `pets`";
        $query_run = mysqli_query($conn, $query);

        if (!$query_run) {
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($query_run) > 0) {
            // Loop through each pet and display its details in the table
            foreach ($query_run as $row) {
                $adoptionStatusClass = ($row['adoption_status'] == 'Adopted') ? 'bg-success' : 'bg-info';
                $adoptionStatusText = ($row['adoption_status'] == 'Adopted') ? 'ADOPTED' : 'AVAILABLE';
        ?>
                <tr>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['species']; ?></td>
                    <td><?= $row['breed']; ?></td>
                    <td><?= $row['age']; ?> years</td>
                    <td><?= $row['gender']; ?></td>
                    <td><?= $row['color']; ?></td>
                    <td><span class="badge <?= $adoptionStatusClass; ?>"><?= $adoptionStatusText; ?></span></td>
                    <td>
                        <a href="./editPets.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="confirmDeletePet(<?= $row['id']; ?>)">Delete</button>
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


<script>
    function confirmDeletePet(petId) {
        Swal.fire({
            title: "Are you sure?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `./controller/deletePetProcess.php?id=${petId}`;
            }
        });
    }
</script>

<?php
if(isset($_SESSION['message']) && $_SESSION['code'] !='') {
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


<?php
include("./includes/footer.php");
?>
