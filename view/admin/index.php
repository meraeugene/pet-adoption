<?php
include("../../dB/config.php");
include("../../auth/authentication.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>


<div class="pagetitle">
    <h1>PawConnect Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../admin/index.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <!-- Total Users Card -->
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="fs-1">
                        <?php
                        // Query to get total number of users
                        $query_users = "SELECT COUNT(*) AS total_users FROM users";
                        $result_users = mysqli_query($conn, $query_users);
                        $data_users = mysqli_fetch_assoc($result_users);
                        echo $data_users['total_users'];
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Pets Listed Card -->
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Pets Listed</h5>
                    <p class="fs-1">
                        <?php
                        // Query to get total number of pets listed
                        $query_pets = "SELECT COUNT(*) AS total_pets FROM pets";
                        $result_pets = mysqli_query($conn, $query_pets);
                        $data_pets = mysqli_fetch_assoc($result_pets);
                        echo $data_pets['total_pets'];
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div><!-- End Row -->

    <!-- Adoption Status Cards -->
    <div class="row">
        <!-- Total Available Pets Card -->
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Available Pets</h5>
                    <p class="fs-1">
                        <?php
                        // Query to get total number of available pets
                        $query_available = "SELECT COUNT(*) AS available_pets FROM pets WHERE adoption_status = 'Available'";
                        $result_available = mysqli_query($conn, $query_available);
                        $data_available = mysqli_fetch_assoc($result_available);
                        echo $data_available['available_pets'];
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Adopted Pets Card -->
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Adopted Pets</h5>
                    <p class="fs-1">
                        <?php
                        // Query to get total number of adopted pets
                        $query_adopted = "SELECT COUNT(*) AS adopted_pets FROM pets WHERE adoption_status = 'Adopted'";
                        $result_adopted = mysqli_query($conn, $query_adopted);
                        $data_adopted = mysqli_fetch_assoc($result_adopted);
                        echo $data_adopted['adopted_pets'];
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div><!-- End Row -->

  <!-- Row to display both charts side by side -->
<div class="row">
    <!-- Total Users and Pets Listed Chart -->
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Users and Pets Listed Chart</h5>
                <canvas id="userPetChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Adoption Status Chart -->
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Adoption Status Chart</h5>
                <canvas id="adoptionStatusChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div><!-- End Row -->


</section><!-- End Dashboard -->

<!-- Vendor JS Files -->
<script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../../assets/vendor/echarts/echarts.min.js"></script>

<!-- Template Main JS File -->
<script src="../../assets/js/main.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Fetching the total users and total pets from PHP variables for the first chart
        const totalUsers = <?php echo $data_users['total_users']; ?>;
        const totalPets = <?php echo $data_pets['total_pets']; ?>;

        // Get the context of the canvas element for the Users and Pets chart
        var ctx = document.getElementById('userPetChart').getContext('2d');

        // Create a bar chart for total users and pets listed
        var userPetChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Users', 'Total Pets Listed'],
                datasets: [{
                    label: 'Count',
                    data: [totalUsers, totalPets],
                    backgroundColor: ['#42a5f5', '#66bb6a'],
                    borderColor: ['#1e88e5', '#43a047'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Fetching the data for available and adopted pets from PHP variables for the second chart
        const availablePets = <?php echo $data_available['available_pets']; ?>;
        const adoptedPets = <?php echo $data_adopted['adopted_pets']; ?>;

        // Get the context of the canvas element for the Adoption Status chart
        var ctx2 = document.getElementById('adoptionStatusChart').getContext('2d');

        // Create a pie chart for adoption status (available vs adopted)
        var adoptionStatusChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Available Pets', 'Adopted Pets'],
                datasets: [{
                    label: 'Pets Adoption Status',
                    data: [availablePets, adoptedPets],
                    backgroundColor: ['#66bb6a', '#f44336'],
                    borderColor: ['#43a047', '#e53935'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' pets';
                            }
                        }
                    }
                }
            }
        });
    });
</script>



<?php include("./includes/footer.php"); ?>
