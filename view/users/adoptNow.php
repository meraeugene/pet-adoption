<?php
session_start();
include("../../dB/config.php");
include("../../auth/authenticationForUser.php");
include("../users/includes/header.php");
include("../users/includes/topbar.php");
?>

<style>
    .card:hover {
        transform: scale(1.05); /* Slightly enlarge the card on hover */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
    }
</style>

<main style="height: 100vh; display: flex; justify-content: center; align-items: center; flex-direction: column;">
<div class="pagetitle" style="margin-bottom: 3em;">
    <h1  style=" font-size: 32px;">Select the Type of Pet You Want to Adopt</h1>
</div><!-- End Page Title -->

<section class="section " style="padding: 0 4rem; ">
    <div class="row justify-content-center w-100">
        <!-- Dog Card -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <a href="choosePet.php?type=dog" class="card" style="transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 10px; overflow: hidden; text-decoration: none;">
                <div class="card-body text-center" style=" border-radius: 10px; padding: 20px;">
                    <h5 class="card-title" style=" font-size: 28px;">Dog</h5>
                    <p style=" font-size: 18px;">Choose a dog to adopt!</p>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <a href="choosePet.php?type=bird" class="card" style="transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 10px; overflow: hidden; text-decoration: none;">
                <div class="card-body text-center" style="border-radius: 10px; padding: 20px;">
                    <h5 class="card-title" style=" font-size: 28px;">Bird</h5>
                    <p style=" font-size: 18px;">Choose a bird to adopt!</p>
                </div>
            </a>
        </div>

        <!-- Cat Card -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <a href="choosePet.php?type=cat" class="card" style="transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 10px; overflow: hidden; text-decoration: none;">
                <div class="card-body text-center" style="border-radius: 10px; padding: 20px;">
                    <h5 class="card-title" style="font-size: 28px;">Cat</h5>
                    <p style=" font-size: 18px;">Choose a cat to adopt!</p>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <a href="choosePet.php?type=rabbit" class="card" style="transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 10px; overflow: hidden; text-decoration: none;">
                <div class="card-body text-center" style=" border-radius: 10px; padding: 20px;">
                    <h5 class="card-title" style=" font-size: 28px;">Rabbit</h5>
                    <p style=" font-size: 18px;">Choose a rabitt to adopt!</p>
                </div>
            </a>
        </div>

          <!-- ALL Card -->
          <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <a href="choosePet.php?type=all" class="card" style="transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 10px; overflow: hidden; text-decoration: none;">
                <div class="card-body text-center" style=" border-radius: 10px; padding: 20px;">
                    <h5 class="card-title" style=" font-size: 28px;">All</h5>
                    <p style=" font-size: 18px;">Choose anything to adopt!</p>
                </div>
            </a>
        </div>
    </div>
</section>



</main>

