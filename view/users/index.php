<?php
session_start();
include("../../dB/config.php");
include("../../auth/authenticationForUser.php");
include("../users/includes/header.php");
include("../users/includes/topbar.php");

// Assuming the user's full name is stored in the session
$user_full_name =  isset($_SESSION['authUser']['fullName']) ? $_SESSION['authUser']['fullName'] : 'Guest';
?>

<section id="hero" style="background-color: #fff4d6; height: 100vh;">
  <div style="padding:7em 3em;" class="container">
    <div class="row gy-4">
      <div class="col-lg-6 order-2 order-lg-2 d-flex flex-column justify-content-center" style="padding: 30px;">
      
        <!-- Welcome Message with Full Name -->
        <h1 style="margin-bottom: 12px; font-size: 40px; color: #333; font-family: 'Raleway', sans-serif; font-weight: 700;">Welcome, <span style="color: #ff693b;"><?php echo htmlspecialchars($user_full_name); ?></span>!</h1>
        
        <!-- Exciting Subtitle -->
        <h6 style="line-height: 26px; font-size: 16px; color: #666; font-weight: 300; font-family: 'Raleway', sans-serif; margin-bottom: 1.5em;">Ready to find your new furry friend? Whether it's a playful pup or a wise old cat, your perfect companion is just a click away!</h6>

        <!-- Button Section -->
        <div class="d-flex">
          <a href="adoptNow.php" class="btn-get-started" style="
            color: #fff;
            font-family: 'Raleway', sans-serif;
            font-weight: 500;
            font-size: 16px;
            letter-spacing: 1px;
            display: inline-block;
            background-color: #ff693b;
            padding: 10px 36px;
            border-radius: 4px;
            transition: 0.5s;
            border: 2px solid var(--contrast-color);
          ">Adopt Now</a>
        </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-1 hero-img">
        <img src="../../assets/img/adoptnow.jpg" class="img-fluid animated" alt="">
      </div>
    </div>
  </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


