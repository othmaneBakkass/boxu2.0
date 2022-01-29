<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/admin-dash.css">
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['is_logged'] == false) {
        header("location:login.php");
    }
    include_once "./database.php";
    include_once "./users_class.php";
    include_once "./products_class.php";

    $user_e_msg = '';
    $product_e_msg = '';
    $product_s_msg = '';
    $product_e_card_msg = '';
    $product_s_card_msg = '';
    //users table
    include_once "./table-dash-user.php";
    //products table
    include_once "./table-dash-products.php";
    //add products-card
    include_once "./card-dash-product.php";
    //number of users
    $nbr_users = user::numberOfUsers();
    $nbr_products = Product::numberOfProducts();
    //check if product is add
    if ($_SESSION['Product_is_Add'] == true) {
        $product_s_card_msg = 'Product is Add';
    }
    ?>

    <header>
        <nav class="navbar">
            <ul class="navbar-nav">
                <li class="nav-item-logo"><a href="#" class="nav-link "><img src="./icons/logo.svg" class="logo-icon"> <span class="link-text logo">Boxu</span></a></li>
                <li class="nav-item"><a href="index.php" class="nav-link "><span class="iconify nav-icon" data-icon="el:home-alt"></span><span class="link-text">Home</span> </a></li>
                <li class="nav-item"><a href="admin-dash.php" class="nav-link active"><span class="iconify nav-icon" data-icon="fluent:person-24-filled"></span><span class="link-text">Admin Panel</span></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><span class="iconify nav-icon" data-icon="ri:logout-circle-r-line"></span><span class="link-text sign-out-link">Sign out</span></a></li>
            </ul>
        </nav>
    </header>
    <main>

        <div class="cards">
            <div class="number-of-user">
                <h4>Number of Users is: <span><?= $nbr_users ?></span></h4>
                <h4>Number of Products is: <span><?= $nbr_products ?></span></h4>
            </div>
            <div class="add-product">
                <h4>Add a Product</h4>
                <h3 class="error_message_card"><?= $product_e_card_msg ?></h3>
                <h3 class="success_message_card"><?= $product_s_card_msg ?></h3>
                <form action="admin-dash.php" method="POST" enctype="multipart/form-data">
                    <label for="productName">Product Name:</label>
                    <input type="text" name="productName" id="productName">
                    <label for="price">Price:</label>
                    <input type="text" name="price" id="price">
                    <label for="cardColor">Choose a card color:</label>
                    <select name="card-color" id="cardcolor">
                        <option value="blue-box">blue</option>
                        <option value="red-box">red</option>
                        <option value="purple-box">purple</option>
                    </select>
                    <label>Choose product image:</label>
                    <label for="product-image-btn" class="picture-btn">Choose an image</label>
                    <input type="file" name="image" id="product-image-btn">
                    <button type="submit" name="confirm-btn" class="confirm-btn">Confirm</button>
                </form>
            </div>
        </div>
        <div class="tables">
            <h3 class="error_message"><?= $product_e_msg ?></h3>
            <h3 class="success_message"><?= $product_s_msg ?></h3>
            <h4>Products table</h4>
            <div class="products-table">
                <div class="table-head products-head">
                    <div class="table-row products-row">
                        <div class="table-col">
                            <h6>id</h6>
                        </div>
                        <div class="table-col">
                            <h6>image</h6>
                        </div>
                        <div class="table-col">
                            <h6>Product Name</h6>
                        </div>
                        <div class="table-col">
                            <h6>Price</h6>
                        </div>
                        <div class="table-col">
                            <h6>Modify</h6>
                        </div>
                    </div>
                </div>
                <div class="table-body">
                    <?php
                    //products Table
                    $stmt = "SELECT * FROM products";
                    $result = Database::selectAll($stmt);
                    $nbr = $result->rowCount();
                    if ($nbr > 0) {
                        while ($row = $result->fetch()) {
                            echo ('<form class="table-row" action="admin-dash.php" method="POST" enctype="multipart/form-data">');
                            echo ('
                                <div class="table-col">
                                    <input type="text" readonly class="id" name="id" value="' . $row["id"] . '">
                                </div>
                                ');
                            echo ('
                                <div class="table-col image-container">
                                    <input  type="file" name="updatedimage" id="imageUpdatebtn" >                 
                                    <img src="' . $row["product_image"] . '" alt="">
                                </div>
                                ');
                            echo ('
                                <div class="table-col">
                                    <input type="text" name="productName" value="' . $row["product_name"] . '">
                                    
                                </div>
                                ');
                            echo ('
                                <div class="table-col">
                                    <input type="text" name="price" value="' . $row["price"] . '">
                                </div>
                                ');
                            echo ('
                                <div class="table-col td-btns">
                                    <button class="delete" name="delete_product" type="submit">delete</button>
                                    <button class="update" name="update_product" type="submit">Update</button>
                                </div>
                            </form>
                                ');
                        }
                        $result->closeCursor();
                    }
                    ?>
                </div>
            </div>
            <h3 class="error_message"><?= $user_e_msg ?></h3>
            <h4>Users table</h4>
            <div class="user-table">
                <div class="table-head">
                    <div class="table-row">
                        <div class="table-col">
                            <h6>id</h6>
                        </div>
                        <div class="table-col">
                            <h6>image</h6>
                        </div>
                        <div class="table-col">
                            <h6>First Name</h6>
                        </div>
                        <div class="table-col">
                            <h6>Last Name</h6>
                        </div>
                        <div class="table-col">
                            <h6>Email</h6>
                        </div>
                        <div class="table-col">
                            <h6>username</h6>
                        </div>
                        <div class="table-col">
                            <h6>password</h6>
                        </div>
                        <div class="table-col">
                            <h6>Modify</h6>
                        </div>
                    </div>
                </div>
                <div class="table-body">
                    <?php
                    //users Table
                    $stmt = "SELECT * FROM users";
                    $result = Database::selectAll($stmt);
                    $nbr = $result->rowCount();
                    if ($nbr > 0) {
                        while ($row = $result->fetch()) {
                            echo ('<form class="table-row" action="admin-dash.php" method="POST" enctype="multipart/form-data">');
                            echo ('
                                <div class="table-col">
                                    <input type="text" readonly class="id" name="id_user" value="' . $row["id"] . '">
                                </div>
                                ');
                            echo ('
                                <div class="table-col image-container">
                                    <input  type="file" name="updatedimage" id="imageUpdatebtn" >                 
                                    <img src="' . $row["photo"] . '" alt="">
                                </div>
                                ');
                            echo ('
                                <div class="table-col">
                                    <input type="text" name="firstName" value="' . $row["firstName"] . '">
                                </div>
                                ');
                            echo ('
                                <div class="table-col">
                                    <input type="text" name="lastName" value="' . $row["lastName"] . '">
                                </div>
                                ');
                            echo ('
                                <div class="table-col">
                                    <input type="text" name="email" value="' . $row["email"] . '">
                                </div>
                                ');
                            echo ('
                                <div class="table-col">
                                    <input type="text" name="username" value="' . $row["userName"] . '">
                                </div>
                                ');
                            echo ('
                                <div class="table-col">
                                    <input type="text" name="password" value="' . $row["pass"] . '">
                                </div>
                                ');
                            echo ('
                                <div class="table-col td-btns">
                                    <button class="delete" name="delete_user" type="submit">delete</button>
                                    <button class="update" name="update_user" type="submit">Update</button>
                                </div>
                            </form>
                                ');
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p>copyright by Boxu since 2021</p>
    </footer>
    <script src="https://code.iconify.design/2/2.1.1/iconify.min.js"></script>
</body>

</html>