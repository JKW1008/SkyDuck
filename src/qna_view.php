<?php
    include "./inc/common.php";
    include "./inc/dbconfig.php";

    $db = $pdo;

    include './inc/qna.php';

    $qna = new Qna($db);

    $idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

    if($idx == ''){
        die("
            <script>
                alert('idx 값이 비었습니다.');
                history.go(-1);
            </script>
        ");
    };

    $qnaArr = $qna->getInfoFormIdx($idx);


    if ($ses_id == '') {
        die("
        <script>
            alert('접근실패');
            self.location.href = './index.php';
        </script>
    ");
    }

    if ($ses_id != $qnaArr['author_id']) {
        die("
            <script>
                alert('권한없음');
                self.location.href = './index.php';
            </script>
        ");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Board Form</title>
</head>

<body>
    <script src="./js/my_qna_view.js"></script>
    <div id="main_wrap">
        <div>
            <h2>상담에 필요한 기본정보</h2>
            <label for="qna_name">이름</label>
            <input type="text" id="qna_name" placeholder="이름" value="<?= $qnaArr['name'] ?>" readonly>
            <label for="qna_tel">연락처</label>
            <input type="tel" id="qna_tel" placeholder="연락처(-없이 입력)" value="<?= $qnaArr['contact_number'] ?>" readonly>
            <label for="qna_email">이메일</label>
            <input type="email" id="qna_email" placeholder="이메일" value="<?= $qnaArr['email'] ?>" readonly>
            <label for="qna_company_name">회사명</label>
            <input type="text" id="qna_company_name" placeholder="회사명" value="<?= $qnaArr['company_name'] ?>" readonly>
            <label for="qna_grade">직급</label>
            <input type="text" id="qna_grade" placeholder="직급" value="<?= $qnaArr['position'] ?>" readonly>
            <label for="qna_user_page">홈페이지</label>
            <input type="text" id="qna_user_page" placeholder="홈페이지" value="<?= $qnaArr['website'] ?>" readonly>
        </div>
        <hr>
        <div>
            <h2>요구서비스</h2>
            <?php
                $service_required = explode(',', $qnaArr['service_required']);
                // Remove 'on' from each service
                // $service_required = array_map(function($service) {
                //     return str_replace('/on', '', $service);
                // }, $service_required);
                // print_r($service_required);
            ?>
            <input type="checkbox" value="CatalogBrochure"
                <?= in_array("\"CatalogBrochure", $service_required) ? 'checked' : '' ?> disabled>카타로그/브로슈어
            <input type="checkbox" value="LeafletPamphlet"
                <?= in_array("LeafletPamphlet", $service_required) ? 'checked' : '' ?> disabled>리플렛/팜플릿
            <input type="checkbox" value="Poster" <?= in_array("Poster", $service_required) ? 'checked' : '' ?>
                disabled>포스터
            <input type="checkbox" value="Package" <?= in_array("Package", $service_required) ? 'checked' : '' ?>
                disabled>패키지
            <input type="checkbox" value="NewsletterBook"
                <?= in_array("NewsletterBook", $service_required) ? 'checked' : '' ?> disabled>사보/책
            <input type="checkbox" value="Advertisement"
                <?= in_array("Advertisement", $service_required) ? 'checked' : '' ?> disabled>지면광고
            <input type="checkbox" value="RFP" <?= in_array("RFP", $service_required) ? 'checked' : '' ?> disabled>제안서
            <input type="checkbox" value="Others" <?= in_array("Others", $service_required) ? 'checked' : '' ?>
                disabled>기타
        </div>
        <hr>
        <div>
            <h2>예산과 일정</h2>
            <label for="qna_budget">예산</label>
            <input type="text" id="qna_budget" placeholder="예산을 입력해 주세요" value="<?= $qnaArr['budget'] ?>">
            <label for="qna_schedule">일정</label>
            <input type="text" id="qna_schedule" placeholder="일정을 입력해 주세요" value="<?= $qnaArr['timeline'] ?>">
        </div>
        <hr>
        <div>
            <h2>요구사항</h2>
            <textarea name="qna_content" id="qna_content" cols="100" qnaArrs="10" placeholder="
        제목: ex 카탈로그/브로슈어, 리플렛/팜플렛, 포스터, 제안서 등 
        사이즈: 
        페이지 수:
        인쇄 부수:
        추가설명: ex 종이종류 및 재질/코팅유무/후가공 등
        " readonly><?= $qnaArr['additional_notes'] ?></textarea>
        </div>
        <button type="button" id="qna_submit">뒤로</button>
    </div>
</body>

</html>