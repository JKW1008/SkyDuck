<?php
    include "./inc/common.php";

    if ($ses_id == "") {
        echo "<script>
        alert('접근 권한 없음');
        window.location.href = './member_login.php';
        </script>";
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
    <p>"Hello, World"</p>
</body>

</html>