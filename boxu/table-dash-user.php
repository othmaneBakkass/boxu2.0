<?php

// ON UPDATE
if (isset($_POST['update_user'])) {

    // get row info
    $userId = $_POST['id_user'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // image info
    $photoName = $_FILES['updatedimage']['name'];
    $photoSize = $_FILES['updatedimage']['size'];
    $photoType = $_FILES['updatedimage']['type'];
    $temp = $_FILES['updatedimage']['tmp_name'];
    $photoError = $_FILES['updatedimage']['error'];

    //array of allowed image types
    $allowedphotos = array('jpg', 'png', 'jpeg');
    //turn image type to array so we can get the file type
    $photoSplit = explode('/', $photoType);
    //get the extension and make it lower case
    $EXT = strtolower(end($photoSplit));
    //compare photo extention with the allowed types
    //check if every text input is filled
    if (empty($firstName) || empty($lastName) || empty($username) || empty($email) || empty($password)) {
        $user_e_msg = 'please fill all the inputs';
    } else {
        //Updating user info
        //get the selected user email from database
        $userEmail = user::getEmail($userId);
        //check if we have a duplicate email
        $validEmail = user::checkUserNewEmail($email, $userEmail);
        if ($validEmail == "user exist") {
            $e_msg = "this email is already taken";
        } else {
            $result = user::updateUserInfo($userId, $firstName, $lastName, $username, $email, $password);

            switch ($result) {

                case 'failure':
                    $user_e_msg = "Error-01:failed updating,please try again later";
                    break;
                case 'session error':
                    $user_e_msg = "Error-02:failed updating,please try again later";
                    break;
                case 'success':
                    $user_e_msg = "";
                    //checking if photo was uploaded
                    if ($photoSize > 0) {
                        //check if the file returns an error
                        if ($photoError <> 0) {
                            $user_e_msg = "There was an error uploading your image,please try again with a different image.";
                        }
                        //checking for image type
                        if (!in_array($EXT, $allowedphotos)) {
                            $user_e_msg = "Invalid Image Type";
                        } else {
                            //setting the destination for image and changing image name
                            $newPhotoName = uniqid("", true) . $photoName;
                            $destination = './userProfileImages/' . $newPhotoName;
                            $userphoto = user::getphoto($userId);

                            //updating image in database
                            $img_result = user::updateImage($userId, $email, $password, $temp, $destination, $userphoto);
                        }
                    }
                    break;
                default:
                    header("location:admin-dash.php?unexpected error");
                    break;
            }
        }
    }
}


// ON DELETE
if (isset($_POST['delete_user'])) {
    $userId = $_POST['id_user'];
    $result = user::deleteUser($userId);
    if ($result == true) {
        $user_e_msg = "success delete";
    } else {
        $user_e_msg = "failure delete";
    }
}
