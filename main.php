<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

</head>
<body>
    <img class="wave" src="images/wave.jpg" alt="wave">
    <div class="container">
        <div class="img">
            <img src="images/img.svg" alt="Image">
        </div>
        <div class="login-container">
            <form action="linprocess.php" method="POST">
                <img class="avatar" src="images/avatar.svg" alt="avatar">
                <h2>Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <em class="fas fa-user"></em>
                    </div>
                    <div>
                        <h5>Faculty ID</h5>
                        <input name="user" class="input" type="text">
                    </div>
                </div>
                <div class="input-div two">
                    <div class="i">
                        <em class="fas fa-lock"></em>
                    </div>
                    <div>
                        <h5>Password</h5>
                        <input name="pass" class="input" type="Password">
                    </div>
                </div>
                <input type="submit" class="btn" value="Login">
                <input type="submit" class="btn" value="Cancel" onclick="goPrev()">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>  
    <script>
        function goPrev(){
            window.history.back();
        }
    </script>
</body>
</html>