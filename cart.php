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
    <style>
        .cart_image {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
    </style>
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
                            <a class="nav-link" href="display_all.php">Items</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item(); ?></sup></i></a>
                        </li>
                    </ul>
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
          <a href="users_area/user_login.php" class="nav-link">Login</a>
        </li>
            </ul>
        </nav>
        <div class="bg-light">
            <h3 class="text-center">Good Food</h3>
        </div>
        <div class="container">
            <div class="row">
                <form action="" method="post">
                <table class="table table-bordered text-center">
                    
                        <?php
                        global $con;
                        $get_ip_add = getIPAddress();
                        $total_price = 0;
                        $cart_query = "Select * from `cart_details` where ip_address ='$get_ip_add'";
                        $result = mysqli_query($con, $cart_query);
                        $result_count=mysqli_num_rows($result);
                        if($result_count>0){
                            echo "<thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                                <th colspan='2'>Operation</th>
                            </tr>
                        </thead>
                        <tbody>";
                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $select_products = "Select * from `products` where product_id='$product_id'";
                            $result_products = mysqli_query($con, $select_products);

                            while ($row_product_price = mysqli_fetch_array($result_products)) {
                                $product_price = array($row_product_price['product_price']);
                                $price_table = $row_product_price['product_price'];
                                $product_title = $row_product_price['product_title'];
                                $product_image1 = $row_product_price['product_image1'];
                                $product_values = array_sum($product_price);
                                $total_price += $product_values;
                        ?>
                        <tr>
                            <td><?php echo $product_title ?></td>
                            <td><img src="./admin/product_images/<?php echo $product_image1 ?>" alt="" class="cart_image"></td>
                            <td><input type="text" class="form-input w-50" name="qty"></td>
                            <?php
                                $get_ip_add = getIPAddress();
                                if(isset($_POST['update_cart'])){
                                    $quantity=$_POST['qty'];
                                    $update_cart="update `cart_details` set quantity=$quantity where ip_address='$get_ip_add'";
                                    $result_products_quantity=mysqli_query($con,$update_cart);
                                    $total_price=$total_price*$quantity;
                                }

                            ?>

                            <td><?php echo $price_table ?>/-</td>
                            <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                            <td>
                             
                                <input type="submit" value="Update cart" name="update_cart" class="bg-danger px-3 py-3 mx-2 border-0">
                                <!-- <button class="bg-danger px-3 py-3 mx-2 border-0">Remove</button> -->
                                
                                <input type="submit" value="Remove cart" name="remove_cart" class="bg-danger px-3 py-3 mx-2 border-0">
                            </td>
                        </tr>
                        <?php 
                         }}
                        }
                        else{
                            echo "<h2 class='text-center text-danger'>Cart is empty..</h2>";
                        }
                        ?>
                    </tbody>
                </table>
                <!-- subtotal-->
                <div class="d-flex mb-5">
                    <?php
                    $get_ip_add = getIPAddress();
                    $cart_query = "Select * from `cart_details` where ip_address ='$get_ip_add'";
                    $result = mysqli_query($con, $cart_query);
                    $result_count=mysqli_num_rows($result);
                    if($result_count>0){
                        echo "<h4 class='px-3 '>Subtotal:<strong class='text-info'>$total_price/-</strong></h4>
                        <input type='submit' value='Continue Shoping' name='continue_shoping' class='bg-info px-3 py-3 mx-2 border-0'>
                        <button class='bg-info text-light p-3 py-3 border-0'><a href='users_area/checkout.php'>Checkout</a></button>";
                    }else{
                        echo "<input type='submit' value='Continue Shoping' name='continue_shoping' class='bg-info px-3 py-3 mx-2 border-0'>";
                    }
                    if(isset($_POST['continue_shoping'])){
                        echo "<script>window.open('index.php','_self')</script>";
                    }
                    ?>
                    
                </div>
            </div>
        </div>
                </form>
                <?php
    function remove_cart_item(){
        global $con;
        if(isset($_POST['remove_cart'])){
            foreach($_POST['removeitem'] as $remove_id){
                echo $remove_id;
                $delete_query="Delete from `cart_details` where product_id=$remove_id";
                $run_delete=mysqli_query($con,$delete_query);
                if($run_delete){
                    echo "<script>window.open('cart.php','_self')</script>";
                } 
            }
        }
    }
    echo $remove_id=remove_cart_item();
    ?>
                

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