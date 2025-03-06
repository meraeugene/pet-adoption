<?php
session_start();
include("../../dB/config.php");
include("../../auth/authentication.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<div class="pagetitle">
    <h1>User Listings</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../admin/index.php">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Birthday</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch users data from the database
                            $query = "SELECT * FROM `users`"; // Assuming the table name is 'users'
                            $query_run = mysqli_query($conn, $query);

                            if (!$query_run) {
                                die("Query failed: " . mysqli_error($conn));
                            }

                            if (mysqli_num_rows($query_run) > 0) {
                                // Loop through each user and display their details in the table
                                foreach ($query_run as $row) {
                                    // Uppercase the role and apply color based on role
                                    $role = strtoupper($row['role']); // Uppercase role
                                    $roleClass = ($role == 'ADMIN') ? 'bg-success' : 'bg-info'; // Admin -> red, User -> blue
                            ?>
                                    <tr>
                                        <td><?= $row['firstName']; ?></td>
                                        <td><?= $row['lastName']; ?></td>
                                        <td><?= $row['gender']; ?></td>
                                        <td><?= $row['birthday']; ?></td>
                                        <td><span class="badge <?= $roleClass; ?>"><?= $role; ?></span></td> <!-- Uppercase role with color -->
                                       <td>
    <a href="./viewUser.php?id=<?= $row['userId']; ?>" class="btn btn-primary btn-sm">View</a>
    <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $row['userId']; ?>)">Delete</button>
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
    function confirmDelete(userId) {
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
                window.location.href = `./deleteUser.php?id=${userId}`;
            }
        });
    }
</script>

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

<?php
include("./includes/footer.php");
?>
