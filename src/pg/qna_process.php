<?php
    include '../inc/dbconfig.php';

    $db = $pdo;

    include '../inc/qna.php';

    $qna = new Qna($db);

    $name = (isset($_POST['name'])  && $_POST['name'] != '') ? $_POST['name'] : '';
    $tel = (isset($_POST['tel']) && $_POST['tel'] != '') ? $_POST['tel'] : '';
    $email = (isset($_POST['email']) && $_POST['email'] != '') ? $_POST['email'] : '';
    $c_name = (isset($_POST['c_name']) && $_POST['c_name'] != '') ? $_POST['c_name'] : '';
    $grade = (isset($_POST['grade']) && $_POST['user_page'] != '') ? $_POST['user_page'] : '';
    $user_page = (isset($_POST['user_page']) && $_POST['user_page'] != '') ? $_POST['user_page'] : '';
    $budget = (isset($_POST['budget']) && $_POST['budget'] != '') ? $_POST['budget'] : '';
    $schedule = (isset($_POST['schedule']) && $_POST['schedule'] != '') ? $_POST['schedule'] : '';
    $content = (isset($_POST['content']) && $_POST['content'] != '') ? $_POST['content'] : '';

    $services = (isset($_POST['services']) && is_array($_POST['services'])) ? $_POST['services'] : array();

    // echo "Services Array: ";
    // print_r($services);

    if ($name == '') {
        die(json_encode(['result' => 'empty_name']));
    };

    if ($tel == '') {
        die(json_encode(['result' => 'empty_tel']));
    };

    if ($email == '') {
        die(json_encode(['result' => 'empty_email']));
    };

    if ($c_name == '') {
        die(json_encode(['result' => 'emtpy_cname']));
    };

    if ($grade == '') {
        die(json_encode(['result' => 'empty_grade']));
    };

    if ($user_page == '') {
        die(json_encode(['result' => 'empty_userpage']));
    };

    if ($budget == '') {
        die(json_encode(['result' => 'empty_budget']));
    };

    if ($schedule == '') {
        die(json_encode(['result' => 'empty_schedule']));
    };

    if (empty($services)) {
        die(json_encode(['result' => 'empty_services']));
    };

    $services_json = json_encode($services);
    $budget_int = intval($budget);

    // var_dump($budget_int);

    $arr = [
        'name' => $name,
        'c_number' => $tel,
        'email' => $email,
        'company' => $c_name,
        'position' => $grade,
        'website' => $user_page,
        'service_r' => $services_json,
        'budget' => $budget_int,
        'schedule' => $schedule,
        'a_note' => $content
    ];

    try {
        $result = $qna->input($arr);

        header('Content-Type: application/json');
        if ($result) {
            die(json_encode(['result' => 'success']));
        } else {
            die(json_encode(['result' => 'fail']));
        }
    } catch (Exception $e) {
        header('Content-Type: application/json');
        die(json_encode(['result' => 'error', 'message' => $e->getMessage()]));
    }
?>