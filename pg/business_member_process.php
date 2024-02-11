<?php
    include '../inc/dbconfig.php';

    $db = $pdo;

    include '../inc/businessmember.php';

    $bmem = new BusinessMemeber($db);

    $id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';
    $email = (isset($_POST['email']) && $_POST['email'] != '') ? $_POST['email'] : '';
    // echo $email;
    $mode = (isset($_POST['mode']) && $_POST['mode'] != '') ? $_POST['mode'] : '';

    if ($mode == "id_chk") {
        if ($id == '') {
            die(json_encode(['result' => 'empty_id']));
        }

        if ($bmem->id_exist($id)) {
            die(json_encode(['result' => 'fail']));
        } else {
            die(json_encode(['result' => 'success']));
        }
    } else if ($mode == "email_chk") {
        if ($email == '') {
            die(json_encode(['result' => 'empty_email']));
        }

        if ($bmem->email_format_check($email)) {
            die(json_encode(['result' => 'email_format_wrong']));
        }

        if ($bmem->email_exists($email)) {
            die(json_encode(['result' => 'fail']));
        } else {
            die(json_encode(['result' => 'success']));
        }
    }
?>