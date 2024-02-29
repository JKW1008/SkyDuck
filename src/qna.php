<?php
include './header.php';
?>

<?php
$filename = basename(__FILE__, '.php');
?>

<section class="portfolioPage">
    <div id="Title" class="">
        <?php
        include 'pageTitle.php';

        $title = "견적문의";
        $subtitle = "";
        $filename = "qna";
        $textColor = "text-black";

        render_header($title, $subtitle, $filename, $textColor);
        ?>
    </div>

    <div class=""></div>

    <div class="pt-[80px]">
    </div>
</section>

<script src="./js/qna.js"></script>
<div>
    <h2>상담에 필요한 기본정보를 입력해 주세요</h2>
    <input type="text" id="qna_name" placeholder="이름">
    <input type="tel" id="qna_tel" placeholder="연락처(-없이 입력)">
    <input type="email" id="qna_email" placeholder="이메일">
    <input type="text" id="qna_company_name" placeholder="회사명">
    <input type="text" id="qna_grade" placeholder="직급">
    <input type="text" id="qna_user_page" placeholder="홈페이지">
</div>
<hr>
<div>
    <h2>어떤 서비스가 필요하신가요? 다중선택이 가능합니다.</h2>
    <input type="checkbox" value="Catalog/Brochure">카타로그/브로슈어
    <input type="checkbox" value="Leaflet/Pamphlet">리플렛/팜플릿
    <input type="checkbox" value="Poster">포스터
    <input type="checkbox" value="Package">패키지
    <input type="checkbox" value="Newsletter/Book">사보/책
    <input type="checkbox" value="Advertisement">지면광고
    <input type="checkbox" value="RFP">제안서
    <input type="checkbox" value="Others">기타
</div>
<hr>
<div>
    <h2>예산과 일정은 어떻게 되나요</h2>
    <label for="qna_budget">예산</label>
    <input type="text" id="qna_budget" placeholder="예산을 입력해 주세요">
    <label for="qna_schedule">일정</label>
    <input type="text" id="qna_schedule" placeholder="일정을 입력해 주세요">
</div>
<hr>
<div>
    <h2>자세히 알려주시면 정확한 견적에 도움이 됩니다</h2>
    <textarea name="qna_content" id="qna_content" cols="100" rows="10" placeholder="
        제목: ex 카탈로그/브로슈어, 리플렛/팜플렛, 포스터, 제안서 등 
        사이즈: 
        페이지 수:
        인쇄 부수:
        추가설명: ex 종이종류 및 재질/코팅유무/후가공 등
        "></textarea>
</div>
<label for="qna_check">개인정보 방침을 읽었으며 동의합니다</label>
<input type="checkbox" id="qna_check">
<button type="button" id="qna_submit">견적 문의</button>



<?php
include './footer.php';
?>