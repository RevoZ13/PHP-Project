<?php

    require_once "config/conn.php";

    $id = $_GET["id"];

    $query = "DELETE FROM posts WHERE id = $id";

    $exec = mysqli_query($conn, $query);

    if($exec){
        echo "
                <script>
                    window.location.href = 'index.php';
                    alert('Berhasil menghapus data');
                </script>
        ";
    }



?>