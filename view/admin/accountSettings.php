<?php
ob_start();   // Start output buffering
include("../../dB/config.php");
include("../../auth/authentication.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");

$userId = $_SESSION['authUser']['userId'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = mysqli_real_escape_string($conn, $_POST['currentPassword']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    $query = "SELECT password FROM users WHERE userId = '$userId' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && $user['password'] === $currentPassword) {
        if ($newPassword === $confirmPassword) {
            $updateQuery = "UPDATE users SET password='$newPassword' WHERE userId='$userId'";
            if (mysqli_query($conn, $updateQuery)) {
                $_SESSION['message'] = "Password updated successfully!";
                $_SESSION['code'] = "success";

                session_unset();
                session_destroy();
                header("Location: ../../login.php");
                exit();
            } else {
                $_SESSION['message'] = "Error updating password: " . mysqli_error($conn);
                $_SESSION['code'] = "error";
            }
        } else {
            $_SESSION['message'] = "New passwords do not match.";
            $_SESSION['code'] = "error";
        }
    } else {
        $_SESSION['message'] = "Current password is incorrect.";
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
  <h1 style="color:#010101;">Change Password</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
      <li class="breadcrumb-item active" style="color:#010101;">Change Password</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title" style="color:#010101;">Update Your Password</h5>
          <form method="POST">
            <div class="mb-3">
              <label class="form-label">Current Password</label>
              <input type="password" name="currentPassword" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">New Password</label>
              <input type="password" name="newPassword" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Confirm New Password</label>
              <input type="password" name="confirmPassword" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary"  style="background-color: #ff693b; border: 1px solid #ff693b;">Update Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>


<?php include("./includes/footer.php"); ?>