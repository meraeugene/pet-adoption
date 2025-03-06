<?php 
  $current_page = basename($_SERVER['PHP_SELF']); 
?>

<style>
.sidebar-nav .nav-link.active {
  background-color: #0b5ed7; 
  color: #fff;
}

.sidebar-nav .nav-link.active i {
  color: #ffffff !important;
}

</style>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?php echo ($current_page == 'pets.php') ? 'active' : ''; ?>" href="pets.php">
        <i class="bi bi-box2-heart"></i>
        <span>Pets</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?php echo ($current_page == 'users.php') ? 'active' : ''; ?>" href="users.php">
        <i class="bi bi-people"></i>
        <span>Users</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?php echo ($current_page == 'adoptionRequest.php') ? 'active' : ''; ?>" href="adoptionRequest.php">
        <i class="bi bi-file-check"></i>
        <span>Adoption Request</span>
      </a>
    </li>
  </ul>
</aside><!-- End Sidebar-->

  <main id="main" class="main">