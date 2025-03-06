<?php
include("../../dB/config.php");
include("../../auth/authentication.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    
    // Fetch user details
    $query = "SELECT * FROM `users` WHERE userId = '$user_id'";  // Make sure you're using 'userId' as the column name
    $query_run = mysqli_query($conn, $query);
    
    if (!$query_run) {
        die("Query failed: " . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($query_run);
    if (!$user) {
        echo "User not found.";
        exit;
    }
}
?>

<style>
body{
    background-color: #fff4d6;
}
</style>

<div class="pagetitle">
  <h1 style="color:#010101;">User Details</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="../admin/dashboard.php">Home</a></li>
      <li class="breadcrumb-item"><a href="users.php" >Users</a></li>
      <li class="breadcrumb-item active" style="color:#010101;">View User</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title" style="color:#010101;"><?= $user['firstName'] . ' ' . $user['lastName']; ?></h5>
          <p><strong>Email:</strong> <?= $user['email']; ?></p>
          <p><strong>Phone:</strong> <?= $user['phoneNumber']; ?></p>
          <p><strong>Gender:</strong> <?= $user['gender']; ?></p>
          <p><strong>Role:</strong> <?= $user['role']; ?></p>
          <p><strong>Birthday:</strong> <?= date('F j, Y', strtotime($user['birthday'])); ?></p>
   <!-- Verification Status with Green/Red Color -->
   <p>
            <strong>Verification Status:</strong> 
            <span class="<?= $user['verification'] ? 'text-success' : 'text-danger'; ?>">
              <?= $user['verification'] ? 'Verified' : 'Not Verified'; ?>
            </span>
          </p>          
          
          <!-- Add any other user details here if needed -->
          
        </div>
      </div>
    </div>
  </div>
</section>

