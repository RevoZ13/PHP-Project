<?php
    session_start();
    require_once "config/conn.php";

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }


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