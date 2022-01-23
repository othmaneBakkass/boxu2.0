<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>boxu</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/home.css">
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['is_logged'] == false) {
        header("location:login.php");
    }


    include_once "./users_class.php";
    $id = $_SESSION['userId'];
    $username =  $_SESSION['username'];
    $email = $_SESSION['email'];
    $photosrc = $_SESSION['photo'];
    ?>
    <header>
        <nav class="navbar">
            <ul class="navbar-nav">
                <li class="nav-item-logo"><a href="#" class="nav-link "><img src="./icons/logo.svg" class="logo-icon"> <span class="link-text logo">Boxu</span></a></li>
                <li class="nav-item"><a href="index.php" class="nav-link active"><span class="iconify nav-icon" data-icon="el:home-alt"></span><span class="link-text">Home</span> </a></li>
                <?php
                if ($email  == 'admin@gmail.com' || $id == '1') {
                ?>
                    <li class="nav-item">
                        <a href="admin-dash.php" class="nav-link">
                            <span class="iconify nav-icon" data-icon="fluent:person-24-filled"></span><span class="link-text">Admin Panel</span>
                        </a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <a href="user-dash.php" class="nav-link">
                            <span class="iconify nav-icon" data-icon="fluent:person-24-filled"></span><span class="link-text">Profile</span>
                        </a>
                    </li>
                <?php
                };
                ?>

                <li class="nav-item"><a href="signout.php" class="nav-link"><span class="iconify nav-icon" data-icon="ri:logout-circle-r-line"></span><span class="link-text sign-out-link">Sign out</span></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><img class="user-picture" src="<?= $photosrc ?>"><span class="link-text userName"><?= $username ?></span></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="hero">
            <div class="hero-text">
                BOXU
            </div>
            <div class="hero-img">
                <img src="./imgs/hero.svg">
                <div class="hero-overlay"></div>
            </div>
        </section>
        <section class="store">
            <h2>Our Themed Boxes:</h2>
            <section class="products">

                <?php
                $query = 'SELECT * FROM products';
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
                ?>
                <!-- <div class="card blue-box">
                    <div class="card-title">
                        <h2>Travel Box</h2>
                    </div>
                    <div class="card-img">
                        <img src="./product-imgs/bluebox.svg" alt="" srcset="">
                    </div>
                    <div class="card-info">
                        <p>Price: 20$</p>
                        <button class="product-btn">Add to cart</button>
                    </div>
                </div>
                <div class="card red-box">
                    <div class="card-title">
                        <h2>Travel Box</h2>
                    </div>
                    <div class="card-img">
                        <img src="./product-imgs/redbox.svg" alt="" srcset="">
                    </div>
                    <div class="card-info">
                        <p>Price: 20$</p>
                        <button class="product-btn">Add to cart</button>
                    </div>
                </div>
                <div class="card purple-box">
                    <div class="card-title">
                        <h2>Travel Box</h2>
                    </div>
                    <div class="card-img">
                        <img src="./product-imgs/purplebox.svg" alt="" srcset="">
                    </div>
                    <div class="card-info">
                        <p>Price: 20$</p>
                        <button class="product-btn">Add to cart</button>
                    </div>
                </div>
                <div class="card red-box">
                    <div class="card-title">
                        <h2>Travel Box</h2>
                    </div>
                    <div class="card-img">
                        <img src="./product-imgs/redbox.svg" alt="" srcset="">
                    </div>
                    <div class="card-info">
                        <p>Price: 20$</p>
                        <button class="product-btn">Add to cart</button>
                    </div>
                </div>
                <div class="card purple-box">
                    <div class="card-title">
                        <h2>Travel Box</h2>
                    </div>
                    <div class="card-img">
                        <img src="./product-imgs/purplebox.svg" alt="" srcset="">
                    </div>
                    <div class="card-info">
                        <p>Price: 20$</p>
                        <button class="product-btn">Add to cart</button>
                    </div>
                </div>
                <div class="card blue-box">
                    <div class="card-title">
                        <h2>Travel Box</h2>
                    </div>
                    <div class="card-img">
                        <img src="./product-imgs/bluebox.svg" alt="" srcset="">
                    </div>
                    <div class="card-info">
                        <p>Price: 20$</p>
                        <button class="product-btn">Add to cart</button>
                    </div>
                </div> -->
            </section>
        </section>
    </main>
    <footer>
        <p>copyright by Boxu since 2021</p>
    </footer>
    <script src="https://code.iconify.design/2/2.1.1/iconify.min.js"></script>
</body>

</html>