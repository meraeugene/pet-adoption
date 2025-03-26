<?php
ob_start();
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

    if ($newPassword !== $confirmPassword) {
        $_SESSION['alert'] = [
            'type' => 'error',
            'message' => 'New passwords do not match!'
        ];
    } else {
        $query = "SELECT password FROM users WHERE userId = '$userId' LIMIT 1";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            if ($currentPassword !== $user['password']) { // Direct comparison (No Hashing)
                $_SESSION['alert'] = [
                    'type' => 'error',
                    'message' => 'Current password is incorrect!'
                ];
            } else {
                $updateQuery = "UPDATE users SET password='$newPassword' WHERE userId='$userId'";

                if (mysqli_query($conn, $updateQuery)) {
                    $_SESSION['alert'] = [
                        'type' => 'success',
                        'message' => 'Password updated successfully! Please log in again.'
                    ];
                    session_unset();
                    session_destroy();
                    header("Location: ../../login.php");
                    exit();
                } else {
                    $_SESSION['alert'] = [
                        'type' => 'error',
                        'message' => 'Error updating password: ' . mysqli_error($conn)
                    ];
                }
            }
        } else {
            $_SESSION['alert'] = [
                'type' => 'error',
                'message' => 'User not found!'
            ];
        }
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Show SweetAlert Messages -->
<?php if (isset($_SESSION['alert'])): ?>
<script>
Swal.fire({
    icon: '<?= $_SESSION['alert']['type'] ?>',
    title: '<?= $_SESSION['alert']['type'] === 'success' ? 'Success!' : 'Oops...' ?>',
    text: '<?= $_SESSION['alert']['message'] ?>'
});
</script>
<?php unset($_SESSION['alert']); ?>
<?php endif; ?>

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

<a href="./index.php" class="btn btn-primary mb-3" style="background-color: #ff693b; border: 1px solid #ff693b;">Back to Dashboard</a>

<section class="section">
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title" style="color:#010101;">Update Your Password</h5>
          <form method="POST" id="passwordForm">
            <div class="mb-3">
              <label class="form-label">Current Password</label>
              <input type="password" name="currentPassword" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">New Password</label>
              <input type="password" name="newPassword" id="newPassword" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Confirm New Password</label>
              <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #ff693b; border: 1px solid #ff693b;">Update Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("passwordForm").addEventListener("submit", function (event) {
        var newPassword = document.getElementById("newPassword").value;
        var confirmPassword = document.getElementById("confirmPassword").value;

        if (newPassword !== confirmPassword) {
            event.preventDefault(); // Prevent form submission
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'New passwords do not match!'
            });
        }
    });
});
</script>

<?php include("./includes/footer.php"); ?>
