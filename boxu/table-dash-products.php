<?php
//update
if (isset($_POST['update_product'])) {

    //get data
    $id = $_POST['id'];
    $image = $_FILES['updatedimage'];
    $imageTmp = $image['tmp_name'];
    $imageName = $image['name'];
    $product_name = $_POST['productName'];
    $price = $_POST['price'];

    //checking if the inputs are filled without the image input
    if (Product::validate($product_name, $price)) {

        //updating product without the image
        if (Product::updateProduct($id, $product_name, $price)) {

            //checking if an image was uploaded
            if (Product::validate_image($image)) {

                //get the  old image
                $oldImage = Product::getImage($id);

                $newImgName = uniqid("", true) . $imageName;
                $destination = './product-imgs/' . $newImgName;

                //update image
                $result = Product::updateImage($id, $imageTmp, $destination, $oldImage);

                if ($result) {
                    $product_s_msg = 'Product and Image is updated';
                } else {
                    $product_s_msg = 'Product is updated';
                }
            }
        } else {
            $product_e_msg = 'Product is not updated';
        }
    } else {
        $product_e_msg = 'please fill all the inputs';
    }
}

//delete
if (isset($_POST['delete_product'])) {
    $id = $_POST['id'];
    $result = Product::deleteProduct($id);

    if ($result == true) {
        $product_s_msg = 'Product is Deleted';
    }
}
