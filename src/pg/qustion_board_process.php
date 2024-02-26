<?php
    include "../inc/dbconfig.php";

    $db = $pdo;

    include '../inc/board.php';

    $board = new Board($db);

    $name = (isset($_POST['name']) && $_POST['name'] != '') ? $_POST['name'] : '';
    $password = (isset($_POST['password']) && $_POST['password'] != '') ? $_POST['password'] : '';
    $email = (isset($_POST['email']) && $_POST['email'] != '') ? $_POST['email'] : '';
    $tel = (isset($_POST['tel']) && $_POST['tel'] != '') ? $_POST['tel'] : '';
    $title = (isset($_POST['title']) && $_POST['title'] != '') ? $_POST['title'] : '';
    $content = (isset($_POST['content']) && $_POST['content'] != '') ? $_POST['content'] : '';
    $attachment = (isset($_POST['attachment']) && $_POST['attachment'] != '') ? $_POST['attachment'] : '';
    $mode = (isset($_POST['mode']) && $_POST['mode'] != '') ? $_POST['mode'] : '';
?>