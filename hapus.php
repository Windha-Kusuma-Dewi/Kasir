<?php
    // memulai sesi
    session_start();

    // menghapus sesi dari sesi yang sudah ada 
    session_destroy();

    header('Location: index.php');
    exit;
    ?>