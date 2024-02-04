<?php
    include '../inc/dbconfig.php';

    $db = $pdo;

    include '../inc/businessmember.php';

    $bmem = new BusinessMemeber($db);

    $id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';
    $id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';
    $id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';
    $id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';
?>