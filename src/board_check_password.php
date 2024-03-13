<?php
    include "./inc/common.php";

    if ($ses_id == ' ') {
        echo "<script>
            alert('접근 권한 없음');
            window.location.href = './member_login.php';
        </script>";
    };

    $idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

    if ($idx == '') {
        die("
        <script>
            alert('idx 값이 비었습니다.');
            history.go(-1);
        </script>
        ");
    };
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script src="./js/board_check_password.js"></script>
    <label for="passwordcheck">비밀번호를 입력해주세요</label>
    <input type="password" name="passwordcheck" id="passwordcheck">
    <button type="button" id="password_check_submit">확인</button>
</body>

</html>