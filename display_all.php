<?php
include('includes/conn.php');
include('functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Good Food</title>
  <!--Bootstrap css link-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <!--font awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- css file -->
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- nav bar-->
  <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-danger">
      <div class="container-fluid">
        <img src="img/logo.png" alt="" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="display.php">Items</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"><sup>1</sup></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Total price</a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
    <!-- welcome nav-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a href="#" class="nav-link">Welcome</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Login</a>
        </li>
      </ul>
    </nav>
    <div class="bg-light">
      <h3 class="text-center">Good Food</h3>
    </div>

    <div class="row  px-1">
      <div class="col-md-10">
        <!--product-->
        <div class="row">
          <!-- factching products-->
          <?php
          //calling to get all products on screen
          get_all_products();
          get_unique_categories();
          get_unique_brands();
          ?>
        </div>
      </div>
      <div class="col-md-2 bg-secondary p-0">
        <!--side nav-->

        <!--brands-->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info ">
            <a href="#" class="nav-link text-light">
              <h4>Delivery brands</h4>
            </a>
          </li>
          <?php
          //calling funtion to display brands
          getbrands();
          ?>
        </ul>
        <!---->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info ">
            <a href="#" class="nav-link text-light">
              <h4>Categoris</h4>
            </a>
          </li>
          <?php
          //calling function to display categories
          getcategories();
          ?>
        </ul>
      </div>
    </div>
    <!--footer-->
    <!--include footer-->
    <?php 
      include('./includes/footer.php')
    ?>
  </div>
  <!-- bootsrape js link-->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>