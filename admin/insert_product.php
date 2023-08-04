<?php
include("../includes/conn.php");
if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $product_keywords = $_POST['product_keyword'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';
    //access image

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    //accessing image tmp name
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    //checking empty condition
    if (
        $product_title == '' or $description == '' or $product_keywords == '' or $product_category == ''
        or $product_brands == '' or $product_price == '' or $product_image1 == '' or $product_image2 == ''
        or $product_image3 == ''
    ) {
        echo "<script>alert('please fill all the available field')</script>";
        exit();
    } else {
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        //insert query
        $insert_product = "insert into products (product_title,product_description,product_keyword,
            category_id,brand_id,product_image1,product_image2,product_image3,product_price,
            date,status) values('$product_title','$description','$product_keywords',
            '$product_category','$product_brands','$product_image1','$product_image2',
            '$product_image3','$product_price',NOW(),'$product_status')";
        $result_query = mysqli_query($con, $insert_product);
        if ($result_query) {
            echo "<script>alert('successfully inserted the product')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!--css file -->
    <link rel="stylesheet" href="../style.css">
    <!-- font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="bg-light">
    <div class="container">
        <h1 class="text-center">Insert Products</h1>
        <!--form-->
        <form action="" method="POST" enctype="multipart/form-data">
            <!--title-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product-title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" placeholder="Enter product title" autocomplete="off" required="required" class="form-control">
            </div>
            <!--description-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Product description</label>
                <input type="text" name="description" id="description" placeholder="Enter product description" autocomplete="off" required="required" class="form-control">
            </div>
            <!--keywords-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">Product keywords</label>
                <input type="text" name="product_keyword" id="product_keyword" placeholder="Enter product keyword" autocomplete="off" required="required" class="form-control">
            </div>
            <!--category-->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" class="form-select">
                    <option selected>Select any category</option>
                    <?php
                    $select_query = "select * from categories";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!--brands-->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brand" class="form-select" aria-label="Default select example">
                    <option selected>Select any brand</option>
                    <?php
                    $select_query = "select * from brands";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $brand_title = $row['brand_title'];
                        $brand_id = $row['brand_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!--images-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product image 1</label>
                <input type="file" name="product_image1" id="product_image1" required="required" class="form-control">
            </div>
            <!--images-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product image 2</label>
                <input type="file" name="product_image2" id="product_image2" required="required" class="form-control">
            </div>
            <!--images-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product image 3</label>
                <input type="file" name="product_image3" id="product_image3" required="required" class="form-control">
            </div>
            <!--Price-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input type="text" name="product_price" id="product_price" placeholder="Enter product price" autocomplete="off" required="required" class="form-control mb-3 px-3">
            </div>
            <!--keywords-->
            <div class="form-outline mb-4 w-50 m-auto ">
                <input type="submit" name="insert_product" class="btn btn-info " value="Insert Products ">
            </div>
        </form>
    </div>
</body>

</html>