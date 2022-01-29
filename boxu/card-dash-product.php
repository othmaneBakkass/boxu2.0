<?php
if (isset($_POST['confirm-btn'])) {
    //get data
    $image = $_FILES['image'];
    $product_name = $_POST['productName'];
    $price = $_POST['price'];
    $card_color = $_POST['card-color'];
    //validate inputs
    if (Product::validateProductCard($product_name, $price, $card_color, $image)) {
        //add product
        if (Product::addProduct($product_name, $price, $card_color, $image)) {
            $_SESSION['Product_is_Add'] = true;
            header("location:admin-dash.php");
        } else {
            $_SESSION['Product_is_Add'] = false;
            $product_e_card_msg = 'Product is not Add,please try again later';
        }
    } else {
        $_SESSION['Product_is_Add'] = false;
        $product_e_card_msg = 'invalid input';
    }
}
