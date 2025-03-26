<?php
ob_start();   // Start output buffering
include("../../dB/config.php");
include("../../auth/authenticationForUser.php");
include("./includes/header.php");
include("./includes/topbar.php");

$userId = $_SESSION['authUser']['userId'];
$query = "SELECT firstName, lastName, email, phoneNumber FROM users WHERE userId = '$userId' LIMIT 1";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);

    $updateQuery = "UPDATE users SET firstName='$firstName', lastName='$lastName', email='$email', phoneNumber='$phoneNumber' WHERE userId='$userId'";
    
    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['message'] = "Profile updated successfully!";
        $_SESSION['code'] = "success";
        header("Location: editProfile.php");
        exit();
    } else {
        $_SESSION['message'] = "Error updating profile: " . mysqli_error($conn);
        $_SESSION['code'] = "error";
    }
}
?>

<style>
body {
    background-color: #fff4d6;
}
</style>


<main style=" display: flex; justify-content: center; flex-direction: column; padding: 6em 2em; ">

<a href="./index.php" class="btn btn-primary mb-3" style="background-color: #ff693b; border: 1px solid #ff693b; width: 200px;">Back to Homepage</a>

<div class="pagetitle">
  <h1 style="color:#010101;">Edit Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
      <li class="breadcrumb-item active" style="color:#010101;">Edit Profile</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title" style="color:#010101;">Edit Profile Details</h5>
          <form method="POST">
            <div class="mb-3">
              <label class="form-label">First Name</label>
              <input type="text" name="firstName" class="form-control" value="<?= $user['firstName']; ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Last Name</label>
              <input type="text" name="lastName" class="form-control" value="<?= $user['lastName']; ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="<?= $user['email']; ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Phone Number</label>
              <input type="text" name="phoneNumber" class="form-control" value="<?= $user['phoneNumber']; ?>">
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #ff693b; border: 1px solid #ff693b;">Update Profile</button>
          </form>
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
        Swal.fire({
            icon: "<?= $_SESSION['code']; ?>",
            title: "<?= $_SESSION['message']; ?>",
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
    </script>
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['code']);
}
?>

