<?php
    session_start();

    include "./inc/dbconfig.php";

    $db = $pdo;

    include "./inc/Questionboard.php";
    include "./inc/lib.php";
    include "./inc/reply.php";


    $sn = (isset($_GET['sn']) && $_GET['sn'] != '' && is_numeric($_GET['sn'])) ? $_GET['sn'] : '';
    $sf = (isset($_GET['sf']) && $_GET['sf'] != '') ? $_GET['sf'] : '';

    $Qboard = new Board($db);
    $reply = new Reply($db);

    $paramArr = [ 'sn' => $sn, 'sf' => $sf];

    $total = $Qboard->total($paramArr);
    $limit = 5;
    $page_limit = 5;
    $page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

    $param = ''; 

    $boardArr = $Qboard->list($page, $limit, $paramArr);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/boardlist.css">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</head>

<body>
    <script src="./js/board.js"></script>
    <div id="main_wrap">
        <main class="border rounded-2 p-5" style="height: calc(100vh - 257px);">
            <div class="container">
                <h3>게시판</h3>
            </div>
            <table class="mt-3 table table-border">
                <colgroup>
                    <col width="10%">
                    <col width="50%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <tr>
                    <th>번호</th>
                    <th>제목</th>
                    <th>작성자</th>
                    <th>작성일</th>
                </tr>
                <?php
                    $cnt = 0;
                    $ntotal = $total - ($page - 1) * $limit;
                        
                    foreach($boardArr AS $row){
                        $number = $ntotal - $cnt;
                        $cnt++;
                // 2023-11-11 11:11:11
                        $row['posting_time'] = substr($row['posting_time'], 0, 16);
                        if ($reply->isRowExists($row['idx'])) {
                            $replyArr = $reply->getInfoBoardIdx($row['idx']);
                            $row['replies'] = $replyArr['title'];
                        };
                ?>
                <tr class="detail_page" data-idx="<?= $row['idx']; ?>">
                    <td><?= $number; ?></td>
                    <td>🔒<?= $row['title']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <?php
                        $parts = explode('-', $row['posting_time']);
                        $detailparts = explode(' ', $parts[2]);
                    ?>
                    <td><?= $parts[1]; ?>-<?= $detailparts[0]; ?></td>
                </tr>
                <?php
                    if ($reply->isRowExists($row['idx'])) {
                        $replyArr = $reply->getInfoBoardIdx($row['idx']);
                ?>
                <tr>
                    <td colspan="4">
                        <!-- 전체 열을 합치는 셀 -->
                        <div class="replies">
                            <!-- 답글 정보 출력 -->
                            ↳<?= $replyArr['title']; ?>
                            <!-- 여기에 더 상세한 답글 정보를 추가할 수 있습니다. -->
                        </div>
                    </td>
                </tr>
                <?php
                    }
                ?>
                <?php
                }
                ?>
            </table>
            <div class=" container mt-3 d-flex gap-2 w-50">
                <select class="form-select w-25" name="sn" id="sn">
                    <option value="1">번호</option>
                    <option value="2">제목</option>
                </select>
                <input type="text" class="form-control w-25" id="sf" name="sf">
                <button class="btn btn-primary w-25" id="btn_search">검색</button>
                <button class="btn btn-success w-25" id="btn_all">전체목록</button>
            </div>
            <div class="d-flex mt-3 justify-content-between align-items-start">
                <?php
        if(isset($sn) && $sn != '' && isset($sf) && $sf != ''){      
            $param = '&sn='. $sn.'&sf='. $sf;
        }
        
        echo my_pagination($total, $limit, $page_limit, $page, $param);
        ?>
            </div>

        </main>
    </div>
</body>

</html>