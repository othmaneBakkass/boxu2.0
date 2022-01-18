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
    <main>
        <img src="./imgs/bg.svg" class="bg-img">
        <form action="">
            <h2>Login</h2>
            <input type="text" readonly name="errorMsg" value="something aint right" id="errorMsg">
            <div class="form-top">
                <label>
                    username:
                </label>
                <input type="text" name="username" id="username">
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
                <button type="submit" id="login">
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