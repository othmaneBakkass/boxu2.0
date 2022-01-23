<?php
include_once './database.php';


class Product
{
    public static function validate($product_name, $price)
    {
        if (empty($product_name) || empty($price)) {
            return false;
        }
        return true;
    }

    public static function validateProductCard($product_name, $price, $card_color, $image)
    {
        if (empty($product_name) || empty($price) || empty($card_color)) {
            return false;
        } else {
            if (self::validate_image($image)) {
                return true;
            }
        }
    }

    public static function addProduct($product_name, $price, $card_color, $image)
    {
        $newImageName = uniqid("", true) . $image['name'];
        $destination = './product-imgs/' . $newImageName;
        $imageTmp = $image['tmp_name'];

        //move the new image to theproduct-imgs Folder
        move_uploaded_file($imageTmp, $destination);

        $query = 'INSERT INTO products(product_image,color,product_name,price) VALUES(:product_image,:color,:product_name,:price)';
        $stmt = Database::connect()->prepare($query);
        $result = $stmt->execute(['product_image' => $destination, 'color' => $card_color, 'product_name' => $product_name, 'price' => $price]);
        if ($result) {
            return true;
        }
        return false;
    }

    public static function validate_image($image)
    {   //getting image info
        $imageType = $image['type'];
        $imageError = $image['error'];
        $imageSize = $image['size'];

        //setting up an array of allowed image types
        $allowedImages = ['png', 'jpg', 'jpeg',  'svg+xml'];

        //getting image extention then making it lower case
        $imageExt = explode('/', $imageType);
        $imageExtLower = strtolower(end($imageExt));



        //checking if the image is uploaded
        if ($imageSize > 0) {
            //checking for errors
            if ($imageError === 0) {
                //checking if the image uploaded is of the type we want
                if (in_array($imageExtLower, $allowedImages)) {
                    return true;
                }
                return false;
            }
        }
        return false;
    }

    public static function getImage($id)
    {
        $query = 'SELECT product_image FROM products WHERE id = :id';
        $stmt = Database::connect()->prepare($query);
        $stmt->execute(['id' => $id]);
        $img = "";
        if ($stmt->rowCount() <> 0) {
            while ($row = $stmt->fetch()) {
                $img = $row['product_image'];
            }
            $stmt->closeCursor();
        }
        return $img;
    }

    public static function updateImage($id, $imageTmp, $destination, $oldImage)
    {
        $query = 'UPDATE products SET product_image = :new_image  WHERE id = :id';
        $stmt = Database::connect()->prepare($query);
        $stmt->execute([
            'new_image' => $destination,
            'id' => $id
        ]);
        //check if the row is updated in database
        if ($stmt->rowCount() > 0) {
            //unlink the old image
            unlink($oldImage);
            //move the new image to the userProfileImages Folder
            move_uploaded_file($imageTmp, $destination);
            return true;
        } else {
            return false;
        }
    }

    public static function updateProduct($id, $product_name, $price)
    {
        $query = 'UPDATE  products SET  product_name = :product_name , price = :price WHERE id = :id';

        $stmt = Database::connect()->prepare($query);
        $stmt->execute([
            'product_name' => $product_name,
            'price' => $price,
            'id' => $id
        ]);

        if ($stmt->rowCount() !== false) {
            return true;
        } else {
            return false;
        }
    }

    public static function deleteProduct($id)
    {
        $query = "DELETE FROM products WHERE id = '$id'";
        $db = Database::connect();
        $stmt = $db->query($query);
        if ($db->exec($query) <> 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function numberOfProducts()
    {
        $query = "SELECT COUNT(*) as nbr  FROM products";
        $db = Database::connect();
        $stmt = $db->query($query);
        while ($row = $stmt->fetch()) {
            $result = $row;
        }
        $stmt->closeCursor();
        $nbr = $result['nbr'];
        return $nbr;
    }
}
