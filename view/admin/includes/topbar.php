  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a   class="logo d-flex align-items-center">
        <img src="../../assets/img/pet-care.png" alt="" >
        <span class="d-none d-lg-block" style="color: #ff693b;">PawConnect</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn" style="color: #ff693b;"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <i style="color: #010101;" class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
          <span style="color: #010101;" class="d-none d-md-block dropdown-toggle ps-2">            
              <?php echo isset($_SESSION['authUser']['fullName']) ? $_SESSION['authUser']['fullName'] : "Guest"; ?>
            </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
            <h6 style="color: #010101;"><?php echo $_SESSION['authUser']['fullName']; ?></h6>
            <span style="color: #010101;"> <?php echo ucfirst($_SESSION['userRole']); ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="editProfile.php">
                <i class="bi bi-person"></i>
                <span >My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="accountSettings.php">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

          
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../../view/admin/controller/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->