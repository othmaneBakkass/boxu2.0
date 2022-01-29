<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>boxu</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/user-dash.css">
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['is_logged'] == false) {
        header("location:login.php");
    }
    include_once "./users_class.php";
    $e_msg = "";
    //Values From Database
    $id = $_SESSION['userId'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $username =  $_SESSION['username'];
    $email = $_SESSION['email'];
    $password = $_SESSION['pass'];
    $photosrc = $_SESSION['photo'];
    //Updating Values ON submit
    if (isset($_POST['conf'])) {
        //update-form variables
        $u_firstname = $_POST['firstName'];
        $u_lastname = $_POST['lastName'];
        $u_username = $_POST['userName'];
        $u_email = $_POST['email'];
        $u_password = $_POST['password'];
        //---photo info
        $u_photoSize = $_FILES['picture']['size'];
        $u_photoName = $_FILES['picture']['name'];
        $u_photoType = $_FILES['picture']['type'];
        $u_temp = $_FILES['picture']['tmp_name'];
        $photoError = $_FILES['picture']['error'];
        $allowedImages = array('png', 'jpeg', 'jpg');
        $img_ext = explode('/', $u_photoType);
        $ext = strtolower(end($img_ext));

        //checking for empty inputs
        if (empty($u_firstname) || empty($u_lastname) || empty($u_username) || empty($u_email) ||  empty($u_password)) {
            $e_msg = "Please Fill All The Inputs Fields";
        } else {
            //checking if the new email already exist in database
            $email_validation = user::checkUserNewEmail($u_email, $email);
            if ($email_validation == "user exist") {
                $e_msg = "this email is already taken";
            } else {
                //updating the info in database
                $result = user::updateUserInfo($id, $u_firstname, $u_lastname, $u_username, $u_email, $u_password);

                switch ($result) {

                    case 'failure':
                        $e_msg = "failed updating,please try again later";
                        break;
                    case 'session error':
                        $e_msg = "failed updating the session";
                        break;
                    case 'success':
                        //checking if photo was uploaded
                        if ($u_photoSize > 0) {
                            //check if the file returns an error
                            if ($photoError <> 0) {
                                $e_msg = "There was an error uploading your image,please try again with a different image.";
                            }
                            //checking for image type
                            if (!in_array($ext, $allowedImages)) {
                                $e_msg = "Invalid Image Type";
                            } else {
                                //setting the destination for image and changing image name
                                $newPhotoName = uniqid("", true) . $u_photoName;
                                $destination = './userProfileImages/' . $newPhotoName;
                                //updating image in database
                                $result = user::updateImage($id, $u_email, $u_password, $u_temp, $destination, $photosrc);

                                switch ($result) {
                                    case 'failure':
                                        $e_msg = "there was a problem updating your Image,please try again later";
                                        header("location:user-dash.php?failed updating ur img");
                                        break;
                                    case 'session error':
                                        $e_msg = "your Image is updated but we have some technical issues, please sign out and login again.";
                                        header("location:user-dash.php?failed updating the session");
                                        break;
                                    case 'success':
                                        header("location:user-dash.php?success");
                                        break;
                                    default:
                                        header("location:user-dash.php?unexpected error");
                                        break;
                                }
                            }
                        }
                        header("location:user-dash.php?success");
                        break;
                    default:
                        header("location:user-dash.php?unexpected error");
                        break;
                }
            }
        }
    }
    ?>
    <header>
        <nav class="navbar">
            <ul class="navbar-nav">
                <li class="nav-item-logo"><a href="#" class="nav-link "><img src="./icons/logo.svg" class="logo-icon"> <span class="link-text logo">Boxu</span></a></li>
                <li class="nav-item"><a href="index.php" class="nav-link "><span class="iconify nav-icon" data-icon="el:home-alt"></span><span class="link-text">Home</span> </a></li>
                <li class="nav-item"><a href="user-dash.php" class="nav-link active"><span class="iconify nav-icon" data-icon="fluent:person-24-filled"></span><span class="link-text">Profile</span></a></li>
                <li class="nav-item"><a href="signout.php" class="nav-link"><span class="iconify nav-icon" data-icon="ri:logout-circle-r-line"></span><span class="link-text sign-out-link">Sign out</span></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><img class="user-picture" src="<?= $photosrc ?>"><span class="link-text userName"><?= $username ?></span></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form class="settings-container" action="user-dash.php" method="POST" enctype="multipart/form-data">
            <h3 class="error_msg"><?= $e_msg ?></h3>
            <div class="settings-header">
                <div class="user-picture-name">
                    <img class="user-picture" src="<?= $photosrc ?>"> <input type="text" readonly value="<?= $username ?>" class="settings-userName">
                </div>
                <p>user information</p>
            </div>
            <div class="settings-main">
                <div class="settings-left-side">
                    <div class="form-info">
                        <label>
                            First Name:
                        </label>
                        <input type="text" name="firstName" value="<?= $firstname ?>" id="firstName">
                    </div>
                    <div class="form-info">
                        <label>
                            Last Name:
                        </label>
                        <input type="text" name="lastName" value="<?= $lastname ?>" id="lastName">
                    </div>
                    <div class="form-info">
                        <label>
                            Profile picture:
                        </label>
                        <label for="picture" class="picture-btn">
                            Add Profile Picture
                        </label>
                        <input type="file" name="picture" id="picture">
                    </div>
                </div>
                <div class="settings-right-side">
                    <div class="form-info">
                        <label>
                            username:
                        </label>
                        <input type="text" name="userName" value="<?= $username ?>" id="userName">
                    </div>
                    <div class="form-info">
                        <label>
                            email:
                        </label>
                        <input type="text" name="email" value="<?= $email ?>" id="email">
                    </div>
                    <div class="form-info">
                        <label>
                            password:
                        </label>
                        <input type="text" name="password" value="<?= $password ?>" id="password">
                    </div>
                </div>
            </div>
            <div class="settings-footer">
                <button type="submit" class="confirm-btn" name="conf">Confirm</button>
            </div>
        </form>
    </main>
    <footer>
        <p>copyright by Boxu since 2021</p>
    </footer>
    <script src="https://code.iconify.design/2/2.1.1/iconify.min.js"></script>
</body>

</html>