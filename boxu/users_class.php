<?php
include_once './database.php';

class user
{
    public static function checkNewUser($firstname, $lastname, $username, $email, $password, $temp)
    {
        if (isset($firstname) && isset($lastname) && isset($username) && isset($email) && isset($password) && is_uploaded_file($temp)) {

            $query = 'SELECT userName FROM users WHERE email = :email';

            $stmt = Database::connect()->prepare($query);
            $stmt->execute(['email' => $email]);
            if ($stmt->rowCount() === 0) {
                return 'new user';
            } else {
                return 'email exist';
            }
        }
    }

    public static function addUser($firstname, $lastname, $username, $email, $password, $temp, $destination)
    {
        $query = 'INSERT INTO users (firstName,lastName,userName,email,pass,photo) VALUES(:firstname, :lastname, :username, :email, :pass, :photo)';
        $stmt = Database::connect()->prepare($query);
        $stmt->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'email' => $email,
            'pass' => $password,
            'photo' => $destination
        ]);

        $status = $stmt->rowCount();
        move_uploaded_file($temp, $destination);
        return $status;
    }

    public static function saveCurrentUserInfo($email, $password)
    {
        $query = 'SELECT * from users WHERE email = :email AND pass = :pass';

        $stmt = Database::connect()->prepare($query);

        $stmt->execute([
            'email' => $email,
            'pass' => $password
        ]);
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                $_SESSION['userId'] = $row['id'];
                $_SESSION['firstname'] = $row['firstName'];
                $_SESSION['lastname'] = $row['lastName'];
                $_SESSION['username'] = $row['userName'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['pass'] = $row['pass'];
                $_SESSION['photo'] = $row['photo'];
            }
            $stmt->closeCursor();
            return 'success';
        } else {
            return 'failure';
        }
    }

    public static function checkUser($email, $password)
    {
        $query = 'SELECT * FROM users WHERE email = :email AND pass = :pass';
        $stmt = Database::connect()->prepare($query);
        $stmt->execute([
            'email' => $email,
            'pass' => $password
        ]);
        if ($stmt->rowCount() == 0) {
            return 'user does not exist';
        } else {
            return 'user exist';
        }
    }

    public static function checkUserNewEmail($email, $old_email)
    {
        $query = 'SELECT * FROM users WHERE email = :email and email <> :old_email';
        $stmt = Database::connect()->prepare($query);
        $stmt->execute([
            'email' => $email,
            'old_email' => $old_email
        ]);
        if ($stmt->rowCount() == 0) {
            return 'user does not exist';
        } else {
            return 'user exist';
        }
    }
    public static function checkEmail($email)
    {
        $query = 'SELECT * FROM users WHERE email = :email';
        $stmt = Database::connect()->prepare($query);
        $stmt->execute(['email' => $email]);
        if ($stmt->rowCount() == 0) {
            return 'user does not exist';
        } else {
            return 'user exist';
        }
    }

    public static function getEmail($id)
    {
        $query = 'SELECT email FROM users WHERE id = :id';
        $stmt = Database::connect()->prepare($query);
        $stmt->execute(['id' => $id]);
        $useremail = "";
        if ($stmt->rowCount() <> 0) {
            while ($row = $stmt->fetch()) {
                $useremail = $row['email'];
            }
            $stmt->closeCursor();
        }
        return $useremail;
    }

    public static function getphoto($id)
    {
        $query = 'SELECT photo FROM users WHERE id = :id';
        $stmt = Database::connect()->prepare($query);
        $stmt->execute(['id' => $id]);
        $userimg = "";
        if ($stmt->rowCount() <> 0) {
            while ($row = $stmt->fetch()) {
                $userimg = $row['photo'];
            }
            $stmt->closeCursor();
        }
        return $userimg;
    }

    public static function updateUserInfo($id, $firstname, $lastname, $username, $email, $password)
    {

        $query = 'UPDATE users SET firstName = :firstname ,  lastName = :lastname, userName = :username, email= :email,pass = :pass WHERE id = :id';
        $stmt = Database::connect()->prepare($query);
        $stmt->execute(
            [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'username' => $username,
                'email' => $email,
                'pass' => $password,
                'id' => $id
            ]
        );
        //check if the row is updated in database
        if ($stmt->rowCount() > 0 || $stmt->rowCount() === 0) {
            //update the current session info
            $tempData = self::saveCurrentUserInfo($email, $password);
            if ($tempData == 'success') {
                //the info have been updated in the session and in database
                return 'success';
            } else {
                return 'session error';
            }
        } else {
            return 'failure';
        }
    }


    public static function updateImage($id, $email, $password, $temp, $destination, $photosrc)
    {
        $query = 'UPDATE users SET photo = :photo WHERE id = :id';
        $stmt = Database::connect()->prepare($query);
        $stmt->execute([
            'photo' => $destination,
            'id' => $id
        ]);
        //check if the row is updated in database
        if ($stmt->rowCount() > 0) {
            //unlink the old image
            unlink($photosrc);
            //move the new image to the userProfileImages Folder
            move_uploaded_file($temp, $destination);
            //update the current session info
            $tempData = self::saveCurrentUserInfo($email, $password);
            if ($tempData == 'success') {
                //the image is updated in the session and in database
                return 'success';
            } else {
                return 'session error';
            }
        } else {
            return 'failure';
        }
    }


    public static function deleteUser($id)
    {
        $query = "DELETE FROM users WHERE id = '$id'";
        $db = Database::connect();
        $stmt = $db->query($query);
        if ($db->exec($query) <> 0) {
            return true;
        } else {
            return false;
        }
    }


    public static function numberOfUsers()
    {
        $query = "SELECT COUNT(*) as nbr  FROM users";
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
