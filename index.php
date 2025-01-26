<?php

    require_once "config/conn.php";
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

</head>
<body>
    
    <h1>Postingan</h1>

    <a href="create.php" class="create">Tambahkan data baru</a>

    <table border="1" cellpading="10" cellspacing="0">
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


</body>
</html>