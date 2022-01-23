<?php
if (isset($_POST['confirm-btn'])) {
    //get data
    $image = $_FILES['image'];
    $product_name = $_POST['productName'];
    $price = $_POST['price'];
    $card_color = $_POST['card-color'];
    echo ($card_color);
    echo ($product_name);
    echo ($price);
    print_r($image);
    //validate inputs
    if (Product::validateProductCard($product_name, $price, $card_color, $image)) {
        //add product
        if (Product::addProduct($product_name, $price, $card_color, $image)) {
            $product_s_card_msg = 'Product is Add';
        } else {
            $product_e_card_msg = 'Product is not Add,please try again later';
        }
    } else {
        $product_e_card_msg = 'invalid input';
    }
}
