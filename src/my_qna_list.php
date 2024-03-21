<?php
    include "./inc/dbconfig.php";
    include "./inc/common.php";

    if ($ses_id == '') {
        echo "<script>
            alert('접근 권한 없음');
            window.location.href = './index.php';
        </script>";
    }


    $db = $pdo;

    include "./inc/qna.php";

    $qna = new Qna($db);
    // print_r($ses_id);

    if ($ses_grade == 'common_member') {
        $myQnaArr = $qna->getAllInfoFromIdTable($ses_id, "sd_Users");
    } else if ($ses_grade == 'business_member') {
        $myQnaArr = $qna->getAllInfoFromIdTable($ses_id, "sd_BusinessUsers");
    }
    
    // print_r($myQnaArr);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</head>

<body>
    <div id="main_wrap">
        <script src="./js/my_qna_list.js"></script>
        <main class="border rounded-2 p-5" style="height: calc(100vh - 257px);">
            <div class="container">
                <h3>문의 관리</h3>
            </div>
            <!-- [idx] => 12
            [name] => 정강우
            [contact_number] => 01011111111
            [email] => aaaa@gmail.com
            [company_name] => 스카이덕
            [position] => 사장
            [website] => skyduck.com
            [service_required] => "Catalog\/Brochure,on"
            [budget] => 1.00
            [timeline] => 1주일
            [additional_notes] => 안녕하세요 -->
            <table class="mt-3 table table-border">
                <tr>
                    <th>번호</th>
                    <th>이름</th>
                    <th>이메일</th>
                    <th>회사명</th>
                    <th>카테고리</th>
                    <th>관리</th>
                </tr>
                <?php
            foreach($myQnaArr AS $row){
                // print_r($row);
        ?>
                <tr>
                    <td><?= $row['idx']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['company_name']; ?></td>
                    <td><?= $row['service_required']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm btn_mem_edit" data-idx="<?= $row['idx']; ?>">보기</button>
                    </td>
                </tr>
                <?php
            }
        ?>
            </table>
        </main>
    </div>
</body>

</html>