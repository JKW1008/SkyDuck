<?php
    include "./inc/dbconfig.php";

    $db = $pdo;

    include "./inc/Questionboard.php";
    include "./inc/reply.php";


    $qidx = (isset($_GET['qusetion_idx']) && $_GET['qusetion_idx'] != '' && is_numeric($_GET['qusetion_idx'])) ? $_GET['qusetion_idx'] : '';

    if($qidx == ''){
        die("
            <script>
                alert('idx 값이 비었습니다.');
                history.go(-1);
            </script>
        ");
    };

    $board = new Board($db);
    $reply = new Reply($db);


    $row = $board->getInfoFormIdx($qidx);
    $replyrow = $reply->getInfoBoardIdx($qidx);
    // print_r($replyrow);

    if (empty($replyrow)) {
        die("
        <script>
            alert('답글이 존재하지 않습니다..');
            history.go(-1);
        </script>
    ");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <title>Document</title>
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/admin_main.css">
    <link rel="stylesheet" href="./css/admin_reply_write.css">
    <link rel="stylesheet" href="./css/admin_reply_view.css">
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="./js/board_reply.js"></script>
    <div id="main_wrap">
        <div class="container text-center">
            <div class="pt-5 pb-5">
                <input type="text" name="subject" id="id_subject" class="form-control" placeholder="제목을 입력해 주세요."
                    autocomplete="off" value="<?= $replyrow['title'] ?>" readonly>
            </div>
            <div class="p-3" id="contentWrap">
                <?= $replyrow['content']; ?>
            </div>
            <div class=" mt-3 d-flex gap-2 justify-content-end">
                <button class="btn btn-secondary" id="btn_board_list">목록보기</button>
                <button class="btn btn-secondary" id="btn_board_view"
                    data-idx="<?= $replyrow['question_idx'] ?>">본문보기</button>
            </div>
        </div>
    </div>

</body>

</html>