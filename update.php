<?php
    session_start();
    require_once "config/conn.php";

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }


    // Tangkap Idnya
    $id = $_GET["id"];
    // Jika idnya ada, maka ambil data postingan
    if( isset($id) ){
            $queryPost = "SELECT * FROM posts WHERE id = $id";
            $execPost = mysqli_query($conn, $queryPost);
            $data = mysqli_fetch_assoc($execPost);
    }

    if(mysqli_num_rows($execPost) < 1){
        header("Location: index.php");
    }

    if(isset($_POST["submit"])  ){
        $judul = htmlspecialchars($_POST["judul"]);
        $gambar = $_FILES["gambar"];
        $kategori = htmlspecialchars($_POST["kategori"]);
        $penulis = htmlspecialchars($_POST["penulis"]);
        $tanggal = htmlspecialchars($_POST["tanggal"]);

        if($gambar) {
            $name = $gambar["name"];
            $tmp_name = $gambar["tmp_name"];
            $size = $gambar["size"];
            $type = $gambar["type"];
        }

        $fileNameRmvExt = explode(".",$name);
        $fileExtension = strtolower(end($fileNameRmvExt));

        // Tentukan Tempat Foto Disimpan
        $uploadDir = "uploads/";
        $destinationPath = $uploadDir . $name;

        // Cek jika direktori ada jika tidak ada maka ciptakan direktor uploads/
        if(!is_dir($uploadDir)){
            mkdir($uploadDir, 0777, true);
        }

        if(move_uploaded_file($tmp_name, $destinationPath)){
            $query = "UPDATE posts SET
            judul = '$judul',
            gambar = '$name',
            kategori = '$kategori',
            penulis = '$penulis',
            tanggal = '$tanggal' WHERE id = $id

            ";

            $exec = mysqli_query($conn, $query);

            if($exec){
                echo "
                    <script>
                    window.location.href = 'index.php';
                    alert('Berhasil mengubah data');
                    </script>
                ";
            }  

        }

    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>


    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
    <h1>Ubah Postingan</h1>

    <a href="index.php" class="create">Kembali Ke Halaman Awal</a>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="judul" required placeholder="judul" value="<?php echo $data["judul"] ?>">
        <input type="file" name="gambar" required placeholder="gambar">
        <input type="text" name="kategori" required placeholder="kategori" value="<?php echo $data["kategori"] ?>">
        <input type="text" name="penulis" required placeholder="penulis" value="<?php echo $data["penulis"] ?>">
        <input type="date" name="tanggal" required value="<?php echo $data["tanggal"] ?>">

        <button type="reset">Reset</button>
        <button type="submit" name="submit">Kirim</button>
    </form>

</body>
</html>