<?php 
require_once "config/conn.php";
session_start();

if(isset($_COOKIE["user"])){
    header("Location: index.php");
    exit;
}

if(isset($_COOKIE["user"]) && isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}

if(isset($_POST["login"])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    $user = mysqli_fetch_assoc($query);
    
    if (mysqli_num_rows($query) == 1) {
        if($user["username"] == $username && password_verify($password, $user["password"])) {
            $_SESSION["login"] = true;
            $cookie_name = "user";
            $cookie_value = $username;
            setcookie($cookie_name, $cookie_value, time() + 60, "/"); // 1 menit
                echo "
                <script>
                    alert('Login berhasil!');
                </script>
                ";
                header("Location: index.php");
            } else {
                echo "
                <script>
                    alert('Login gagal!');
                </script>
                ";
        }
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="login-container row mx-auto">
            <div class="col-lg-8 mx-auto col-sm-10 col-md-10">
                <h1 class="text-center">Login</h1>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <p>Tidak punya akun? <a href="register.php">Register</a></p>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>

            </div>

        </div>
    </div>




    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>