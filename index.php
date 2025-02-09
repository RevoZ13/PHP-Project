<?php
    session_start();
    require_once "config/conn.php";

    if(!isset($_SESSION["login"]) && !isset($_COOKIE["user"])){
        header("Location: login.php");
        exit;
    }

    // 1.Permintaan
    $query = "SELECT * FROM posts";

    $post = [];
    // 2.eksekusi permintaan ke database
    $data = mysqli_query($conn, $query);

    // 3.mengambil semua data sesuai permintaan
    while($post = mysqli_fetch_assoc($data)){
        $posts[] = $post;
    }

    // var_dump($posts); die;

    // //  4.Tampilkan data
    // foreach($posts as $post){
    //     var_dump($post); 
    // }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>


    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </div>
    </nav>
    
    <h1>Postingan</h1>

    <a href="create.php" class="create btn btn-success">Tambahkan data baru</a>

    <table class="table" border="1" cellpading="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Gambar</th>
            <th>Kategori</th>
            <th>Penulis</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </tr>

        <?php $i =1; ?>
        <?php foreach($posts as $post) : ?>
          <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $post["judul"] ?></td>
              <td>
                <img src="uploads/<?php echo $post["gambar"] ?>" alt="" width="150">
              </td>
              <td><?php echo $post["kategori"] ?></td>
              <td><?php echo $post["penulis"] ?></td>
              <td><?php echo $post["tanggal"] ?></td>
              <td>
                <a href="update.php?id=<?php echo $post["id"]; ?>">Ubah</a> |
                <a href="delete.php?id=<?php echo $post["id"]; ?>">Hapus</a>
              </td>
          </tr>
          <?php $i++; ?>    
        <?php endforeach; ?>
    </table>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</body>
</html>