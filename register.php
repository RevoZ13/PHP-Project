<?php
    require_once "config/conn.php";
    if(isset($_POST["register"])  ){
        $name = htmlspecialchars($_POST["name"]);
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        $email = htmlspecialchars($_POST["email"]);
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
        $query = "INSERT INTO users VALUES ('', '$name', '$username', '$hashed_password', '$email')";
        $exec = mysqli_query($conn, $query);
        if ($exec) {
            // Registrasi berhasil, alihkan pengguna ke halaman login
            echo "
            <script>
                alert('Register berhasil!');
            </script>
            ";
            header("Location: login.php");
        } else {
            echo "
            <script>
                alert('Register gagal!');
            </script>
            ";
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
                <h1 class="text-center">Register</h1>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <p>Sudah punya akun? <a href="login.php">Login</a></p>
                    <button type="submit" name="register" class="btn btn-primary">Register</button>
                </form>

            </div>

        </div>
    </div>




    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>