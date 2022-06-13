<?php

session_start();
require_once("createDB.php");
require_once("component.php");
$db = new CreateDb("Productdb", "Producttb");


if(isset($_POST['remove'])){
    if($_GET['action']=='remove'){
        foreach($_SESSION['cart'] as $key => $value){
            if($value["product_id"]== $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('product ha sbeen removed...!')</script>";
                echo "<script>window.location=cart.php</script>";
            }
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
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css"
        integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">

</head>


<body class="bg-light">

    <?php
    require_once("header.php"); 
    ?>
    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
            <div class="shopping-cart">
                   <h6>My Cart</h6>
                  <hr>

                  <?php
                  
                  $total = 0;
                 if(isset($_SESSION['cart'])){
                    $product_id = array_column($_SESSION['cart'],'product_id');
                    $result = $db->getData();
                    while($row=mysqli_fetch_assoc($result)){
                        foreach($product_id as $id){
                            if ($row['id'] == $id){
                              cartElement($row['product_image'], $row['product_name'], $row['product_price'],$row['id']);
                              $total = $total + (int)$row['product_price'];
                            }
                        }
                    }

                 }
                 else{
                     echo "<h6>cart is empty</h6>";
                    }

                  
                  ?>
            </div>
               
                  
                  
            </div>
                <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25 ">

                    <div class="pt-4">
                        <h6>price detail</h6>
                        <hr>
                        <div class="row price-details">
                            <div class="col-md-6">
                                <?php
                                if(isset($_SESSION['cart'])){
                                    $count = count($_SESSION['cart']);
                                    echo "<h6>price($count items)</h6>";
                                }
                                else{
                                    echo "<h6>price(0 items)</h6>";
                                }
                                ?>
                                <h6>delivery charges</h6>
                                <hr>
                                <h6>amount Payable</h6>
                            </div>
                            <div class="col-md-6">
                                <?php echo $total;?>
                                <h6 class="text-succes">FREE</h6>
                                <hr>
                                <h6>$ <?php echo $total; ?> </h6>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
</body>
</html>


<!-- if(isset($_POST['remove'])){
    print_r($_GET['id']);
} -->