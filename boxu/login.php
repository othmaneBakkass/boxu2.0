<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boxu</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <?php
    include_once './users_class.php';
    session_start();
    $_SESSION['is_logged'] = false;

    $e_msg = "";
    if (isset($_POST['login'])) {
        //variables
        $email = $_POST['email'];
        $password = $_POST['password'];
        //check if all inputs are filled
        if (empty($email) || empty($password)) {
            $e_msg = "Please Fill All the Inputs";
        } else {
            //check if user exist in database
            $checkUser = user::checkUser($email, $password);
            if ($checkUser == 'user exist') {
                //store user info in session
                $getUserInfo = user::saveCurrentUserInfo($email, $password);
                if ($getUserInfo == 'success') {
                    $_SESSION['is_logged'] = true;
                    header("location:index.php?success");
                } else {
                    header("location:login.php?failureSavingInfo");
                }
            } else {
                $e_msg = "wrong input";
            }
        }
    }

    ?>
    <main>
        <img src="./imgs/bg.svg" class="bg-img">
        <form action="login.php" method="POST">
            <h2>Login</h2>
            <input type="text" readonly name="errorMsg" value="<?= $e_msg ?>" id="errorMsg">
            <div class="form-top">
                <label>
                    email:
                </label>
                <input type="text" name="email" id="username">
            </div>
            <div class="form-middle">
                <label>
                    password:
                </label>
                <input type="password" name="password" id="password">
            </div>
            <div class="form-bottom">
                <button id="signUp">
                    <a href="signup.php">
                        sign up
                    </a>
                </button>
                <button type="submit" id="login" name="login">
                    login
                </button>
            </div>
        </form>

    </main>
    <footer>
        <p>copyright by Boxu since 2021</p>
    </footer>
    <script src="https://code.iconify.design/2/2.1.1/iconify.min.js"></script>
</body>

</html>