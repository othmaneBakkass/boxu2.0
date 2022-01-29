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
    if (isset($_POST['signIn'])) {
        //variables
        $firstname = $_POST['firstName'];
        $lastname = $_POST['lastName'];
        $username = $_POST['userName'];
        $email = $_POST['email'];
        $password = $_POST['Password'];


        //image info
        $photoName = $_FILES['Photo']['name'];
        $temp = $_FILES['Photo']['tmp_name'];
        $photoType = $_FILES['Photo']['type'];
        $photoError = $_FILES['Photo']['error'];
        $fileEXT = explode('/', $photoType);

        $fileEXT_toLower = strtolower(end($fileEXT));

        $allowedImages = array('png', 'jpeg', 'jpg');

        //image type condition
        if (in_array($fileEXT_toLower, $allowedImages)) {
            if ($photoError === 0) {
                $newPhotoName = uniqid("", true) . $photoName;
                $destination = './userProfileImages/' . $newPhotoName;
                //checking if user already exists and if all the inputs are filled
                $checkuser = user::checkNewUser($firstname, $lastname, $username, $email, $password, $temp);
                echo ("<h1>$email</h1>");

                switch ($checkuser) {
                        //if user already exists
                    case 'email exist':
                        $e_msg = "This email already exists";
                        break;
                    case 'new user':
                        // adding user to the database and sending him to the main page
                        $status = user::addUser($firstname, $lastname, $username, $email, $password, $temp, $destination);
                        if ($status > 0) {
                            //save users data in session
                            if (user::saveCurrentUserInfo($email, $password) == 'success') {
                                $_SESSION['is_logged'] = true;
                                header("location:index.php?success");
                            } else {
                                header("location:signup.php?failureSavingInfo");
                            }
                        }
                        break;
                    default:
                        header("location:signup.php?failure");
                        break;
                }
            } else {
                $e_msg = "There was an error uploading your Image";
                header("location:signup.php?There was an error uploading your Image");
            }
        } else {
            $e_msg = "invalid Image Type";
        }

        //if the user clicked on the sign in button with out filling any input
        if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || !isset($password) || !is_uploaded_file($temp)) {
            $e_msg = "Please Fill All The Inputs Fields";
        }
    }

    ?>

    <main>
        <img src="./imgs/bg.svg" class="bg-img">
        <form action="signup.php" method="POST" enctype="multipart/form-data">
            <h2>Sign up</h2>
            <input type="text" readonly name="errorMsg" value="<?= $e_msg ?>" id="errorMsg">
            <div class="form-top">
                <label>
                    First Name:
                </label>
                <input type="text" name="firstName" id="firstName">
                <label>
                    Last Name:
                </label>
                <input type="text" name="lastName" id="lastName">


            </div>
            <div class="form-middle">
                <label>
                    username:
                </label>
                <input type="text" name="userName" id="userName">
                <label>
                    email:
                </label>
                <input type="text" name="email" id="email">
                <label>
                    password:
                </label>
                <input type="password" name="Password" id="password">
                <label for="picture" class="picture-btn">
                    Add Profile Picture
                </label>
                <input type="file" name="Photo" id="picture">
            </div>
            <div class="form-bottom">
                <button id="signUp">
                    <a href="login.php">
                        login
                    </a>
                </button>
                <button type="submit" id="login" name="signIn">
                    sign in
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