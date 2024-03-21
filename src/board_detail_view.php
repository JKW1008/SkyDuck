<?php
    include "./inc/dbconfig.php";

    $db = $pdo;

    include './inc/Questionboard.php';

    $board = new Board($db);

    $idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

    if($idx == ''){
        die("
            <script>
                alert('idx 값이 비었습니다.');
                history.go(-1);
            </script>
        ");
    };

    $boardArr = $board->getInfoFormIdx($idx);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Board Form</title>
</head>

<body>
    <script src="./js/board_view.js"></script>
    <h2>Question Board Form</h2>
    <table>
        <tr>
            <td><label for="name">Name:</label></td>
            <td><input type="text" id="name" name="name" required value="<?= $boardArr['name'] ?>" readonly></td>
        </tr>
        <tr>
            <td><label for="password">Password (4-digit):</label></td>
            <td><input type="password" id="password" name="password" min="1000" max="9999" required
                    value="<?= $boardArr['password'] ?>" readonly></td>
        </tr>
        <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="email" id="email" name="email" required value="<?= $boardArr['email'] ?>" readonly></td>
        </tr>
        <tr>
            <td><label for="phone_number">Phone Number:</label></td>
            <td><input type="tel" id="phone_number" name="phone_number" required
                    value="<?= $boardArr['phone_number'] ?>" readonly></td>
        </tr>
        <tr>
            <td><label for="title">Title:</label></td>
            <td><input type="text" id="title" name="title" required value="<?= $boardArr['title'] ?>" readonly></td>
        </tr>
        <tr>
            <td><label for="content">Content:</label></td>
            <td><textarea id="content" name="content" rows="4" required readonly><?= $boardArr['password'] ?></textarea>
            </td>
        </tr>
    </table>
    <?php
        $images = explode(", ", $boardArr['attachments']);

        for ($i = 0; $i < count($images); $i++) {
            echo '<h3>'.$images[$i].'</h3>';
            echo '<img src="./data/board_attachment/'.$images[$i].'" alt="설명'.($i+1).'" width=400>';
        }
    ?>
    <button type="button" id="go_all">목록</button>
    <button type="button" id="view_reply">답글보기</button>
</body>

</html>