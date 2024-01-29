<?php
    include '../inc/dbconfig.php';

    $db = $pdo;
    
    include '../inc/member.php';
    
    $mem = new Member($db);
    
    $id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';
    $mode = (isset($_POST['mode']) && $_POST['mode'] != '') ? $_POST['mode'] : '';

    if ($mode == "id_chk") {
        if ($id == '') {
            die(json_encode(['result' => 'empty_id']));
        }

        if ($mem->id_exist($id)) {
            die(json_encode(['result' => 'fail']));
        } else {
            die(json_encode(['result' => 'success']));
        }
    }
?>