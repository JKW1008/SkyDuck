<?php
    include './inc/common.php';

    print_r($ses_grade);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        if ($ses_id != '' && $ses_grade != '') {
    ?>
    <?php
            if ($ses_grade == 'common_member') {
        ?>
    <a href="./mypage.php"><button>마이페이지</button></a>
    <?php
            } else if ($ses_grade == 'business_member') {
        ?>
    <a href="./business_mypage.php"><button>마이페이지</button></a>
    <?php
            }
        ?>
    <?php
        }
    ?>
    <p>"Hello, World"</p>
</body>

</html>