<?php
include_once("./database.php");
if (isset($_POST['key'])) {
    $key = $_POST['key'];
    switch ($key) {
        case 'price_high_to_low':
            $query = 'SELECT * FROM products ORDER BY price DESC';
            break;
        case 'price_low_to_high':
            $query = 'SELECT * FROM products ORDER BY price ASC';
            break;
        case 'name_A_to_Z':
            $query = 'SELECT * FROM products ORDER BY product_name ASC';
            break;
        case 'name_Z_to_A ':
            $query = 'SELECT * FROM products ORDER BY product_name ASC';
            break;
        default:
            $query = 'SELECT * FROM products';
            break;
    }
    $stmt = Database::selectAll($query);
    while ($row = $stmt->fetch()) {
        echo ('<div class="card ' . $row['color'] . '">');
        echo ('<div class="card-title">
            <h2>' . $row['product_name'] . '</h2>
        </div>
        ');
        echo ('
        <div class="card-img">
            <img src="' . $row['product_image'] . '">
        </div>
        ');
        echo ('
        <div class="card-info">
            <p>Price: ' . $row['price'] . '$</p>
            <button class="product-btn">Add to cart</button>
        </div>
        </div>
        ');
    }
    $stmt->closeCursor();
}
