<?php 
  $current_page = basename($_SERVER['PHP_SELF']); 
?>

<style>



.sidebar-nav .nav-link.active {
  background-color: #ff693b;; 
  color: #fff !important;
}

.sidebar-nav .nav-link.active i {
  color: #ffffff !important;
}



</style>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar"  >
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item" >
      <a style="color:#010101;"class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">
        <i class="bi bi-grid" style="color:#010101;" ></i>
        <span >Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a style="color:#010101;" class="nav-link <?php echo ($current_page == 'pets.php') ? 'active' : ''; ?>" href="pets.php">
        <i class="bi bi-box2-heart" style="color:#010101;" ></i>
        <span>Pets</span>
      </a>
    </li>

    <li class="nav-item">
      <a  style="color:#010101;"  class="nav-link <?php echo ($current_page == 'users.php') ? 'active' : ''; ?>" href="users.php">
        <i class="bi bi-people" style="color:#010101;" ></i>
        <span  >Users</span>
      </a>
    </li>

    <li class="nav-item">
      <a style="color:#010101;"  class="nav-link <?php echo ($current_page == 'adoptionRequest.php') ? 'active' : ''; ?>" href="adoptionRequest.php">
        <i class="bi bi-file-check" style="color:#010101;" ></i>
        <span  >Adoption Request</span>
      </a>
    </li>
  </ul>
</aside><!-- End Sidebar-->

  <main id="main" class="main">