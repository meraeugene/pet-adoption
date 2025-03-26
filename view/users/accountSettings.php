<?php
ob_start();   // Start output buffering
include("../../dB/config.php");
include("../../auth/authenticationForUser.php");
include("./includes/header.php");
include("./includes/topbar.php");

$userId = $_SESSION['authUser']['userId'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = mysqli_real_escape_string($conn, $_POST['currentPassword']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    // Server-side validation: Ensure new passwords match
    if ($newPassword !== $confirmPassword) {
        $_SESSION['message'] = "New password and confirm password do not match!";
        $_SESSION['code'] = "error";
    } else {
        // Check if the current password is correct
        $query = "SELECT password FROM users WHERE userId = '$userId' LIMIT 1";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user && $user['password'] === $currentPassword) {
            $updateQuery = "UPDATE users SET password='$newPassword' WHERE userId='$userId'";
            if (mysqli_query($conn, $updateQuery)) {
                $_SESSION['message'] = "Password updated successfully! Please log in again.";
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
            $_SESSION['message'] = "Current password is incorrect.";
            $_SESSION['code'] = "error";
        }
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body {
    background-color: #fff4d6;
}
</style>

<main style=" display: flex; justify-content: center; flex-direction: column; padding: 6em 2em; ">
<a href="./index.php" class="btn btn-primary mb-3" style="background-color: #ff693b; border: 1px solid #ff693b; width: 200px;">Back to Homepage</a>

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
          <form id="passwordForm" method="POST">
            <div class="mb-3">
              <label class="form-label">Current Password</label>
              <input type="password" name="currentPassword" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">New Password</label>
              <input type="password" id="newPassword" name="newPassword" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Confirm New Password</label>
              <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #ff693b; border: 1px solid #ff693b;">Update Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</main>

<!-- SweetAlert Notifications -->
<?php if (isset($_SESSION['message'])): ?>
<script>
Swal.fire({
    icon: "<?= $_SESSION['code'] === 'success' ? 'success' : 'error' ?>",
    title: "<?= $_SESSION['code'] === 'success' ? 'Success!' : 'Oops...' ?>",
    text: "<?= $_SESSION['message'] ?>"
});
</script>
<?php unset($_SESSION['message'], $_SESSION['code']); ?>
<?php endif; ?>

<script>
document.getElementById("passwordForm").addEventListener("submit", function(event) {
    let newPassword = document.getElementById("newPassword").value;
    let confirmPassword = document.getElementById("confirmPassword").value;

    if (newPassword !== confirmPassword) {
        event.preventDefault(); // Prevent form submission
        Swal.fire({
            icon: "error",
            title: "Password Mismatch",
            text: "New password and confirm password do not match!",
        });
    }
});
</script>

<?php include("./includes/footer.php"); ?>
